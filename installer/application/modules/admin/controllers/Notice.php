<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Notice extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("notice_model");


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
        $this->add_external_js(base_url('assets/js/notice/script.js')); 
        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['notice'] = $this->notice_model->get_all();
        $data['page_title'] = lang('notice');
        $data['body'] = 'notice/list';
        $this->load->view('template/main', $data);    

    }    
    
    function add()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('title', 'lang:title', 'required');
            $this->form_validation->set_rules('date_time', 'lang:date', 'required');
            $this->form_validation->set_message('required', '%s can not be blank');
             
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('title');
                $save['description'] = $this->input->post('description');
                $save['date_time'] = $this->input->post('date_time');
                $this->notice_model->save($save);
                $this->session->set_flashdata('message', lang('notice saved'));
                redirect('admin/notice');
            }
        }        
        
        
        $data['page_title'] = lang('add') . lang('notice');
        $data['body'] = 'notice/add';
        
        
        $this->load->view('template/main', $data);    
    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['notice'] = $this->notice_model->get($id);
        $data['id'] =$id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('title', 'lang:title', 'required');
            $this->form_validation->set_rules('date_time', 'lang:date', 'required');
            $this->form_validation->set_message('required', '%s can not be blank');
             
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('title');
                $save['description'] = $this->input->post('description');
                $save['date_time'] = $this->input->post('date_time');
                $this->notice_model->update($save, $id);
                   $this->session->set_flashdata('message', lang('notice_updated'));
                redirect('admin/notice');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('notice');
        $data['body'] = 'notice/edit';
        $this->load->view('template/main', $data);    

    }
    
    function view($id=false)
    {
        $data = $this->includes;
        $data['notice'] = $this->notice_model->get($id);
        $data['id'] =$id;
    
        $data['page_title'] = lang('edit') . lang('notice');
        $data['body'] = 'notice/view';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->notice_model->delete($id);
            $this->session->set_flashdata('message', lang('notice_deleted'));
            redirect('admin/notice');
            
        }
    }    
    
}
