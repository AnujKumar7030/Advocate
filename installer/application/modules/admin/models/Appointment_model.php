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

class Appointment_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('appointments', $save);
        return $this->db->insert_id(); 
    }
    
    function appointment_view_by_admin($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_view', 1);
        $this->db->update('appointments');
    }
    
    function appointments_view_by_admin($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->set('is_view', 1);
        $this->db->update('appointments');
    }
    
    
    function get_appointment_by_date()
    {
                  
        $this->db->where('date_time >=', date('Y-m-d'));
        $this->db->order_by('date_time', 'ASC');
        $this->db->join('contacts C', 'C.id = A.contact_id', 'LEFT');
        return $this->db->get('appointments A')->result();
    }
    
    function get_all()
    {
        $get_user_role_slug = $this->db->select('id,slug')->where('id',$this->session->userdata('admin')['user_role'])->get('user_role')->row();

        $this->db->select('A.*,C.name name');
        $this->db->join('contacts C', 'C.id = A.contact_id', 'LEFT');
        if($get_user_role_slug->slug == 'client')
        {
            $this->db->where('contact_id',$this->session->userdata('admin')['id']);
        }
        
        return $this->db->get('appointments A')->result();
    }
    
    function get_appointment_by_id($id)
    {
         $this->db->where('A.id', $id);
         $this->db->join('contacts C', 'C.id = A.contact_id', 'LEFT');
        return $this->db->get('appointments A')->row();
    }
    
    
    function get_contacts()
    {
        return $this->db->get('contacts')->result();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('appointments', $save);
    }
    
    
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('appointments');
    }
}
