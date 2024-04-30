<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Document_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('documents', $save);
    }
    
    function save_document($save)
    {
        $this->db->insert('rel_document_files', $save);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    function get_all()
    {
          $this->db->select('D.*,C.case_no,C.title case_title,C.id c_id');    
          $this->db->join('cases C', 'C.id = D.case_id', 'LEFT');
        return $this->db->get('documents D')->result();
    }
    
    function get_all_documents($id)
    {
        $this->db->select('rel_document_files.*, 
            (select name from documents_types where  documents_types.id = rel_document_files.type_id limit 1)as documents_type,
            (select color from documents_types where  documents_types.id = rel_document_files.type_id limit 1)as documents_type_color'
        );    
        $this->db->where('document_id', $id);    
        $this->db->where('user_id', '0');    
        return $this->db->get('rel_document_files')->result();
    }
    
    function get_document($id)
    {
    
        $this->db->where('id', $id);    
        return $this->db->get('rel_document_files')->row();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('documents')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('documents', $save);
    }
    
    
    function delete($id)//delte documents
    {
         $this->db->where('id', $id);
               $this->db->delete('documents');
    }
    
    
    function delete_document($id)//delte documents
    {
         $this->db->where('id', $id);
               $this->db->delete('rel_document_files');
    }
    
    function get_case_documents($id)
    {
        $this->db->where('case_id', $id);     
        return $this->db->get('documents')->result();
    } 
    
    function get_document_case($id)
    {
    
        $this->db->where('id', $id);    
        return $this->db->get('documents')->row();
    }






    function get_all_document_type()
    {
        return $this->db->order_by('created_at','desc')->get('documents_types')->result();
    }

    function save_document_type($data)
    {
        $this->db->insert('documents_types', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    function get_document_type_by_id($id)
    {
        $this->db->where('id', $id);    
        return $this->db->get('documents_types')->row();
    }

    function update_document_type($data,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('documents_types', $data);
    }
    
    function delete_document_type($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('documents_types');
    }




}
