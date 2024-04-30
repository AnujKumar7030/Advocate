<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PagesModel extends CI_Model 
{
    var $table = 'pages';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function pages_name_like_this($title) 
    {
        $this->db->like('title', $title);
        return $this->db->count_all_results('pages');
    }

    function page_slug_like_this($slug,$id) 
    {
        $this->db->like('slug', $slug);
        if($id)
        {
            $this->db->where('id !=', $id);
        }
        $count = $this->db->count_all_results('pages');
        return $count > 0 ? "-$count" : '';
    }
    
    function get_pages() {
        $this->_get_datatables_query();
        if ($_POST['length'] != - 1) 
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->select('pages.*')
        ->get();
        return $query->result();
    }

    function get_pages_by_id($page_id)
    {
        return $this->db->where('id',$page_id)->get('pages')->row();
    }

    function get_pages_by_slug($page_slug)
    {
        
        return $this->db->where('slug',$page_slug)->get('pages')->row();
    }

    function update_pages($pages_id, $data) 
    {
        $this->db->set($data)->where('id', $pages_id)->update('pages');
        return $this->db->affected_rows();
    }

    function delete_page($page_id) 
    {
        $this->db->where('id', $page_id)->delete('pages');
        return $this->db->affected_rows();
    }

}
