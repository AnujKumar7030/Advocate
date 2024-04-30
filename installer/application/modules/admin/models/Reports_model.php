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

class Reports_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('acts', $save);
    }
    
    function get_earning_by_month()
    {
        $y= date("Y");
        $m= date("m");
        $d=@cal_days_in_month(CAL_GREGORIAN, $m, $y);
        
        $this->db->where('issue_date >=', date("Y-m-d", strtotime("-".$d." days")));
        $this->db->group_by('issue_date', 'ASC');
        $this->db->select('issue_date');
        $this->db->select_sum('new_total_amount');
        return $this->db->get('fees')->result();
        //p($this->db->last_query());

    }
    
    function get_earning_by_week()
    {
        $this->db->where('issue_date >=', date("Y-m-d", strtotime("- 7 days")));
        $this->db->group_by('issue_date', 'ASC');
        $this->db->select('issue_date');
        $this->db->select_sum('new_total_amount');
        return $this->db->get('fees')->result();
    }
    
    function get_earning_by_year()
    {
    
        $this->db->group_by('YEAR(issue_date)');
        $this->db->select('YEAR(issue_date) as issue_date');
        $this->db->select_sum('new_total_amount');
        $this->db->select_sum('new_total_amount');
        $this->db->where('issue_date is NOT NULL',NULL, FALSE);
        $this->db->where('new_total_amount is NOT NULL',NULL, FALSE);
        return $this->db->get('fees')->result();
        
    }
    
    function get_earning_by_client()
    {
    
        $this->db->group_by('C.client_id');
        // $this->db->select('date, U.name');
        $this->db->select('C.client_id as users_id');
        $this->db->select_sum('new_total_amount');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->where('name is NOT NULL',NULL, FALSE);
        $return =  $this->db->get('fees F')->result();
        
        if($return)
        {
            foreach($return as $key => $result)
            {
                $this->db->select('name');
                $this->db->where('id', $result->users_id);
                
                $user_data = $this->db->get('users')->row();
                if($user_data)
                {
                    $return[$key]->name = $user_data->name;
                }
                // else
                // {
                //    $return[$key]->name = NULL; 
                // }
               
            }
        }
        
        return $return;
      
    }
    
    

}
