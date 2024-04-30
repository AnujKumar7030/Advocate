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

class Custom_field_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function save_answer($save)
    {
        $this->db->insert_batch('rel_form_custom_fields', $save); 
    }
    
    function delete_answer($id,$form)
    {
        $this->db->where('table_id', $id);
        $this->db->where('form', $form);
        $this->db->delete('rel_form_custom_fields');
    }
    
    function get_custom_fields($form_no)
    {
        $this->db->where('form', $form_no);
        return $this->db->get('custom_fields')->result();
    
    
    }
    
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('custom_fields');
            
        $this->db->where('custom_field_id', $id);
        $this->db->delete('rel_form_custom_fields');
    }
    
    function get_all()
    {
        return $this->db->get('custom_fields')->result();
    }
    
    function get_detail($id)
    {
        $this->db->where('F.id', $id);
        $this->db->select('F.*,U.name client,PM.name mode,C.case_no,U.email,U.contact,U.address');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('payment_modes PM', 'PM.id = F.payment_mode_id', 'LEFT');
        return $this->db->get('fees F')->row();
    }
    
    
    function save($save)
    {
        $this->db->insert('custom_fields', $save);
    }
    
    
}
