<?php defined('BASEPATH') or exit('No direct script access allowed');

// load the CI class for Modular Extensions
require_once __DIR__ .'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link    http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright   Copyright (c) 2015 Wiredesignz 
 * @version     5.5
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/

#[AllowDynamicProperties]
class MX_Controller
{
    public $autoload = [];
    public $settings_data;
    public $includes;
    public $current_uri;
    public $template;
    public $error;
    public $languages;
    public $userdata;



    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // $this->load->model('update_model');
        $updates = false; // $this->update_model->get_update_data();
        $this->updation = new stdClass();

        if($updates)
        {
            foreach ($updates as $update) 
            {
                $this->updation->{$update['name']} = (@unserialize($update['value']) !== FALSE) ? unserialize($update['value']) : $update['value'];
            }
        }
        
        $site_version_array = get_setting_value_by_name('update_info');
        $site_version_array = (isset($site_version_array) && $site_version_array) ? json_decode($site_version_array) : array('');
        
        $this->updation->site_version = isset($site_version_array->current_version_name) && $site_version_array->current_version_name ? $site_version_array->current_version_name : "4.0.0";
        $this->updation->site_version_code = isset($site_version_array->current_version_code) && $site_version_array->current_version_code ? $site_version_array->current_version_code : 1;
        
        $class = CI::$APP->config->item('controller_suffix') ? str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this)) : get_class($this);
        log_message('debug', $class.' MX_Controller Initialized');
        Modules::$registry[strtolower($class)] = $this;

        excute_sql_json_query();

        // copy a loader instance and initialize
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);

        // autoload module items
        $this->load->_autoloader($this->autoload);


        $this->csrf_tokens = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
        
        $this->user_id = 0;
        if(isset($this->session->userdata['admin']) && $this->session->userdata['admin'])
        {
            $this->user_id = $this->session->userdata['admin']['id'];
            $this->userdata =  $this->session->userdata['admin'];
        }
        
        if($this->uri->segment(2)!="login" && $this->uri->segment(1)!="register" && $this->uri->segment(1)!="forgot") {
            $this->auth->check_session();
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


        $class =  CI::$APP->config->item('controller_suffix') ? str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this)) : get_class($this);
        log_message('debug', $class." MX_Controller Initialized");
        Modules::$registry[strtolower($class)] = $this;    
        
        /* copy a loader instance and initialize */
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);    
        $this->load->model("setting_model");

         $this->form_validation->set_error_delimiters('<div class="p-xx-y-b"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div></div>');
        
        
        /* autoload module items */
        $this->load->_autoloader($this->autoload);
        $this->settings = $this->setting_model->get_setting();
        
        if(!empty($this->settings->timezone)) {
            date_default_timezone_set($this->settings->timezone);
        }

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


        // get current uri
        $this->current_uri = "/" . uri_string();


        $this->output->enable_profiler(false);


    }

    function add_external_css($css_files, $path = NULL) 
    {
        // make sure that $this->includes has array value
        if (!isset($this->includes) OR !is_array($this->includes)) {
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

    function add_external_js($js_files, $path = NULL) 
    {
        // make sure that $this->includes has array value

        if (!isset($this->includes) OR !is_array($this->includes)) {
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

    /**
     * [__get description]
     *
     * @method __get
     *
     * @param  [type] $class [description]
     *
     * @return [type]        [description]
     */
    public function __get($class)
    {
        return CI::$APP->$class;
    }

    function check_user_role($action_id)
    {
        $CI = &get_instance();
        $ci_admin = $CI->session->userdata('admin');
        $access    = $ci_admin['user_role'];
            // p($ci_admin);
        if($access!=1) 
        {    
            $CI->db->where('action_id', $action_id);
            $CI->db->where('role_id', $access);
            $result = $CI->db->get('rel_role_action')->row_array();
            if($result) 
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 1;
        }
    }


    public function _remap($action, $arguments)
    {    
        $this->load->helper('url');
        $this->load->model("user_role_model");
        $allowed = false;
        $ci_admin=$this->session->userdata('admin');
        $ci_admin['user_role'] = isset($ci_admin['user_role']) ? $ci_admin['user_role'] : null;
        $ci_admin['user_role'] = isset($ci_admin['user_role']) ? $ci_admin['user_role'] : null;
        


        if($ci_admin['user_role'] != 1 OR $ci_admin['user_role'] !=2) {
            
            $controller = strtolower($this->router->class);
            $parent_id = $this->user_role_model->get_action_parent_id($controller);
            $depart_id = isset($ci_admin['user_role']) ? $ci_admin['user_role'] : null;
            $user_id = isset($ci_admin['id']) ? $ci_admin['id'] : null;    
            //echo $depart_id.'/'.$user_id.'/'.$parent_id ;exit;
            if(empty($depart_id)) {
                   $allowed=true;
            }elseif($depart_id==1) {
                $allowed=true;    
            }elseif(!is_array($parent_id) && $parent_id!='') {

                if($action=='index') {
                      
                    $res = $this->user_role_model->get_action_id_by_name_parent($controller); 
                        
                    $always_allowed = $res->row('always_allowed');
                    
                    $action_id = $res->row('id');

                    if(!$always_allowed) 
                    {
                        $is_allowed = $this->user_role_model->check_is_allowed($depart_id, $action_id);

                        if($is_allowed) 
                        {
                            $allowed=true;
                        }
                        else
                        {
                            $user_slug = get_logged_in_user_role_slug($this->session->userdata['admin']['user_role']);
                            
                            if($user_slug['slug'] == 'client')
                            {
                               $allowed=true; 

                            }
                            else
                            {
                                $allowed=false;
                            }  
                              
                        }
                    }
                    else{
                        
                        $allowed=true;
                    }
                       
                }
                elseif($res = $this->user_role_model->get_action_id_by_name_parent($action, $parent_id)) {
                       
                    $always_allowed = $res->row('always_allowed');
                    
                    $action_id = $res->row('id');
                    if(!$always_allowed) {
                        $is_allowed = $this->user_role_model->check_is_allowed($depart_id, $action_id);
                        if($is_allowed) 
                        {
                            $allowed=true;
                        }
                        else
                        {        
                            $user_slug = get_logged_in_user_role_slug($this->session->userdata['admin']['user_role']);
                            
                            if($user_slug['slug'] == 'client')
                            {
                               $allowed=true; 

                            }
                            else
                            {
                                $allowed=false;
                            } 
                        }
                    }else{
                        $allowed=true;
                    }
                }
            }else{
                $allowed=true;
            }
                

            if(@$this->session->userdata['admin']['user_role']==2 && $action=='send_message') { 
                $allowed=true;
            }
                
            if($allowed) {
                if (method_exists($this, $action)) {
                    call_user_func_array([$this, $action], $arguments);
                } else {
                    show_404();
                }
            } else {                    
                $this->session->set_flashdata('error', lang('no_access'));
                redirect('admin/dashboard', 'refresh');
            }
                
        }//END USSER ROLE FOR != 1/2
    }    
    
    
}