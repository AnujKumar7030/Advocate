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

class Cases_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function set_is_starred($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_starred', 1);
        $this->db->update('cases');
    }

    function save_client_alert()
    {
        $admin = $this->session->userdata('admin');
        $this->db->where('id', $admin['id']);
        $this->db->set('client_case_alert', $_POST['days']);
        $this->db->update('users');
    }
    
    function case_view_by_admin($id)
    {
        $this->db->where('case_id', $id);
        $this->db->set('is_view', 1);
        $this->db->update('extended_case');
    }
    
    
    function cases_view_by_admin($ids)
    {
        $this->db->where_in('case_id', $ids);
        $this->db->set('is_view', 1);
        $this->db->update('extended_case');
    }
    
    
    function case_view_by_client($id)
    {
        $this->db->where('case_id', $id);
        $this->db->set('is_view_client', 1);
        $this->db->update('extended_case');
    }
    
    
    function restore_case($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_archived', 0);
        $this->db->update('cases');    
    
    }
    
    function set_is_archived($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_archived', 1);
        $this->db->update('cases');
    }
    
    
    function get_case_by_date()
    {
         $this->db->where('C.is_archived', 0);
        $this->db->where('EC.next_date >=', date('Y-m-d'));
        $this->db->order_by('EC.next_date', 'ASC');
        $this->db->join('extended_case EC', 'EC.case_id = C.id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function update_set_is_starred($id)
    {
        $this->db->where('id', $id);
        $this->db->set('is_starred', 0);
        $this->db->update('cases');
    }
    function save_extended_case($save)
    {
        $this->db->insert('extended_case', $save);
    }
    
    function get_all_extended_case_by_id($id)
    {
        $this->db->where('case_id', $id);
        $this->db->order_by('next_date', 'DESC');
        return $this->db->get('extended_case')->result();
    }
    
    function get_extended_case_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('extended_case')->row();
    }
    
    function save($save)
    {
        $this->db->insert('cases', $save);
        return $this->db->insert_id(); 
    }
    
    function get_all()
    {
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_client_id($id)
    {
        $this->db->where('C.client_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_client_id_starred($id)
    {
        $this->db->where('C.client_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->where('C.is_starred', 1);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_court_id($id)
    {
        $this->db->where('C.court_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_court_id_starred($id)
    {
        $this->db->where('C.court_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->where('C.is_starred', 1);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_location_id($id)
    {
        $this->db->where('C.location_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_invoice_number()
    {
        $this->db->select_max('invoice');
        return $this->db->get('fees')->row();
    }
    
    function get_cases_by_location_id_starred($id)
    {
        $this->db->where('C.location_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->where('C.is_starred', 1);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    
    function get_cases_by_case_stage_id($id)
    {
        $this->db->where('C.case_stage_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_case_stage_id_starred($id)
    {
        $this->db->where('C.case_stage_id', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->where('C.is_starred', 1);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_filing_date($id)
    {
        $this->db->where('C.start_date', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_filing_date_starred($id)
    {
        $this->db->where('C.start_date', $id);
        $this->db->where('C.is_archived', 0);
        $this->db->where('C.is_starred', 1);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_hearing_date($date)
    {
        $this->db->where('C.hearing_date', $date);
        $this->db->or_where('EC.next_date', $date);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('extended_case EC', 'C.id = EC.case_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_cases_by_hearing_date_starred($date)
    {
        $this->db->where('C.hearing_date', $date);
        $this->db->where('is_starred', 1);
        $this->db->or_where('EC.next_date', $date);
        $this->db->where('C.is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('extended_case EC', 'C.id = EC.case_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    
    function get_all_starred()
    {
        $this->db->where('is_starred', 1);
        $this->db->where('is_archived', 0);
        $this->db->select('C.*,U.name client');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
            
        return $this->db->get('cases C')->result();
    }
    
    
    
    function get_all_archived()
    {
        $this->db->where('C.is_archived', 1);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_archive_cases_by_client_id($id)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.client_id', $id);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_archive_cases_by_court_id($id)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.court_id', $id);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_archive_cases_by_location_id($id)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.location_id', $id);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    
    function get_archive_cases_by_case_stage_id($id)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.case_stage_id', $id);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    
    
    function get_archive_cases_by_filing_date($date)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.start_date', $date);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
    
    function get_archive_cases_by_hearing_date($date)
    {
        $this->db->where('C.is_archived', 1);
        $this->db->where('C.hearing_date', $date);
        $this->db->or_where('EC.next_date', $date);
        $this->db->select('C.*,U.name client,CS.name stage');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('case_stages CS', 'CS.id = C.case_stage_id', 'LEFT');
        $this->db->join('extended_case EC', 'C.id = EC.case_id', 'LEFT');
        return $this->db->get('cases C')->result();
    }
        
    function get_case_by_id($id)
    {
         $this->db->select('C.*,U.name,gender,email,contact,address');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->where('C.id', $id);
        return $this->db->get('cases C')->row();
    }
    
    
    function get_archive_case_by_id($id)
    {
         $this->db->where('C.id', $id);
         $this->db->select('C.*,AC.notes close_note,AC.close_date');
         $this->db->join('archived_cases AC', 'AC.case_id = C.id', 'LEFT');    
        return $this->db->get('cases C')->row();
    }
    
    
    
    
    function update($save,$id)
    {
         $this->db->where('id', $id);
               $this->db->update('cases', $save);
    }
    

    function save_fees($save)
    {
               $this->db->insert('fees', $save);
         return $this->db->insert_id();
    }
    
    function save_taxes($save)
    {
               $this->db->insert_batch('rel_fees_tax', $save);
               
    }
    
    function save_archived($save)
    {
               $this->db->insert('archived_cases', $save);
    }
    
    function save_receipt($save)
    {
               $this->db->insert('receipt', $save);
    }
    
    function get_receipt($id)
    {
         $this->db->where('R.id', $id);    
         $this->db->select('R.*,U.name as user,C.title,F.payment_mode_id,C.id case_id,C.fees,U.id as user_id,U.email as u_email');
          $this->db->join('fees F', 'F.id = R.fees_id', 'LEFT');
         $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
          $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
              return $this->db->get('receipt R')->row();
    }
    
    function get_receipts($id)
    {
        $this->db->where('F.case_id', $id);
        $this->db->select('R.*,');
        $this->db->join('fees F', 'F.id = R.fees_id', 'LEFT');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        return $this->db->get('receipt R')->result();
    }
    
    function get_fees_all($id)
    {
        $this->db->where('case_id', $id);
        $this->db->select('F.*,(select sum(amount) from fees where case_id = '.$id.')as bal,PM.name mode');
        $this->db->join('payment_modes PM', 'PM.id = F.payment_mode_id', 'LEFT');
        $this->db->order_by('id','asc');
        return $this->db->get('fees F')->result();
    }
        
    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('cases');
    }
    
    function delete_receipt($id)//delte receipt
    {
         $this->db->where('id', $id);
               $this->db->delete('receipt');
    }
    
    function delete_history($id)//delte client
    {
    
         $this->db->where('id', $id);
               $this->db->delete('extended_case');
    }
    
    
    function delete_fees($id)//delte client
    {
        $this->db->where_in('invoice_id', $id);
          $this->db->delete('invoice_product');
          $this->db->where('id', $id);
          $this->db->delete('fees');
    }
    
    function get_all_clients()
    {
        $user_role = get_staff_role_id();
        $this->db->where('user_role', $user_role);
        $this->db->where('employee_id', 0);
        $return  = $this->db->get('users')->result();
        return $return;
    }
    
    function get_all_courts()
    {
        return $this->db->get('courts')->result();
    }
    function get_all_courts_with_location_category()
    {
        $this->db->select('courts.*, court_categories.name as court_categorie_name, locations.name as location_name ');
        $this->db->join('court_categories', 'court_categories.id = courts.court_category_id', 'LEFT');
        $this->db->join('locations', 'locations.id = courts.location_id', 'LEFT');
        return $this->db->get('courts')->result();
    }
    
    
    function get_all_locations()
    {                
          $this->db->order_by('name', 'ASC');    
        return $this->db->get('locations')->result();
    }
    
    
    function get_all_acts()
    {
        return $this->db->get('acts')->result();
    }
    
    function get_acts_by_ids($ids)
    {                
        $this->db->where_in('id', $ids);
        return $this->db->get('acts')->result();
    }
    
    
    function get_all_case_categories()
    {
        return $this->db->get('case_categories')->result();
    }
    
    function get_all_payment_modes()
    {
        return $this->db->get('payment_modes')->result();
    }
    
    function get_case_catogries_by_ids($ids)
    {                
        $this->db->where_in('id', $ids);
        return $this->db->get('case_categories')->result();
    }
    
    function get_court_catogries_by_location($id)
    {                
        $this->db->where('location_id', $id);
        $this->db->join('court_categories CG', 'CG.id = C.court_category_id', 'LEFT');
        $this->db->select('CG.id,CG.name');
        return $this->db->get('courts C')->result();
    }

    function get_court_by_id($id)
    {                
        return $this->db->where('id', $id)->get('courts C')->row();
    }
    
    
    function get_court_by_location_c_category($l_id,$c_id)
    {                
        $this->db->where('location_id', $l_id);
        $this->db->where('court_category_id', $c_id);
        return  $this->db->get('courts C')->result();
    }
    
    
    function get_all_court_categories()
    {
        return $this->db->get('court_categories')->result();
    }
}
