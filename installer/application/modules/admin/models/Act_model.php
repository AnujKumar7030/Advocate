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

class Act_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('acts', $save);
    }
    
    function get_all()
    {
        return $this->db->get('acts')->result();
    }
    
    function get_act_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('acts')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('acts', $save);
    }
    
    
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('acts');
    }
}
