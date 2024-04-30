<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ServiceModel extends CI_Model 
{
    var $table = 'case_categories';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_service_by_id($id)
    {
        return $this->db->where('id',$id)->get('case_categories')->row();
    }

    function get_child_services_by_id($id)
    {
        return $this->db->where('parent_id',$id)->get('case_categories')->result();
    }

    function get_service_by_slug($slug)
    {
        
        return $this->db->where('slug',$slug)->get('case_categories')->row();
    }


}
