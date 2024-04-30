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

class Department_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('departments', $save);
        return $this->db->insert_id();
    }
    
    function save_designations($save)
    {
        $this->db->insert_batch('rel_department_designation', $save);
        
    }
    
    function get_all()
    {
        return $this->db->get('departments')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('departments')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('departments', $save);
    }
    
    function get_designations($id)
    {
        $this->db->where('department_id', $id);
         return   $this->db->get('rel_department_designation')->result();
        
    }
    
    function delete($id)//delte 
    {
         $this->db->where('id', $id);
               $this->db->delete('departments');
    }
    
    function delete_designations($id)//delte
    {
         $this->db->where('department_id', $id);
               $this->db->delete('rel_department_designation');
    }
}
