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

class Banking_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function get_all_account_list()
    {
        $this->db->select('account.*');
        return $this->db->get('account')->result();
    }

    function save($save)
    {
        $this->db->insert('account', $save);
        return $this->db->insert_id();
    }

    function get_account_by_id($id)
    {
        $this->db->select('account.*');
        $this->db->where('id', $id);
        return $this->db->get('account')->row();
    }

    function update($save,$id)
    {
        $this->db->where('id', $id);
          $this->db->update('account', $save);
    }

    function delete($id)
    {
          $this->db->where('id', $id);
          $this->db->delete('account');
    }

    function get_all_transfer_list()
    {
        $this->db->select('account_transfer.*,,(select account.bank_name from account where account.id = account_transfer.from_id) as from_name,(select account.bank_name from account where account.id = account_transfer.to_id) as to_name');
        $this->db->join('account', 'account.id = account_transfer.from_id', 'left');
        return $this->db->get('account_transfer')->result();    
    }

    function get_all_account_name()
    {
        $this->db->select('id,bank_name');
        return $this->db->get('account')->result();    
    }

    function save_transfer($save)
    {
        $this->db->insert('account_transfer', $save);
        return $this->db->insert_id();
    }

    function get_transfer_by_id($id)
    {
        $this->db->select('account_transfer.*');
        $this->db->where('id', $id);
        return $this->db->get('account_transfer')->row();    
    }

    function transfer_data_update($save,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('account_transfer', $save);
    }

    function delete_transfer_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('account_transfer');    
    }
}
