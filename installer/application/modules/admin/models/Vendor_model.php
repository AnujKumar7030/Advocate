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


class Vendor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all_vendors()
    {
        $this->db->where('user_role', 66);
        return $this->db->get('users')->result();
    }

    function save($save)
    {
        $this->db->insert('users', $save);
        return $this->db->insert_id(); 
    }

    function get_vendor_by_id($id)
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
