<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Core Class all other classes extend
 */
class MY_Controller extends CI_Controller {
    /**
     * Common data
     */

    public $settings_data;
    public $includes;
    public $current_uri;
    public $template;
    public $error;
    public $userdata;

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
       
        // get settings_data
        $this->load->model('SettingsModel');
        $settings_data = $this->SettingsModel->get_settings();

        $this->settings_data = new stdClass();
        if($settings_data)
        {
            $this->settings_data = $settings_data;
            $this->settings_data->site_name = $settings_data->name;
        }

        $this->settings_data->site_version =  "1.0.0";

        $this->settings_data->site_version_code =  1;

        $this->user_id = 0;
        if(isset($this->session->userdata['admin']) && $this->session->userdata['admin'])
        {
            $this->user_id = $this->session->userdata['admin']['id'];
            $this->userdata =  $this->session->userdata['admin'];
        }



        $active_lang = $this->session->userdata('lang');
        if($active_lang) 
        {
            if($this->session->userdata('lang')=='english') 
            {
                $this->lang->load('admin', 'english');
            }
            else
            {
                $this->load->model('language_model');
                $this->language    =    $this->language_model->get_language_id($active_lang);
                $this->lang->load('admin', strtolower($this->language->name));
            }    
        }
        else
        {
            $this->lang->load('admin', 'english');
        }



        // get current uri
        $this->current_uri = "/" . uri_string();


        $this->output->enable_profiler(false);
    }


    function add_external_css($css_files, $path = NULL) 
    {
        // make sure that $this->includes has array value
        if (!is_array($this->includes)) {
            $this->includes = array();
        }
        // if $css_files is string, then convert into array
        $css_files = is_array($css_files) ? $css_files : explode(",", $css_files);
        foreach ($css_files as $css) {
            // remove white space if any
            $css = trim($css);
            // go to next when passing empty space
            if (empty($css)) continue;
            // using sha1($css) as a key to prevent duplicate css to be included
            $this->includes['css_files'][sha1($css) ] = is_null($path) ? $css : $path . $css;
        }
        return $this;
    }

    function add_external_js($js_files, $path = NULL) {
        // make sure that $this->includes has array value
        if (!is_array($this->includes)) {
            $this->includes = array();
        }
        // if $js_files is string, then convert into array
        $js_files = is_array($js_files) ? $js_files : explode(",", $js_files);
        foreach ($js_files as $js) {
            // remove white space if any
            $js = trim($js);
            // go to next when passing empty space
            if (empty($js)) continue;
            // using sha1($css) as a key to prevent duplicate css to be included
            $this->includes['js_files'][sha1($js) ] = is_null($path) ? $js : $path . $js;
        }
        return $this;
    }
    

    function set_title($page_title) {
        $this->includes['page_title'] = $page_title;
        /* check wether page_header has been set or has a value
         * if not, then set page_title as page_header
        */
        $this->includes['page_header'] = isset($this->includes['page_header']) ? $this->includes['page_header'] : $page_title;
        return $this;
    }
   
    function set_page_header($page_header) {
        $this->includes['page_header'] = $page_header;
        return $this;
    }

    function set_template($template_file = "template.php")
    {
        $this->template = $template_file;
    }
}
