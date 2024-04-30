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

class Case_stage_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('case_stages', $save);
    }
    
    function get_all()
    {
        return $this->db->get('case_stages')->result();
    }
    
    function get_case_stage_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('case_stages')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('case_stages', $save);
    }
    
    
    function delete($id)//delte case stage
    {
         $this->db->where('id', $id);
               $this->db->delete('case_stages');
    }
}
