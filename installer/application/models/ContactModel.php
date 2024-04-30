<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ContactModel extends CI_Model 
{

    private $_db;

    function __construct() 
    {
        parent::__construct();
        $this->_db = 'emails';
    }

    public function save_and_send_message($data = array()) 
    {
        if($data) 
        {
            $sql = "
            INSERT INTO {$this->_db} (
            name, email, phone_number, message, created
            ) VALUES (
            " . $this->db->escape($data['name']) . ",
            " . $this->db->escape($data['email']) . ",
            " . $this->db->escape($data['phone_number']) . ",
            " . $this->db->escape($data['message']) . ",
            '" . date('Y-m-d H:i:s') . "'
            )
            ";
            // execute query
            $this->db->query($sql);
            $id = $this->db->insert_id();
            if(1==2) 
            {
                try {
                    
                    $this->email->from($data['email'], $data['name']);
                    $this->email->to($this->settings_data->email);
                    $this->email->subject($data['phone_number']);
                    $this->email->message($data['message']);
                    $send_mail = @$this->email->send();
                    
                    if ($send_mail) 
                    {
                        return TRUE;
                    } 
                    else 
                    {
                        return FALSE;
                    }
                }
                catch(Exception $e) 
                {
                    return FALSE;
                }
            }
            if($id)
            {
                return true;
            }
        }
        return FALSE;
    }

}
