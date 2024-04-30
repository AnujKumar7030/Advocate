<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Welcome extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //load in some helpers
        $this->load->helper(array('form', 'file', 'url'));
        if(file_exists(FCPATH.'application/config/setup.php')) {
            redirect(site_url().'admin/login');
        }else{
            
            redirect(site_url().'install');
                
        }

      
    }
     
    public function index()
    {
         
    }
}
