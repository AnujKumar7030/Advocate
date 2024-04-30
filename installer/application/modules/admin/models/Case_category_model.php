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


class Case_category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    function pages_name_like_this($title) 
    {
        $this->db->like('name', $title);
        return $this->db->count_all_results('case_categories');
    }

    function case_category_slug_like_this($slug,$id) 
    {
        $this->db->like('slug', $slug);
        if($id)
        {
            $this->db->where('id !=', $id);
        }
        $count = $this->db->count_all_results('case_categories');
        return $count > 0 ? "-$count" : '';
    }
    
    
    function save($save)
    {
        $this->db->insert('case_categories', $save);
    }
    
    function get_all()
    {
        $this->db->order_by('C1.name', 'ASC');
        $this->db->select('C1.*,C2.name parent');
        $this->db->join('case_categories C2', 'C2.id = C1.parent_id', 'LEFT');
        return $this->db->get('case_categories C1')->result();
    }
    
    function get_category_by_id($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('case_categories')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('case_categories', $save);
    }
    
    
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('case_categories');
    }
}
