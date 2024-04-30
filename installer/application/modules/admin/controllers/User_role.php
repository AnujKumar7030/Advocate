<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class User_role extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_role_model");
        
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
        $this->add_external_js(base_url('assets/js/user_role/script.js'));    
    }
    
    function index()
    {
        $data = $this->includes;
        $data['roles'] = $this->user_role_model->get_all();
        $data['page_title'] = lang('user_roles');
        $data['body'] = 'user_roles/list';
        $this->load->view('template/main', $data);
    }   

    function add()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', '%s can not be blank');
            
             
            if ($this->form_validation->run()==true) {
                   $check_user_role_name = $this->user_role_model->get_user_role_name($this->input->post('name'));

                   $count = $check_user_role_name > 0 ? '-' . $check_user_role_name : '';
                   $save['slug'] = slugify_string($this->input->post('name', true) . $count);
                $save['name'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');

                
                $this->user_role_model->save($save);
                $this->session->set_flashdata('message', lang('user_role_saved'));
                redirect('admin/user_role');
            }
        }        
        
        
        $data['page_title'] = lang('add') . lang('user_role');
        $data['body'] = 'user_roles/add';
        
        
        $this->load->view('template/main', $data);    
    }
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['user_role'] = $this->user_role_model->get($id);
        $data['id'] =$id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
            
             
            if ($this->form_validation->run()==true) {
                   $check_user_role_name = $this->user_role_model->get_user_role_name($this->input->post('name'));
                $save['name'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');
                
                $this->user_role_model->update($save, $id);
                   $this->session->set_flashdata('message', lang('user_role_updated'));
                redirect('admin/user_role');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('user_role');
        $data['body'] = 'user_roles/edit';
        $this->load->view('template/main', $data);    
    }  
    
    function delete($id=false)
    {
        $data = $this->includes;
        if($id) 
        {
            if($id != 1 && $id != 2)
            {
                $this->user_role_model->delete($id);
            }
           
            $this->session->set_flashdata('message', lang('user_role_deleted'));
            redirect('admin/user_role');
            
        }
    }  

    function _custom_required($str, $func)
    {
        switch($func) {
        case 'name':
            $this->form_validation->set_message('custom_required', 'Enter your name');
            return (trim($str) == '') ? false : true;
            break;
        case 'second':
            $this->form_validation->set_message('custom_required', 'The variables are required');
            return (trim($str) == '') ? false : true;
            break;
        }
    }  
    
}

class MY_Form_validation
{
    public function custom_required($str)
    {
        if (! is_array($str)) {
            return (trim($str) == '') ? false : true;
        } else {
            return ( ! empty($str));
        }
    }
}
    
class MY_Form_validation1 extends CI_Form_validation
{

    public function __construct()
    {
        parent::__construct();
    }
    function required_select($input)
    {
        $this->set_message('required_select', 'select %s');
        return false;
    }
}
