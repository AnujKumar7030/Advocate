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

class Court_category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('court_categories', $save);
    }
    
    function get_all()
    {
        return $this->db->get('court_categories')->result();
    }
    
    function get_category_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('court_categories')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('court_categories', $save);
    }
    
    
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('court_categories');
    }
}
