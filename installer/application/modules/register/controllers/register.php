<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Register extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    
    
    public function index()
    {    
        if ($this->db->table_exists('users')) {
            $this->db->where('user_role', 1);
            $admin  = $this->db->get('users')->row();
                    
            if(!empty($admin)) {
                redirect(site_url('admin/login'));
            }
        }
    
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
             $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|is_unique[users.email]');
            $this->form_validation->set_rules('username', 'lang:username', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
            $this->form_validation->set_rules('conf', 'lang:confirm_password', 'required|matches[password]');
           
            if ($this->form_validation->run()==true) {
                //$save['id'] = 1;
                $save['name'] = $this->input->post('name');
                $save['username'] = $this->input->post('username');
                $save['password'] = sha1($this->input->post('password'));
                $save['email'] = $this->input->post('email');
                $save['user_role'] = 1;
                 //echo '<pre>'; print_r($save);die;
                $this->auth->save($save);
                 $this->session->set_flashdata('message', 'Registration Success');
                redirect('admin/login');
            }
        }        

        
        $this->load->view('register');    
    }
    
    
    function check_table()
    {
        
        if ($this->db->table_exists('users')) {
            
            echo '
			    <div class="header">'.lang("register_new_admin").'</div>
            <form action="'.site_url("register").'" method="post" id="register_form">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="'.lang("name").'"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="'.lang("username").'"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="'.lang("password").'"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="conf" class="form-control" placeholder="'.lang("confirm_password").'"/>
                    </div>
					<div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="'.lang("email").'"/>
                    </div>
                </div>
                <div class="footer">

                    <button type="submit" class="btn bg-olive btn-block">Register</button>

                    
                </div>
            </form>
				';
          
        }else
        {
            echo 'error';
        }
    
    }

    

}
