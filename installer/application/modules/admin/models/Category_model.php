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


class Category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all()
    {
        $this->db->order_by('name', 'ASC');
        $this->db->select('id,name, parent_id');
        return $this->db->get('category')->result();
    }

    function save($save)
    {
        $this->db->insert('category', $save);
    }

    function get_category_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('category')->row();
    }

    function update($save,$id)
    {
        $this->db->where('id', $id);
          $this->db->update('category', $save);
    }

    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('category');
    }

}
