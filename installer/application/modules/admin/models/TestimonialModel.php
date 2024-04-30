<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonialmodel extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    function get_all_testimonial()
    {
        $this->db->order_by('name','ASC');
        return $this->db->get('testimonial')->result();
    }
    

    function insert_testimonial($data) 
    {
        $this->db->insert('testimonial', $data);
        return $this->db->insert_id();
    }


    function get_testimonial_by_id($testimonial_id)
    {
        return $this->db->where('id',$testimonial_id)->get('testimonial')->row();
    }

    function update_testimonial($testimonial_id, $data) 
    {
        $this->db->set($data)->where('id', $testimonial_id)->update('testimonial');
        return $this->db->affected_rows();
    }

    function delete_testimonial($testimonial_id) 
    {
        $this->db->where('id', $testimonial_id)->delete('testimonial');
        return $this->db->affected_rows();
    }

}
