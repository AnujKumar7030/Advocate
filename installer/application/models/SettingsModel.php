<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SettingsModel extends CI_Model 
{

    private $_db;

    function __construct() 
    {
        parent::__construct();
        $this->_db = 'settings';
    }

    function get_settings() 
    {
        return $this->db->get($this->_db)->row();
    }


    function save_site_settings($curent_site_update_token, $last_site_update_token)
    {
        $update_info_obj = $this->db->get('settings')->row('update_info');
        $update_info_json = $update_info_obj ? $update_info_obj : json_encode(array());
        $update_info_array = json_decode($update_info_json);
        $update_info_array = json_decode(json_encode($update_info_array), true);

		$update_info_array['purchase_code_updated'] = TRUE;
		$update_info_array['purchase_code'] = $curent_site_update_token;
		$update_info_array['updated'] = date("Y-m-d H:i:s");
		$update_info_array['is_verified'] = TRUE;
		$update_info_array['last_updated'] = date("Y-m-d H:i:s");
		$update_info_array['message'] = "Purchase Code Verified!";

        $setting_update_json_info['update_info'] = json_encode($update_info_array);
        $this->db->update('settings', $setting_update_json_info);
       
    }


}
