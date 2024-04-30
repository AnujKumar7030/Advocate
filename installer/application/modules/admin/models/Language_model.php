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


class Language_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    function save($save)
    {
        $this->db->insert('language', $save);
    }
    
    function update($save, $id)
    {
        $this->db->where('id', $id);    
        $this->db->update('language', $save);
    }
    
    function delete($id)
    {
        $this->db->where('id', $id);    
        $this->db->delete('language');
    }
        
    function get_all()
    {
        return $this->db->order_by('id','ASC')->get('language')->result();
    }
    
    function get_language_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('language')->row();
    }
    
    function get_language_name($name)
    {
        $this->db->where('name', $name);
        return $this->db->get('language')->row();
    }
    
    
}
