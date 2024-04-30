<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Attendance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function save($save)
    {
        $this->db->insert('attendance', $save);
        return $this->db->insert_id();
    }
    function get_null_attendance()
    {
        $this->db->where('date(mark_in) !=', date("Y-m-d"));
        $this->db->where('mark_out IS NULL');
        return $this->db->get('attendance')->result();
    }
    function get_employees()
    {
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
            $this->db->where('U.id', $_POST['employee_id']);
        }
                    $this->db->where('user_role !=', 1);
                    $this->db->where('user_role !=', 2);
                    $this->db->select('U.*,UR.name role');
                    $this->db->join('user_role UR', 'UR.id = U.user_role', 'LEFT');
        return $this->db->get('users U')->result();
    }
    
    function get_employee()
    {
        $admin = $this->session->userdata('admin');
                    $this->db->where('U.id', $admin['id']);
        $this->db->where('user_role !=', 1);
        $this->db->where('user_role !=', 2);
        $this->db->select('U.*,UR.name role');
        $this->db->join('user_role UR', 'UR.id = U.user_role', 'LEFT');
        return $this->db->get('users U')->result();
    }
    
    
    function update_leave($save,$id)
    {
        $this->db->where('id', $id);    
        $this->db->update('leaves', $save);
        
    }
    
    function save_apply_leave($save)
    {
        $this->db->insert_batch('leaves', $save); 
    }
    
    function get_all()
    {
        return $this->db->get('attendance')->result();
    }
    
    function get_leave_notification()
    {
         $this->db->where('L.date >=', date("Y-m-d"));
         $this->db->where('L.status', 0);
         $this->db->select('L.*,LT.name leave_type,U.name user');
         $this->db->order_by('date', 'DESC');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
         $this->db->join('users U', 'U.id = L.user_id', 'LEFT');
        return $this->db->get('leaves L')->result();

    
    }
    function get_all_leaves()
    {
         $this->db->select('L.*,LT.name leave_type,U.name user');
         $this->db->order_by('date', 'DESC');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
         $this->db->join('users U', 'U.id = L.user_id', 'LEFT');
        return $this->db->get('leaves L')->result();
    }
    
    function get_todays_leaves()
    {
         $this->db->select('L.*,LT.name leave_type,U.name user');
         $this->db->where('date', date("Y-m-d"));
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
         $this->db->join('users U', 'U.id = L.user_id', 'LEFT');
        return $this->db->get('leaves L')->result();
    }
    
    function get_leave_by_id($id)
    {
         $this->db->select('L.*,LT.name leave_type,U.name user,U.email');
         $this->db->order_by('date', 'DESC');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
         $this->db->join('users U', 'U.id = L.user_id', 'LEFT');
        return $this->db->get('leaves L')->result();
    }
    
    function get_attendance($date)
    {
        
    }

    function get_attendance_by_user($id,$date)
    {
        $date = explode("-", $date);
        return $this->db->query("SELECT TIMEDIFF(mark_out, mark_in) as diff,id,mark_in,mark_out,user_id FROM attendance where user_id = ".$id." AND day(mark_in)=".$date[2]."  AND month(mark_in)=".$date[1]." AND year(mark_in)=".$date[0]."  ")->result();
    }
    
    function check_date_is_leave_by_id($id,$date)
    {
         $this->db->where('user_id', $id);
         $this->db->where('date', $date);
         $this->db->where('status', 1);
         $this->db->select('L.*,LT.name leave_type');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
        return $this->db->get('leaves L')->row();
    }
    
    function check_today_is_leave()
    {
        $admin = $this->session->userdata('admin');
         $this->db->where('user_id', $admin['id']);
         $this->db->where('date', date("Y-m-d"));
         $this->db->where('status', 1);
         $this->db->select('L.*,LT.name leave_type');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
        return $this->db->get('leaves L')->row();
    }
    function get_my_leaves()
    {
        $admin = $this->session->userdata('admin');
         $this->db->where('user_id', $admin['id']);
         $this->db->order_by('date', 'DESC');
         $this->db->select('L.*,LT.name leave_type');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
        return $this->db->get('leaves L')->result();
    }
    function get_my_leaves_id($id)
    {
        $admin = $this->session->userdata('admin');
         $this->db->where('user_id', $admin['id']);
         $this->db->where('L.id', $id);
               
         $this->db->select('L.*,LT.name leave_type');
         $this->db->join('leave_types LT', 'LT.id = L.leave_type_id', 'LEFT');
        return $this->db->get('leaves L')->row();
    
    }
    function get_attendance_today()
    {
        $admin = $this->session->userdata('admin');
         $this->db->where('user_id', $admin['id']);
               
         $this->db->select_max('id');
         $this->db->where('date(mark_in)', date("Y-m-d"));
        $max_value =  $this->db->get('attendance')->row();
        $admin = $this->session->userdata('admin');
         $this->db->where('user_id', $admin['id']);
        if(isset($max_value)) {  
            $this->db->where('id', $max_value->id);
        }
               $this->db->select('attendance.*');
               $this->db->where('date(mark_in)', date("Y-m-d"));
        return $this->db->get('attendance')->row();
    }
    function get($id)
    {
         $this->db->where('id', $id);
        return $this->db->get('attendance')->row();
    }
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('attendance', $save);
    }
    
    
    function delete_my_leave($id)//delte leave
    {
         $this->db->where('id', $id);
               $this->db->delete('leaves');
    }
}
