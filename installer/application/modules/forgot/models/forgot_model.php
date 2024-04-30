<?php
class forgot_model  extends CI_Model
{   
    function get_user_by_email($email)
    {
        $result = $this->db->get_where('admin', array('email'=>$email));
        return $result->row_array();
    }
    
    function get_admin_by_code($code)
    {
        $this->db->where("token", $code);
        $this->db->select("email");
        $this->db->limit(1);
        $result = $this->db->get('users')->result(); 
        
        if (sizeof($result) > 0) {
            return $result; 
        }
        else
        {
            $this->session->set_flashdata('error', "Reset Password Failed");
            redirect(base_url(''));
         
        }
    }    
    
    function save_password($save,$email)
    {
        $this->db->where('email', $email);
        $this->db->update('users', $save);
        
    }
    
    function save_user_info($save)
    {
        $this->db->insert('users', $save);
    }
    
    private function get_admin_by_email($email)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $result = $this->db->get('users');
        $result = $result->row_array();

        if (sizeof($result) > 0) {
            return $result; 
        }
        else
        {
            return false;
        }
    }
    
    function edit_admin_to_save_code($email,$token) //save randon string in admin by email
    {

        $admin_email = $this->get_admin_by_email($email);
        $this->load->library("SendMail");

        if ($admin_email['email']) {    
            
           
            $res = $this->db->where('id', '1')->get('canned_messages');
            $row = $res->row_array();
        
            $result = $this->db->where('id', '1')->get('settings');
            $settings = $result->row();

            $link = site_url('forgot/forgot_password/reset_password/' . $token['token']);
                        
            $row['content'] = str_replace('{reset_link}', $link, $row['content']);
            $row['subject'] = str_replace('{site_name}', $settings->name, $row['subject']);
            
            
            $row['subject'] = str_replace('{site_name}', $settings->name, $row['subject']);
            $row['content'] = str_replace('{site_name}', $settings->name, $row['content']);
            $row['content'] = str_replace('{customer_name}', $admin_email['name'], $row['content']);
            $row['content'] = str_replace('{username}', $admin_email['username'], $row['content']);
                
                
            $this->db->where('email', $admin_email['email']);
            $this->db->update('users', $token);
            $user_email = $admin_email['email'];


            $status = $this->sendmail->sendTo($user_email, $row['subject'], $settings->name, html_entity_decode($row['content']));
            if($status) 
            {
                $this->session->set_flashdata('message', lang('reset_password_link_send_to_email'));
                redirect(site_url('forgot/forgot_password'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('Error!'));
                redirect(site_url('forgot/forgot_password'));
            }                
        }
        else
        {
            $this->session->set_flashdata('error', lang('password_not_macthed'));
            redirect(site_url('forgot/forgot_password'));
         
        }        
    }

    
    
    
}
