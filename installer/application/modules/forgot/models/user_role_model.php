<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class user_role_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('user_role', $save);
    }
    
    function get_all()
    {
        return $this->db->get('user_role')->result();
    }
    
    function get_user_roles()
    {
         $this->db->where('id !=', 1);
         $this->db->where('id !=', 2);        
        return $this->db->get('user_role')->result();
    }
    
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('user_role')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('user_role', $save);
    }
    
    
    function delete($id)//delte user_role
    {
         $this->db->where('id', $id);
               $this->db->delete('user_role');
    }
    
    
    public function get_all_actions()
    {
        return $this->db->get('actions')->result();
    }
     
    public function update_permissions($data)
    {
        
        if(empty($data)) {
            $this->db->truncate('rel_role_action');
            return true;
        }else{
            $this->db->truncate('rel_role_action');
            foreach($data as $ind=>$value){
                foreach($value as $index=>$value){
                    $data = array('role_id'=>$ind,'action_id'=>$index);
                    $this->db->insert('rel_role_action', $data);
                }
            }
            return true;    
        }    
    
    } 
    
    public function get_permissions()
    {
        return $this->db->get('rel_role_action')->result();
    }
    
    public function get_action_parent_id($slug)
    {
        $this->db->where('name', $slug);
        return $this->db->get('actions')->row('id');
    }
    public function get_action_id_by_name_parent($action, $parent_id=false)
    {
        
        $this->db->select('id,always_allowed');
        $this->db->where('name', $action);
        if($parent_id) {
            $this->db->where('parent_id', $parent_id);
        }
        $res = $this->db->get('actions');
        if($res->num_rows()) {
            return $res;    
        }else {
            return false;
        }
    }
    
    public function check_is_allowed($depart_id,$action_id)
    {
        $this->db->where('role_id', $depart_id);
        $this->db->where('action_id', $action_id);
        return $this->db->get('rel_role_action')->num_rows();
    }
    
}
