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


class Clients_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_case_by_client()
    {
        $admin = $this->session->userdata('admin');
        $this->db->where('client_id', $admin['id']);
        return $this->db->get('cases')->result();
    }
    
    
    
    function get_case_by_case_id($id)
    {
        $this->db->where('C.id', $id);
        $this->db->select('C.*,L.name location,U.name client,CT.name court,CG.name court_category');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('locations L', 'L.id = C.location_id', 'LEFT');
        $this->db->join('courts CT', 'CT.id = C.court_id', 'LEFT');
        $this->db->join('court_categories CG', 'CG.id = C.court_category_id', 'LEFT');
        return $this->db->get('cases C')->row();
    }
    function save($save)
    {
        $this->db->insert('users', $save);
        return $this->db->insert_id(); 
    }
    
    function get_all()
    {
        return $this->db->get('users')->result();
    }
    
    function get_all_clients()
    {
        $user_role = get_staff_role_id();
        $this->db->where('user_role', $user_role);
        $this->db->where('employee_id', 0);
        $return  = $this->db->get('users')->result();
        return $return;
    }
    
    function get_client_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('users', $save);
    }
    
    
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('users');
               
         $this->db->where('table_id', $id);
               $this->db->delete('rel_form_custom_fields');
    }
}
