<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends Public_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        // load the model file
        $this->load->model('ContactModel');
        // load the captcha helper
        $this->load->helper('captcha');
        // $this->add_js_theme('api.js');
        $this->add_external_js('https://www.google.com/recaptcha/api.js');
    }
    
    function index() 
    {
        $user_id = $this->user_id;
        $message_send = "";

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[64]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'numeric|required|trim|max_length[20]');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == FALSE) 
        {
           $errors =  $this->form_validation->error_array();
        }
        else
        {

            $this->load->model('ContactModel');

            $post_data = $this->security->xss_clean($this->input->post());
            $saved_and_sent = $this->ContactModel->save_and_send_message($post_data, $this->settings_data);
            if ($saved_and_sent) 
            {
                $this->session->set_flashdata('message', sprintf(lang('Contact Form Submit Succesfully '), $this->input->post('name', TRUE)));
                $message_send = "success";
                redirect(base_url('contact'));
                
            } 
            else 
            {
                $message_send = "error";
                $this->error = lang('Contact form Submit Error !  '). $this->input->post('name', TRUE);
                redirect(base_url('contact'));
                
            }
        }


        $flash_message = $this->session->flashdata('message');
        $flash_error = $this->session->flashdata('error');

        $page_title = "Contact Us ".$this->settings_data->site_name;
        $content_data['message_send'] = $message_send;
        $content_data['page_title'] = $page_title;
        $content_data['flash_message'] = $flash_message;
        $content_data['flash_error'] = $flash_error;
        $this->set_title($page_title);
        $data = $this->includes;
        $data['content'] = $this->load->view('contactus', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}
