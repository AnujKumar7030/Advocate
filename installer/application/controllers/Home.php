<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Public_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->library('zip');
        $this->load->helper('directory');      
    }
	 
	public function index()
	{
		$user_id = 0; 

        $this->set_title('home |'.$this->settings_data->site_name);
        
        $sponsors =  $this->db->order_by('name','asc')->get('sponsors')->result();
        $testimonials =  $this->db->order_by('name','asc')->get('testimonial')->result();
        
        $content_data = array();
        $content_data['Page_message'] = 'welcome_to_online_quiz';
        $content_data['user_id'] = $user_id;
        $content_data['testimonials'] = $testimonials;
        $content_data['sponsors'] = $sponsors;
        $content_data['page_title'] = 'home';
        

        $data = $this->includes;
        $data['content'] = $this->load->view('home', $content_data, TRUE);

        $this->load->view($this->template, $data);
    
	}

    // function copy_test()
    // {
    //     $is_copy_working = FALSE;
    //     $temp_copy_path = FCPATH.'assets/uploads/favicon.png';
    //     $file_url_copy_from = "https://projects.ishalabs.com/updates/api/favicon.png";
    //     $file_copy_to_url = $temp_copy_path;
        
    //     echo "<pre>";
    //     echo $file_url_copy_from."    from <br/>";
    //     echo $file_copy_to_url."    to <br/>";

    //     try 
    //     {

    //         $test_copy_status = copy($file_url_copy_from , $file_copy_to_url);
    //         $errors = error_get_last();
    //         print_r($errors);

    //         if($test_copy_status == TRUE)
    //         {
    //             die('copied');
    //         }
    //         else
    //         {
    //             echo "COPY ERROR: ".$errors['type'];
    //             echo "<br />\n".$errors['message'];
    //             die('error');
    //         }
    //     }
    //     catch(Exception $e) 
    //     {
    //         die('copy error');
    //         $is_copy_working = FALSE;
    //     }
    // }
}
