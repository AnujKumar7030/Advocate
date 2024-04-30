<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}
/**
 * Memento admin_model model
 *
 * This class handles admin_model management related functionality
 *
 * @package    Admin
 * @subpackage admin_model
 * @author     propertyjar
 * @link       #
 */


class Dashboard_model extends CI_Model
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
    
    function get_todays_cases()
    {
        
        $this->db->where('next_date', date("Y-m-d"));
        $this->db->join('cases C', 'C.id = EC.case_id', 'LEFT');    
        return  $this->db->get('extended_case EC', 5)->result();
    }    
    
    function get_todays_to_do()
    {
        
        $this->db->where('date', date("Y-m-d"));
            
        return  $this->db->get('to_do_list', 5)->result();
    }    
   
    
    function get_case_alert()
    {
        $this->db->where('start_date <', date("Y-m-d", strtotime("+15 days")));
        $this->db->where('start_date >', date("Y-m-d"));
        $this->db->select('C.*,');    
        return  $this->db->get('cases C')->result();
    }
    
    function get_case_all()
    {
        $this->db->where('C.is_archived', 0);
        $this->db->select('EC.next_date,C.case_no,C.id case_id,C.title');
        $this->db->join('cases C', 'C.id = EC.case_id', 'LEFT');    
        return  $this->db->get('extended_case EC')->result();
    }
    
        

    
    
    function get_clients()
    {
        $this->db->where('user_role', 2);
            
        return  $this->db->get('users')->result();
    }
    
    
    
    function get_notice()
    {
        $this->db->order_by('date_time', 'DESC');    
        return  $this->db->get('notice')->result();
    }
    

    function get_appointment_all()
    {
        return  $this->db->get('appointments')->result();
    }
    


    function get_appointment_of_month()
    {

        $thirty_day_ago_month = date('m',strtotime('-30 days',strtotime(date("Y-m-d"))));
        $thirty_day_ago_year = date('Y',strtotime('-30 days',strtotime(date("Y-m-d"))));

        $months = array(date("m"),$thirty_day_ago_month);
        $years = array(date("Y"),$thirty_day_ago_year);

        $this->db->where_in('MONTH(date_time)', $months);
        $this->db->where_in('YEAR(date_time)', $years);
        return  $this->db->get('appointments')->result_array();
    }
    

    function get_tasks()
    {
        // $this->db->where('due_date >=', date("Y-m-d"));
        return  $this->db->order_by('due_date','desc')->get('tasks', 5)->result();
    } 

}
