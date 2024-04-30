<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Test extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("SendMail");
    }
    


    function index()
    {
        p('hello Test');
    }

    function mail()
    {

        $status = $this->sendmail->sendTo('rajendrasingh.atn@gmail.com', "Atn Test", 'ATN', 'success');
        if($status) {
            p('success');
        }
        else
         {
            p("Error");
        }
    }
    
    
}
