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


class Product_service_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all()
    {
        $this->db->select('product_service.*');
        return $this->db->get('product_service')->result();
    }

    function get_all_category()
    {
        $this->db->select('id,name, parent_id');
        return $this->db->get('category')->result();
    }

    function get_all_tax()
    {
        $this->db->select('tax.*');
        return $this->db->get('tax')->result();
    }

    function save($save)
    {
        $this->db->insert('product_service', $save);
        return $this->db->insert_id();
    }

    function get_product_service_by_id($id)
    {
           $this->db->select('product_service.*,category.name as cat_name,tax.name as tax_name');    
         $this->db->join('tax', 'tax.id = product_service.tax_id', 'left');
         $this->db->join('category', 'category.id = product_service.category_id', 'left');
         $this->db->where('product_service.id', $id);
        return $this->db->get('product_service')->row();
    }

    function check_unique_sku($sku, $id)
    {
        return $this->db->where('sku', $sku)->where('id !=', $id)->get('product_service')->num_rows();
    }

    function update($save,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('product_service', $save);
    }

    function delete($id)//delte client
    {
         $this->db->where('id', $id);
               $this->db->delete('product_service');
    }
}
