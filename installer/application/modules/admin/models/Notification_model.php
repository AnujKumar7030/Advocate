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


class Notification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_setting()
    {
         
        return $this->db->get('notification_setting')->row();
    }
    
    
    function update($save)
    {
        $this->db->where('id', 1);
        $this->db->update('notification_setting', $save);
    }
    
    
    
}
