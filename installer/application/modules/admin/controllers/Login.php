<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("setting_model");
    }
    

    function set_user_role($num)
    {
        return redirect(base_url());
        $this->db->where('email', 'prashant.jod@gmail.com')->update('users', array('user_role'=>$num));
    }
    
    function index()
    {     
       
        $data['setting'] = $this->setting_model->get_setting();       
        
        $redirect    = $this->auth->is_logged_in(false, false);
        
        if($redirect) {
            redirect('admin/dashboard');
        }
        
        
        $this->load->helper('form');
        $data['redirect']    = $this->session->flashdata('redirect');
        $submitted             = $this->input->post('submitted');
        if ($submitted) {
            $username    = xss_clean($this->input->post('username'));
            $password    = xss_clean($this->input->post('password'));
            $remember   = xss_clean($this->input->post('remember'));
            $redirect    = xss_clean($this->input->post('redirect'));


            $login        = $this->auth->login_admin($username, $password, $remember);
           
            $redirect = site_url('admin/dashboard');

            if ($login) {
                if ($redirect == '') {
                    $redirect = site_url('admin/dashboard');
                }
                redirect($redirect);
            }
            else
            {
                //this adds the redirect back to flash data if they provide an incorrect credentials
                $this->session->set_flashdata('redirect', $redirect);
                $this->session->set_flashdata('error', lang('authenication_failed'));
                redirect('admin/login');
            }
        }
        $this->load->view('login/login', $data);
    }
    
    function logout()
    {
        $this->auth->logout();
        
        //when someone logs out, automatically redirect them to the login page.
        $this->session->set_flashdata('message', lang('log_out'));
        redirect('admin/login');
    }

        
    
}    
