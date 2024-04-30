<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Permissions extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_role_model");
        $this->load->library('form_validation');



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
        $this->add_external_js(base_url('assets/js/permissions/script.js')); 
    }
    
    
    public function index()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            
            if($this->user_role_model->update_permissions($this->input->post('access'))) {
                $this->session->set_flashdata('flag', 1);
            }
            else{$this->session->set_flashdata('flag', 2);
            }
            redirect('admin/permissions');
        }
        
        
        $data['page_title'] = 'permissions';
        $data['body'] = 'permissions/permissions';
        $data['departments'] = $this->user_role_model->get_user_roles();
        $data['actions'] = $this->user_role_model->get_all_actions();
        $data['permissions'] = $this->user_role_model->get_permissions();
        $this->load->view('template/main', $data);
    }
    
}
