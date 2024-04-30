<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Custom_Fields extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("custom_field_model");
        
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
        $this->add_external_js(base_url('assets/js/custom_fields/script.js'));
    }
    
    
    function index($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_all();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('type', 'lang:field_type', 'required');
            $this->form_validation->set_rules('form', 'lang:select_form', 'required');
            $this->form_validation->set_message('required', '%s can not be blank');
             
            if ($this->form_validation->run()==true) {
                $save['name']          = $this->input->post('name');
                $save['field_type']  = $this->input->post('type');
                $save['form']         = $this->input->post('form');
                $save['values']         = $this->input->post('values');
                
                $this->custom_field_model->save($save);
                $this->session->set_flashdata('message', lang('field_created'));
                redirect('admin/custom_fields');
            }
        }        
            
        $data['page_title'] = lang('custome_fields');
        $data['body'] = 'custom_fields/form';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        
        if($id) {
            $this->custom_field_model->delete($id);
            $this->session->set_flashdata('message', lang('field_deleted'));
            redirect('admin/custom_fields');
        }
    }    
}
