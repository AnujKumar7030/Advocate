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

class To_do_list_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('to_do_list', $save);
        return $this->db->insert_id(); 
    }
    function to_do_view_by_admin($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_view', 1);
        $this->db->update('to_do_list');
    }
    
    function to_dos_view_by_admin($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->set('is_view', 1);
        $this->db->update('to_do_list');
    }
    
    
    function get_all()
    {
        $this->db->order_by('date', 'ASC');
        return $this->db->get('to_do_list')->result();
    }
    
    function get_all_by_date()
    {
          $this->db->order_by('date', 'ASC');
          $this->db->where('date >=', date('Y-m-d'));
        return $this->db->get('to_do_list')->result();
    }
    
    
    function get_list_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('to_do_list')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('to_do_list', $save);
    }
    
    
    function delete($id)//delte
    {
         $this->db->where('id', $id);
               $this->db->delete('to_do_list');
    }
}
