<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Notification extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("cases_model");
        $this->load->model("notification_model");
        


        //$this->add_external_css(base_url('assets/plugins/datatables/dataTables.bootstrap.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        //$this->add_external_js(base_url('assets/plugins/datatables/jquery.dataTables.js'));
        //$this->add_external_js(base_url('assets/plugins/datatables/dataTables.bootstrap.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/js/redactor3.js'));
        $this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/notification/script.js')); 
        
    }
    
    

    function index()
    {
        $data = $this->includes;
        $data['settings'] = $this->notification_model->get_setting();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('case', 'lang:case_alert_days', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['case_alert'] = $this->input->post('case');
                $save['to_do_alert'] = $this->input->post('to_do');
                $save['appointment_alert'] = $this->input->post('appointment');
                $this->notification_model->update($save);
                $this->session->set_flashdata('message', lang('notification_settings_updated'));
                redirect('admin/notification');
            }
            
        }        
        
        
        $data['page_title'] = lang('notification') . lang('settings');
        $data['body'] = 'notification/notification';
        $this->load->view('template/main', $data);    

    }    
    
    
        
    
}
