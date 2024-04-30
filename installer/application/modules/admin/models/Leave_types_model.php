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

class Leave_types_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('leave_types', $save);
    }
    
    function get_all()
    {
        return $this->db->get('leave_types')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('leave_types')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('leave_types', $save);
    }
    
    
    function delete($id)//delte leave_types
    {
         $this->db->where('id', $id);
               $this->db->delete('leave_types');
    }
}
