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

class Invoice_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_detail($id)
    {
        $this->db->where('F.id', $id);
        $this->db->select('F.*,U.name client,PM.name mode,C.case_no,U.email,U.contact,U.address,tax.name as tax_name');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('payment_modes PM', 'PM.id = F.payment_mode_id', 'LEFT');
        $this->db->join('tax', 'tax.id = F.new_tax_id', 'LEFT');
        return $this->db->get('fees F')->row();
    }
    
    
    function get_taxes($id)
    {
        $this->db->where('F.id', $id);
        $this->db->select('T.*,');
        $this->db->join('rel_fees_tax R', 'R.fees_id = F.id', 'LEFT');
        $this->db->join('tax T', 'T.id = R.tax_id', 'LEFT');
        return $this->db->get('fees F')->result();
    }
    
    function get_all_invoice()
    {
        $this->db->select('F.*,U.name client');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        return $this->db->get('fees F')->result();
    }

    function get_all_category()
    {
        $this->db->select('id,name');
        return $this->db->get('category')->result();
    }

    function get_all_cases()
    {
        $this->db->select('cases.*');
        return $this->db->get('cases')->result();
    }    

    function get_all_product_services()
    {
        return $this->db->get('product_service')->result();
    }

    function get_all_tax()
    {
        return $this->db->get('tax')->result();
    }

    function get_invoice_number()
    {
        $this->db->select_max('invoice');
        return $this->db->get('fees')->row();
    }

    function get_client_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }
    function get_case_by_id($id)
    {
        $this->db->select('C.*,U.name,gender,email,contact,address');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->where('C.id', $id);
        return $this->db->get('cases C')->row();
    }
    function get_product_by_id($id)
    {
        $this->db->select('product_service.*,tax.name as tax_name');
        $this->db->join('tax', 'tax.id = product_service.tax_id', 'left');
        $this->db->where('product_service.id', $id);
        return $this->db->get('product_service')->row();
    }

    function save($save)
    {
        $this->db->insert('fees', $save);

        return $this->db->insert_id();
    }

    function get_product_name_by_id($product_id)
    {
        return $this->db->select('name')->where('id', $product_id)->get('product_service')->row();
    }

    function save_product_service_data($data)
    {
        $this->db->insert('invoice_product', $data);

    }

    function get_invoice_by_id($id)
    {
        return $this->db->select('fees.*')->where('id', $id)->get('fees')->row();
    }

    function get_invoice_product_by_id($id)
    {
        return $this->db->select('invoice_product.*')->where('invoice_id', $id)->get('invoice_product')->result();
    }

    function update($save,$id)
    {
        $this->db->where('id', $id);
          $this->db->update('fees', $save);
    }

    function delete_invoice_product($id)
    {
        $this->db->where_in('invoice_id', $id)->delete('invoice_product');
    }

    function delete($id)//delte client
    {
        $this->db->where_in('invoice_id', $id);
          $this->db->delete('invoice_product');
          $this->db->where('id', $id);
          $this->db->delete('fees');
    }

    function get_invoice_by_id_with_client($id)
    {
        return $this->db->select('fees.*,users.name,dob,email,contact,address,gender, tax.name as tax_name')->join('cases', 'cases.id = fees.case_id', 'left')->join('users', 'users.id = cases.client_id', 'left')->join('tax', 'tax.id = fees.new_tax_id', 'left')->where('fees.id', $id)->get('fees')->row();
    }

    function get_detail_by_invoice_id($id)
    {
        $this->db->where('F.id', $id);
        $this->db->select('F.*,U.name client,PM.name mode,C.case_no,U.email,U.contact,U.address');
        $this->db->join('cases C', 'C.id = F.case_id', 'LEFT');
        $this->db->join('users U', 'U.id = C.client_id', 'LEFT');
        $this->db->join('payment_modes PM', 'PM.id = F.payment_mode_id', 'LEFT');
        return $this->db->get('fees F')->row();
    }

    function get_setting()
    {
        return $this->db->get('settings')->row();
    }
}
