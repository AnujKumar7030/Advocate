<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Departments extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("department_model");


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
        $this->add_external_js(base_url('assets/js/departments/script.js'));
        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['departments'] = $this->department_model->get_all();
        $data['page_title'] = lang('departments');
        $data['body'] = 'departments/list';
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
                $save['name'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');
                
                $d_id =    $this->department_model->save($save);
                
                foreach($this->input->post('designations') as $new){
                    $save_degi[] = array(
                    'department_id' =>$d_id,
                    'designation' =>$new
                    );
                
                }
                $this->department_model->save_designations($save_degi);
                $this->session->set_flashdata('message', lang('department saved'));
                redirect('admin/departments');
            }
        }        
        
        
        $data['page_title'] = lang('add') . lang('department');
        $data['body'] = 'departments/add';
        
        
        $this->load->view('template/main', $data);    
    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;

        $data['department'] = $this->department_model->get($id);
        $data['designations'] = $this->department_model->get_designations($id);
        $data['id'] =$id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');
                
                $this->department_model->update($save, $id);
                $this->department_model->delete_designations($id);
                foreach($this->input->post('designations') as $new){
                    if(!empty($new)) {
                          $save_degi[] = array(
                        'department_id' =>$id,
                        'designation' =>$new
                          );
                    }
                
                }
                $this->department_model->save_designations($save_degi);
                   $this->session->set_flashdata('message', lang('department_updated'));
                redirect('admin/departments');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('department');
        $data['body'] = 'departments/edit';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        
        if($id) {
            $this->department_model->delete($id);
            $this->session->set_flashdata('message', lang('department_deleted'));
            redirect('admin/departments');
            
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
