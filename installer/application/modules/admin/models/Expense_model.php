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

class Expense_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_bill_number()
    {
        $this->db->select_max('bill_number');
        return $this->db->get('expense')->row();
    }

    function get_all_vendors()
    {
        $this->db->where('user_role', 66);
        return $this->db->get('users')->result();
    }

    function get_vendor_by_id($id)
    {
        $this->db->where('user_role', 66);
        $this->db->where('id', $id);    
        return $this->db->get('users')->row();
    }

    function get_all_category()
    {
        $this->db->select('id,name');
        return $this->db->get('category')->result();
    }

    function get_all_tax()
    {
        return $this->db->get('tax')->result();
    }

    function get_all_product_services()
    {
        return $this->db->get('product_service')->result();
    }

    function save($save)
    {
        $this->db->insert('expense', $save);
        return $this->db->insert_id();
    }

    function get_product_name_by_id($product_id)
    {
        return $this->db->select('name')->where('id', $product_id)->get('product_service')->row();
    }

    function save_product_service_data($data)
    {
        $this->db->insert('expense_product', $data);
    }

    function get_all_expense()
    {
        $this->db->select('expense.*,U.name client,category.name as cat_name');
        $this->db->join('category', 'category.id = expense.category_id', 'LEFT');
        $this->db->join('users U', 'U.id = expense.vendor_id', 'LEFT');
        return $this->db->get('expense')->result();
    }

    function get_expense_by_id($id)
    {
        return $this->db->select('expense.*')->where('id', $id)->get('expense')->row();
    }

    function get_expense_product_by_id($id)
    {
        return $this->db->select('expense_product.*')->where('expense_id', $id)->get('expense_product')->result();
    }

    function update($save,$id)
    {
        $this->db->where('id', $id);
          $this->db->update('expense', $save);
    }

    function delete_expense_product($id)
    {
        $this->db->where_in('expense_id', $id)->delete('expense_product');
    }

    function get_product_by_id($id)
    {
        $this->db->select('product_service.*,tax.name as tax_name');
        $this->db->join('tax', 'tax.id = product_service.tax_id', 'left');
        $this->db->where('product_service.id', $id);
        return $this->db->get('product_service')->row();
    }

    function delete($id)//delte client
    {
        $this->db->where_in('expense_id', $id);
          $this->db->delete('expense_product');
          $this->db->where('id', $id);
          $this->db->delete('expense');
    }

    function get_expense_detail($id)
    {
        $this->db->where('expense.id', $id);
        $this->db->select('expense.*,U.name client,U.email,U.contact,U.address,tax.name as tax_name');
        $this->db->join('users U', 'U.id = expense.vendor_id', 'LEFT');
        $this->db->join('tax', 'tax.id = expense.tax_id', 'LEFT');
        return $this->db->get('expense')->row();
    }

    function get_setting()
    {
        return $this->db->get('settings')->row();
    }

}
