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

class Court_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('courts', $save);
    }
    
    function get_all()
    {
        return $this->db->get('courts')->result();
    }
    
    function get_court_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('courts')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('courts', $save);
    }
    
    
    function delete($id)//delte 
    {
         $this->db->where('id', $id);
               $this->db->delete('courts');
    }
}
