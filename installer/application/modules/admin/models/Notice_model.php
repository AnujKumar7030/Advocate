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

class Notice_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('notice', $save);
    }
    
    function get_all()
    {
          $this->db->order_by('date_time', 'DESC');    
        return $this->db->get('notice')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('notice')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('notice', $save);
    }
    
    
    function delete($id)//delte notice
    {
         $this->db->where('id', $id);
               $this->db->delete('notice');
    }
}
