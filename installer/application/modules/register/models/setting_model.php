<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class setting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_setting()
    {
        return $this->db->get('settings')->row();
    }
    
    
    function get_notification_setting()
    { 
        return $this->db->get('notification_setting')->row();
    }
    
    function get_days()
    { 
        return $this->db->get('days')->result();
    }
    
    
    function update($save)
    {
        $this->db->where('id', 1);
        $this->db->update('settings', $save);
    }
    
    function update_days($key,$val)
    {
        $this->db->where('id', $key);
        $this->db->set('working_day', $val);
        $this->db->update('days');
    }
    
    function get_notification_setting_client()
    {
        $admin = $this->session->userdata('admin');
        $this->db->where('id', $admin['id']);
        return $this->db->get('users')->row();
    }
    
    
    function get_case_alert()
    {
        $this->db->where('EC.next_date <=', date("Y-m-d", strtotime("+".$this->get_notification_setting_client()->client_case_alert." days")));
        $this->db->where('EC.next_date >=', date("Y-m-d"));
        $this->db->where('EC.is_view', 0);
        $this->db->order_by('EC.next_date', 'ASC');
        $this->db->join('cases C', 'C.id = EC.case_id', 'LEFT');
        return  $this->db->get('extended_case EC')->result();
    }
    
    function get_case_alert_client()
    {
        $admin = $this->session->userdata('admin');        
        $this->db->where('EC.next_date <=', date("Y-m-d", strtotime("+".@$this->get_notification_setting()->case_alert." days")));
        $this->db->where('EC.next_date >=', date("Y-m-d"));
        $this->db->where('EC.is_view_client', 0);
        $this->db->where('client_id', $admin['id']);
        $this->db->order_by('EC.next_date', 'ASC');
        $this->db->join('cases C', 'C.id = EC.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return  $this->db->get('extended_case EC')->result();
    }
    
    function get_to_do_alert()
    {
        $this->db->where('date <', date("Y-m-d", strtotime("+".@$this->get_notification_setting()->to_do_alert." days")));
        $this->db->where('is_view', 0);
        return  $this->db->get('to_do_list')->result();
    }
    
    function get_appointment_alert()
    {        
        $this->db->where('date_time <', date("Y-m-d", strtotime("+".@$this->get_notification_setting()->appointment_alert." days")));
        $this->db->where('is_view', 0);
        return  $this->db->get('appointments')->result();        
    }
    
}
