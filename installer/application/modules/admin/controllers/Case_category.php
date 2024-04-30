<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Case_Category extends MX_Controller
{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model("case_category_model");
        
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-responsive-dt/css/responsive.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net/js/jquery.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-dt/js/dataTables.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/js/redactor3.js'));
        $this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/case_category/script.js'));
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['categories'] = $this->case_category_model->get_all();
        $data['page_title'] = lang('case') ." ". lang('categories');
        $data['body'] = 'case_category/list';
        $this->load->view('template/main', $data);    
    }    
    
    function add()
    {
        $data = $this->includes;
        $data['categories'] = $this->case_category_model->get_all();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('display_in_menu', 'display in menu', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) 
            {

                $title_slug = slugify_string($this->input->post('name',TRUE));
                $slug_count = $this->case_category_model->case_category_slug_like_this($title_slug,NULL);

                $save['name'] = $this->input->post('name');
                $save['slug'] = $title_slug.$slug_count;
                $save['display_in_menu'] = $this->input->post('display_in_menu');
				$save['description'] = $this->input->post('description');
                $save['parent_id'] = ($this->input->post('parent_id')) ? $this->input->post('parent_id') : 0;
                
                $this->case_category_model->save($save);
                $this->session->set_flashdata('message', lang('case_category_created'));
                redirect('admin/case_category');
                
            }
            
        }        
        
        
        $data['page_title'] = lang('add') . lang('case') . lang('category');
        $data['body'] = 'case_category/add';
        $this->load->view('template/main', $data);    
    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;
        $data['category'] = $this->case_category_model->get_category_by_id($id);
        
        $data['categories'] = $this->case_category_model->get_all();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('display_in_menu', 'display in menu', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_message('required', lang('custom_required')); 
             
            if ($this->form_validation->run()==true) 
            {


                $title_slug = slugify_string($this->input->post('name',TRUE));
                $slug_count = $this->case_category_model->case_category_slug_like_this($title_slug,$id);
                $slug_name = $title_slug.$slug_count;

                $save['name'] = $this->input->post('name');
                $save['slug'] = $slug_name;
                $save['display_in_menu'] = $this->input->post('display_in_menu');
				$save['description'] = $this->input->post('description');
                $save['parent_id'] = ($this->input->post('parent_id')) ? $this->input->post('parent_id') : 0;
                
                $this->case_category_model->update($save, $id);
                $this->session->set_flashdata('message', lang('case_category_updated'));
                redirect('admin/case_category');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('case') . lang('category');
        $data['body'] = 'case_category/edit';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        
        $data = $this->includes;
        if($id) {
            $this->case_category_model->delete($id);
            $this->session->set_flashdata('message', lang('case_category_deleted'));
            redirect('admin/case_category');
        }
    }    
        
    
}
