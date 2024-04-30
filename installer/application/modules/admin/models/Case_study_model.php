<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Case_study_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('case_study', $save);
    }
    
    function get_all()
    {
        return $this->db->get('case_study')->result();
    }
    
    function save_document($save)
    {
        $this->db->insert('rel_case_study_attachments', $save);
    }
    
    function get_document($id)
    {
    
        $this->db->where('id', $id);    
        return $this->db->get('rel_case_study_attachments')->row();
    }
    
    function delete_document($id)//delte attach..
    {
         $this->db->where('id', $id);
               $this->db->delete('rel_case_study_attachments');
    }
    
    
    function get_all_documents($id)
    {
    
        $this->db->where('case_study_id', $id);    
        return $this->db->get('rel_case_study_attachments')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('case_study')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('case_study', $save);
    }
    
    
    function delete($id)//delte case_study
    {
         $this->db->where('id', $id);
               $this->db->delete('case_study');
    }
}
