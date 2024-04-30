<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SponsorsModel extends CI_Model 
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_all_sponsors()
    {
        $this->db->order_by('name','ASC');
        return $this->db->get('sponsors')->result();
    }
    

    function insert_sponsors($data) 
    {
        $this->db->insert('sponsors', $data);
        return $this->db->insert_id();
    }


    function get_sponsors_by_id($sponsors_id)
    {
        return $this->db->where('id',$sponsors_id)->get('sponsors')->row();
    }

    function update_sponsors($sponsors_id, $data) 
    {
        $this->db->set($data)->where('id', $sponsors_id)->update('sponsors');
        return $this->db->affected_rows();
    }

    function delete_sponsors($sponsors_id) 
    {
        $this->db->where('id', $sponsors_id)->delete('sponsors');
        return $this->db->affected_rows();
    }

}
