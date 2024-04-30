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

class Contact_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function import_data($save)
    {
        $this->db->insert_batch('contacts', $save); 
    }
    
    function save($save)
    {
        $this->db->insert('contacts', $save);
        return $this->db->insert_id(); 
    }
    
    function get_all()
    {
        return $this->db->get('contacts')->result();
    }
    
    function get_contact_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('contacts')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('contacts', $save);
    }
    
    
    function delete($id)//delte contact
    {
         $this->db->where('id', $id);
               $this->db->delete('contacts');
    }

    function insert_bulk_contact($data)
    {
        return $this->db->insert_batch('contacts', $data);
    } 
}
