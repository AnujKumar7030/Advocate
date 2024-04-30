<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Clients extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("clients_model");
        $this->load->model("custom_field_model");
        $this->load->model("employees_model");
        $this->load->library('form_validation');

 
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
        $this->add_external_js(base_url('assets/js/clients/script.js'));

    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['clients'] = $this->clients_model->get_all_clients();
        $data['page_title'] = lang('clients');
        $data['body'] = 'clients/list';
        $this->load->view('template/main', $data);    
    }    
    
    
    function export()
    {
        $data = $this->includes;
        $data['clients'] = $this->clients_model->get_all_clients();
        $this->load->view('clients/export', $data);    
    }    
    
    function add()
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(1);    
        $data['employee_id'] = $this->employees_model->get_employee_id();
        if($data['employee_id']->employee_id==0) {
            $data['e_id']    = $this->settings->employee_id;
        }
        else
        {
            $data['e_id']    = $data['employee_id']->employee_id+1;
        }
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
             
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('gender', 'lang:gender', 'required');
            $this->form_validation->set_rules('dob', 'lang:date_of_birth', '');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|is_unique[users.email]');
            $this->form_validation->set_rules('username', 'lang:username', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
            $this->form_validation->set_rules('contact', 'lang:phone', 'required');
            $this->form_validation->set_rules('address', 'lang:address', '');

            $photo = array();
            $save = array();
            if($_FILES['img'] ['name'] !='') { 
                $config['upload_path'] = './assets/uploads/images/';
                $config['allowed_types'] = '*';
                $config['max_size']    = '10000';
                $config['max_width']  = '10000';
                $config['max_height']  = '6000';
                $new_name = time().'_'.$_FILES["img"]['name'];
                $config['file_name'] = $new_name;
        
                $this->load->library('upload', $config);
        
                if (!$this->upload->do_upload('img')) {
                    $error = $this->upload->display_errors();
                    $this->form_validation->set_rules('img', 'Profile', 'required');
                    $this->session->set_flashdata('error', 'Proile Upload Error... !');
                }
                else
                {
                    $img_data = $this->upload->data();
                    $save['image'] = $img_data['file_name'];
                }
            }

           
            if ($this->form_validation->run()==true) {
                    
                $save['name'] = $this->input->post('name');
                $save['gender'] = $this->input->post('gender');
                $save['dob'] = date("Y-m-d",strtotime($this->input->post('dob')));
                $save['email'] = $this->input->post('email');
                $save['username'] = $this->input->post('username');
                $save['password'] = sha1($this->input->post('password'));
                $save['contact'] = $this->input->post('contact');
                $save['address'] = $this->input->post('address');
                $save['user_role'] = get_staff_role_id();
                
                $p_key = $this->clients_model->save($save);
                
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $p_key,
                         'form'=> 1,
                        );    
                    
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }
                $this->session->set_flashdata('message', lang('client_created'));
                redirect('admin/clients');
            }
            
        }        
        $data['page_title'] = lang('add') . lang('client');
        $data['body'] = 'clients/add';
        $this->load->view('template/main', $data);    
    }    
    


    function add_client()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('gender', 'lang:gender', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|is_unique[users.email]');
            $this->form_validation->set_rules('username', 'lang:username', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
           
            if ($this->form_validation->run()==true) {
                
            
                $save['name'] = $this->input->post('name');
                $save['gender'] = $this->input->post('gender');
                $save['dob'] = date("Y-m-d",strtotime($this->input->post('dob')));
                $save['email'] = $this->input->post('email');
                $save['username'] = $this->input->post('username');
                $save['password'] = sha1($this->input->post('password'));
                $save['contact'] = $this->input->post('contact');
                $save['address'] = $this->input->post('address');
                $save['user_role'] = get_staff_role_id();
                
                $p_key = $this->clients_model->save($save);
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $p_key,
                         'form'=> 1,
                        );    
                    
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }
                
                echo "Success";
            }else{
            
                echo '
				<div class="alert alert-danger alert-dismissable">
												<i class="fa fa-ban"></i>
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
												<b>Alert!</b>'.validation_errors().'
											</div>
				';
            }
            
        }        
    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(1);    
        $data['clients'] = $this->clients_model->get_client_by_id($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('gender', 'lang:gender', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('username', 'lang:username', 'trim|required');
            $this->form_validation->set_rules('contact', 'lang:phone', 'required');
            if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$id) {
                $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
                $this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
            }

            $photo = array();
            $save = array();
            if($_FILES['img'] ['name'] !='') { 
                $config['upload_path'] = './assets/uploads/images/';
                $config['allowed_types'] = '*';
                $config['max_size']    = '10000';
                $config['max_width']  = '10000';
                $config['max_height']  = '6000';
                $new_name = time().'_'.$_FILES["img"]['name'];
                $config['file_name'] = $new_name;
        
                $this->load->library('upload', $config);
        
                if (!$this->upload->do_upload('img')) {
                    $error = $this->upload->display_errors();
                    $this->form_validation->set_rules('img', 'Profile', 'required');
                    $this->session->set_flashdata('error', 'Proile Upload Error... !');
                }
                else
                {
                    $img_data = $this->upload->data();
                    $save['image'] = $img_data['file_name'];
                }
            }


            if ($this->form_validation->run()) {
                
                $save['name'] = $this->input->post('name');
                $save['gender'] = $this->input->post('gender');
                $save['dob'] = date("Y-m-d",strtotime($this->input->post('dob')));
                $save['email'] = $this->input->post('email');
                $save['username'] = $this->input->post('username');
                $save['contact'] = $this->input->post('contact');
                $save['address'] = $this->input->post('address');
                $save['user_role'] = get_staff_role_id();
                if ($this->input->post('password') != '' || !$id) {
                    $save['password']    = sha1($this->input->post('password'));
                }
                
                
                $reply  = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $id,
                         'form'=> 1,
                        );    
                    
                    }    
                    $this->custom_field_model->delete_answer($id, $form=1);
                    $this->custom_field_model->save_answer($save_fields);
                }
                
                
                $this->clients_model->update($save, $id);
                $this->session->set_flashdata('message', lang('client_updated'));
                redirect('admin/clients');
            }
            
            
        }
        $data['page_title'] = lang('edit') . lang('client');
        $data['body'] = 'clients/edit';
        $this->load->view('template/main', $data);    

    }    
    
    function view_client($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(1);    
        $data['clients'] = $this->clients_model->get_client_by_id($id);
        $data['page_title'] = lang('view') . lang('client');
        $data['body'] = 'clients/view';
        $this->load->view('template/main', $data);    
    }    
    


    function delete($id=false)
    {
        $data = $this->includes;
        
        if($id) {
            $this->clients_model->delete($id);
            $this->session->set_flashdata('message', lang('client_deleted'));
            redirect('admin/clients');
        }
    }    
        
    
}
