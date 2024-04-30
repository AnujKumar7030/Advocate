<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends Public_Controller {
	
	function __construct()
    {
        parent::__construct();      
        $this->load->model('ServiceModel');
    }



    function index($slug=NULL)
    {
        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;

        $slug = urldecode($slug); 
        $service_data = $this->ServiceModel->get_service_by_slug($slug);
        if(empty($service_data)) 
        { 
        	$this->session->set_flashdata('error', lang('invalid_url')); 
            return redirect(base_url());
        }
      
       	$child_services = $this->ServiceModel->get_child_services_by_id($service_data->id);
        

        $this->set_title($service_data->name); 

        $content_data = array();
        $content_data['service_data'] = $service_data;
        $content_data['child_services'] = $child_services;
        $content_data['slug'] = $slug;

        $data = $this->includes;
        $data['content'] = $this->load->view('services', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


}
