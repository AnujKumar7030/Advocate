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

class Location_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('locations', $save);
    }
    
    function get_all()
    {
        return $this->db->get('locations')->result();
    }
    
    function get_location_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('locations')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('locations', $save);
    }
    
    
    function delete($id)//delte 
    {
         $this->db->where('id', $id);
               $this->db->delete('locations');
    }
}
