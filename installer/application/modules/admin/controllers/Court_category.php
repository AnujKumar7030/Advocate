<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Court_Category extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("court_category_model");

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
        $this->add_external_js(base_url('assets/js/court/script.js'));

    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['categories'] = $this->court_category_model->get_all();
        $data['page_title'] = lang('court') ." ". lang('categories');
        $data['body'] = 'court_category/list';
        $this->load->view('template/main', $data);    
    }    
    
    function add()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') 
        {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) 
            {
                $save['name'] = $this->input->post('name');
                $this->court_category_model->save($save);
                $this->session->set_flashdata('message', lang('court_category_created'));
                redirect('admin/court_category');
                
            }            
        }        
        
        
        $data['page_title'] = lang('add') . lang('court') . lang('category');
        $data['body'] = 'court_category/add';
        
        $this->load->view('template/main', $data);    
    }    
    
    
    function edit($id=false)
    {
         $data = $this->includes;
        $data['category'] = $this->court_category_model->get_category_by_id($id);
        $data['id'] =$id;
        $data['categories'] = $this->court_category_model->get_all();
    
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $this->court_category_model->update($save, $id);
                $this->session->set_flashdata('message', lang('court_category_updated'));
                redirect('admin/court_category');
                
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('court') . lang('category'); 
        $data['body'] = 'court_category/edit';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
         $data = $this->includes;
        
        if($id) {
            $this->court_category_model->delete($id);
            $this->session->set_flashdata('message', lang('court_category_deleted'));
            redirect('admin/court_category');
        }
    }    
        
    
}
