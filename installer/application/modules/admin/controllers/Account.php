<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Account extends MX_Controller
{
 
    public function __construct()
    {
        parent::__construct();
        if($this->user_id == 0)
        {
            return redirect(base_url('admin/login'));
        }
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-responsive-dt/css/responsive.dataTables.min.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net/js/jquery.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-dt/js/dataTables.dataTables.min.js'));
        $this->add_external_js(base_url('assets/js/account/script.js'));
    }
    

    
    function index($id = false)
    {    
        if($id == false)
        {
            $id = $this->user_id;
        }
        
        $data = $this->includes;
        $data['page_title']        = lang('user_account');
        
        $data['id']        = '';
        $data['name']    = '';
        $data['email']        = '';
        $data['username']    = '';
        $data['image']        = '';
        
        if ($id) 
        {    
            $this->admin_id        = $id;
            $admin            = $this->auth->get_admin($id);
            //if the administrator does not exist, redirect them to the admin list with an error
            if (!$admin) {
                $this->session->set_flashdata('message', lang('admin_not_found'));
                redirect('admin/dashboard');
            }
            //set values to db values
            $data['id']            = $admin->id;
            $data['name']        = $admin->name;
            $data['email']        = $admin->email;
            $data['username']    = $admin->username;
            $data['access']        = $admin->user_role;
            $data['image']        = $admin->image;
        }
        
        $this->form_validation->set_rules('name', 'lang:name', 'trim|max_length[32]');
        $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('username', 'lang:username', 'trim|required|max_length[128]|callback_check_username');
        
        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$id) {
            $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
            $this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
        }
        
        if ($this->form_validation->run() == false) {
            $data['body'] = 'account/admin_form';
            $this->load->view('template/main', $data);
        }
        else
        {
            $save['id']        = $id;
            $save['name']    = $this->input->post('name');
            $save['email']        = $this->input->post('email');
            $save['username']    = $admin->username;
            
            if ($this->input->post('password') != '' || !$id) {
                $save['password']    = $this->input->post('password');
            }
            
            if($this->config->item('demo_site')) {
                $this->session->set_flashdata('error', lang('demo_mode'));
            } else {
                $this->auth->save($save);
                $this->session->set_flashdata('message', lang('admin_saved'));
            }
            
            //go back to the customer list
            redirect(base_url('admin/dashboard'));
        }
    }

    
    
    function form($id = false)
    {  
        $data = $this->includes;
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        $data['title']        = lang('user_profile');
        
        
        //default values are empty if the customer is new
        $data['id']        = '';
        $data['name']    = '';
        $data['email']        = '';
        $data['username']    = '';
        $data['image']        = '';
                
        
        if ($id) 
        {    
            $this->admin_id        = $id;
            $admin                = $this->auth->get_admin($id);
            //if the administrator does not exist, redirect them to the admin list with an error
            if (!$admin) 
            {
                $this->session->set_flashdata('message', lang('admin_not_found'));
                redirect($this->config->item('admin_folder').'/admin');
            }
            //set values to db values
            $data['id']            = $admin->id;
            $data['name']        = $admin->name;
            $data['email']        = $admin->email;
            $data['username']    = $admin->username;
            $data['image']        = $admin->image;
            $admin_data = $this->session->userdata('admin');
            $this->form_validation->set_rules('name', 'lang:name', 'trim|max_length[32]');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
        
            //if this is a new account require a password, or if they have entered either a password or a password confirmation
            
            //$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
            //$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
            
        
            if ($this->form_validation->run() == false) 
            {
                $data['body'] = 'account/admin_form';
                $this->load->view('template/main', $data);
            }
            else
            {
                
                // $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
                // $this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
                
                if ($this->form_validation->run() == false) 
                {
                    $data['body'] = 'account/admin_form';
                    $this->load->view('template/main', $data);
                }
                else
                {
                    $updatedata['id']            = $admin_data['id'];

                    $updatedata['name']        = $this->input->post('name') ? $this->input->post('name') : $admin_data['name'];

                    $updatedata['email']        = $this->input->post('email') ? $this->input->post('email') : $admin_data['email'];
                    
                    $updatedata['username']    = $this->input->post('username') ? $this->input->post('username') : $admin_data['username'];

                    $updatedata['image']        = $admin_data['image'];
                   
                    if($_FILES['img']['name'] !='') 
                    { 
                        $config['upload_path'] = './assets/uploads/images/';
                        $config['allowed_types'] = '*';
                        
                        $file_ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);

                        if($file_ext == 'png' || $file_ext == 'jpeg' || $file_ext == 'jpg')
                        {
                            $this->load->library('upload', $config);

                            if (!$this->upload->do_upload('img')) 
                            {
                                $img_data = $this->upload->display_errors();          
                            }
                            else
                            {
                                $img_data = $this->upload->data();
                            }
                            $updatedata['image'] = $img_data['file_name'];
                        }
                        else
                        {
                            $this->session->set_flashdata('error', lang('file_extention_not_allowed'));
                            redirect('admin/account');
                        }
                    }
                    
                    if ($this->input->post('password') != '') 
                    {
                        $new_password    = sha1($this->input->post('password'));
                        $updatedata['password']    = $new_password;
                    }
                    
                    $this->db->where('id', $admin_data['id'])->update('users', $updatedata);
                
                    $this->session->set_flashdata('message', lang('admin_updated'));
                    redirect('admin/account');
                }
            }
        }
    }
    
    function check_username($str)
    {
        $data = $this->includes;
        $email = $this->auth->check_username($str, $this->admin_id);
        if ($email) {
            $this->form_validation->set_message('check_username', lang('username_is_taken'));
            return false;
        }
        else
        {
            return true;
        }
    }
    
}
