<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Tax_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('tax', $save);
    }
    
    function get_all()
    {
        return $this->db->get('tax')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('tax')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('tax', $save);
    }
    
    
    function delete($id)//delte tax
    {
         $this->db->where('id', $id);
               $this->db->delete('tax');
    }
}
