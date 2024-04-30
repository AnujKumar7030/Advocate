<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Updates extends MX_Controller 
    {
        function __construct() 
        {
            parent::__construct();
             
            //$this->add_external_css(base_url('assets/plugins/datatables/dataTables.bootstrap.css'));
            $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
            $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

            //$this->add_external_js(base_url('assets/plugins/datatables/jquery.dataTables.js'));
            //$this->add_external_js(base_url('assets/plugins/datatables/dataTables.bootstrap.js'));
            $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

            $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
            $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
            $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
            $this->add_external_js(base_url('assets/js/redactor3.js'));
            $this->add_external_css(base_url('assets/css/redactor.min.css'));
            $this->add_external_js(base_url('assets/js/updates/script.js')); 
            $this->load->library('form_validation');
        }

        function index()
        { 
            $data = $this->includes;
            $api_url = "";            

            $update_info_value  = get_setting_value_by_name('update_info');
            
            $update_info_json = $update_info_value ? $update_info_value : json_encode(array());
            $update_info_obj = json_decode($update_info_json);
            $update_info_array = json_decode(json_encode($update_info_obj), true);
            
            $purchase_code_updated = isset($update_info_obj->purchase_code_updated) ? $update_info_obj->purchase_code_updated : FALSE;
            
            
            if($purchase_code_updated) 
            {
                $up_info_site_update_token = $update_info_array['purchase_code'];
                $db_current_version_code = $update_info_array['current_version_code'];
                $update_version_url = $api_url."verify_purchase_code.php?purchase_token=$up_info_site_update_token&project_slug=advocate&version_current=$db_current_version_code";
                $check_for_update = $api_url."check_for_update.php?purchase_token=$up_info_site_update_token&project_slug=advocate";
                $api_response = array();
                $api_response_json = $this->get_web_page($update_version_url);
                
                $api_response = json_decode($api_response_json);
                $api_response = json_decode(json_encode($api_response), true);
                if($api_response && is_array($api_response))
                {
                    $update_info_array['purchase_code_updated'] = FALSE;
                    $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                    $update_info_array['is_verified'] = $api_response['is_verify'];
                    $update_info_array['message'] = $api_response['message'];
                } 
                else
                {
                    $update_info_array['purchase_code_updated'] = FALSE;
                    $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                    $update_info_array['is_verified'] = FALSE;
                    $update_info_array['message'] = lang("Purchase code not verified!");
                }

                $setting_update_info['update_info'] = json_encode($update_info_array);
                $this->db->update('settings',$setting_update_info);
            }

            $update_info_value  = get_setting_value_by_name('update_info');
            
            $update_info_json = $update_info_value ? $update_info_value : json_encode(array());
            $update_info_obj = json_decode($update_info_json);
            $update_info_array = json_decode(json_encode($update_info_obj), true);
            
            $purchase_code_updated = isset($update_info_obj->purchase_code_updated) ? $update_info_obj->purchase_code_updated : FALSE;

            $update_info_message = isset($update_info_obj->message) ? $update_info_obj->message : FALSE;
            
            $next_version_name = isset($update_info_obj->next_version_name) ? $update_info_obj->next_version_name : FALSE;

            $next_version_description = isset($update_info_obj->next_version_description) ? $update_info_obj->next_version_description : FALSE;
            $next_version_all_in_one_zip = (isset($update_info_obj->next_version_all_in_one_zip) && $update_info_obj->next_version_all_in_one_zip) ? $update_info_obj->next_version_all_in_one_zip : ""; 
            
            $purchase_code_is_verified = isset($update_info_array['is_verified']) ? $update_info_array['is_verified'] : FALSE;

            $is_copy_working = FALSE;
            $temp_copy_path = "./assets/uploads";
            $file_url_copy_from = "https://projects.ishalabs.com/updates/api/favicon.png";
            $file_copy_to_url = $temp_copy_path."/test.png";
            $local_current_version_code = $this->settings_data->site_version_code;

            try 
            {
                $test_copy_status = @copy($file_url_copy_from , $file_copy_to_url);
                if($test_copy_status == TRUE)
                {
                   $is_copy_working = TRUE;
                }
               
            }
            catch(Exception $e) 
            {
                $is_copy_working = FALSE;
            }



            $next_version_zip_urls = (isset($update_info_obj->next_version_zip_urls) && $update_info_obj->next_version_zip_urls) ? $update_info_obj->next_version_zip_urls : "[]";
           
            $next_version_zip_urls_array = $next_version_zip_urls;

            $next_version_zip_urls_array = json_decode(json_encode($next_version_zip_urls_array), true);
            $next_version_zip_urls_array = is_array($next_version_zip_urls_array) ? $next_version_zip_urls_array : array();

            if($this->input->post('download'))
            {
                if($is_copy_working == TRUE && $next_version_zip_urls_array)
                {
                    foreach ($next_version_zip_urls_array as $link) 
                    {

                        $temp_update_folder_path = "./assets/uploads/temp_update_folder";

                        try 
                        {
                            if(is_dir($temp_update_folder_path)) 
                            {
                                delete_files($temp_update_folder_path, true);
                            } 

                            if (!is_dir($temp_update_folder_path)) 
                            {
                                mkdir($temp_update_folder_path, 0775, TRUE);
                            }

                            $file_copy_from = $link;
                            $file_copy_to = $temp_update_folder_path."/updates.zip";
                            $copy_status = copy($file_copy_from , $file_copy_to);

                            if($copy_status == FALSE)
                            {
                                $is_copy_working = FALSE;
                                $this->session->set_flashdata('error', lang("Error During Copying Updates Files To Server !"));
                                redirect(base_url('admin/updates')); 
                            }

                            if(!is_file($temp_update_folder_path.'/updates.zip'))
                            {
                                $this->session->set_flashdata('error', lang("Updates Files Not Copyped To Server !"));
                                redirect(base_url('admin/updates')); 
                            } 
                                 
                        } 
                        catch(Exception $e) 
                        {
                            $this->session->set_flashdata('error', $e->getMessage());
                            redirect(base_url('admin/updates'));
                        }

                        try
                        { 

                            $unzip = new ZipArchive;
                            if ($unzip->open($temp_update_folder_path."/updates.zip") === TRUE) 
                            {
                                $sss = $unzip->extractTo(FCPATH);
                                if(!$sss)
                                {
                                    $this->session->set_flashdata('error', lang('Please Enable ZipArchive!'));
                                    redirect(base_url('admin/updates'));  
                                }
                                $unzip->close();
                                unlink($temp_update_folder_path."/updates.zip");
                                delete_files($temp_update_folder_path, true);
                            }
                            else
                            {
                                $this->session->set_flashdata('error', 'Can Not Read File From '.$temp_update_folder_path);
                                redirect(base_url('admin/updates'));  
                            }
                        }
                        catch(Exception $e) 
                        {
                            $this->session->set_flashdata('error', $e->getMessage());
                            redirect(base_url('admin/updates')); 
                        }
                                
                    }

                    $this->session->set_flashdata('message', lang('Update Downloaded And Verify Successfully'));
                   
                } 
                else
                {
                    $this->session->set_flashdata('error', "This action is not allowed !");
                }
                redirect(base_url('admin/updates'));
            }


            $response = $update_info_array;
            


            $data['response'] = $response;
            $data['is_copy_working'] = $is_copy_working;
            $data['purchase_code_updated'] = $purchase_code_updated;
            $data['purchase_code_is_verified'] = $purchase_code_is_verified;
            $data['update_info_message'] = $update_info_message;
            $data['next_version_name'] = $next_version_name;
            $data['next_version_description'] = $next_version_description;
            $data['next_version_all_in_one_zip'] = $next_version_all_in_one_zip;
            $data['api_url'] = $api_url;
            $data['local_current_version_code'] = $local_current_version_code;


            $data['page_title'] = lang('updates');
            $data['body'] = 'update/list';
            $this->load->view('template/main', $data);
        }




        function get_web_page($url) 
        {
            try
            {

                $options = array(
                    CURLOPT_RETURNTRANSFER => true,   // return web page
                    CURLOPT_HEADER         => false,  // don't return headers
                    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                    CURLOPT_ENCODING       => "",     // handle compressed
                    // CURLOPT_USERAGENT      => $_SERVER['HTTP_HOST'], // name of client
                    CURLOPT_USERAGENT      => base_url(), // name of client
                    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                    CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                    CURLOPT_TIMEOUT        => 120,    // time-out on response
                    CURLOPT_REFERER        => base_url(),    // 'https://m.facebook.com/', 
                );  
                
                $ch = curl_init($url);
                curl_setopt_array($ch, $options);

                $content  = curl_exec($ch);
                
                curl_close($ch);

                return $content;
            }
            catch(Exception $e) 
            {
                return json_encode(array());
            }
        }

        function check_update()
        {
            
            $api_url = "https://projects.ishalabs.com/updates/api/"; 
            
            $update_info_value  = get_setting_value_by_name('update_info');
            
            $update_info_json = $update_info_value ? $update_info_value : json_encode(array());
            $update_info_obj = json_decode($update_info_json);
            $update_info_array = json_decode(json_encode($update_info_obj), true);
            
            $purchase_code_is_verified = isset($update_info_array['is_verified']) ? $update_info_array['is_verified'] : FALSE;
            
            if($purchase_code_is_verified)
            {
                $up_info_site_update_token = $update_info_array['purchase_code'];
                $check_for_update = $api_url."check_for_update.php?purchase_token=$up_info_site_update_token&project_slug=advocate";
                $api_response = array();
                $api_response_json = $this->get_web_page($check_for_update);
                $api_response = json_decode($api_response_json);
                $api_response = json_decode(json_encode($api_response), true);
                if($api_response)
                {
                    if($api_response['is_verify'])
                    {
                        $update_info_json = $api_response['update_info_json'];
                        $setting_update_info['update_info'] = $update_info_json;
                        $status = $this->db->update('settings',$setting_update_info);
                        $this->session->set_flashdata('message', lang($api_response['message']));
                    }
                    else
                    {
                        $this->session->set_flashdata('error', lang($api_response['message']));
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', lang('its_may_be_permission_issue_or_something_went_wrong'));
                }
            }
            else
            {
                $this->session->set_flashdata('error', "Purchased code not verified");
            }
            redirect(base_url('admin/updates'));    
        }


        public function token_update()
        {
            $last_site_update_token = $this->db->get('settings')->row('site_update_token');
            
            $curent_site_update_token = $this->input->post('site_update_token');
            if($curent_site_update_token)
            {
                $save_token = array();
                $save_token['site_update_token'] = $curent_site_update_token;
                
                $update_info_obj = $this->db->get('settings')->row('update_info');

                $update_info_json = (isset($update_info_obj) && $update_info_obj) ? $update_info_obj : json_encode(array());
                $update_info_array = json_decode($update_info_json);
                $update_info_array = json_decode(json_encode($update_info_array), true);

                if($update_info_array && is_array($update_info_array))
                {
                    if($curent_site_update_token != $last_site_update_token)
                    {
                        $update_info_array['purchase_code_updated'] = TRUE;
                        $update_info_array['purchase_code'] = $curent_site_update_token;
                        $update_info_array['updated'] = date("Y-m-d H:i:s");
                    }
                }
                else
                {
                    $update_info_array['current_version_code'] = 1;
                    $update_info_array['current_version_name'] = '1.0';
                    $update_info_array['purchase_code'] = $curent_site_update_token;
                    $update_info_array['purchase_code_updated'] = TRUE;
                    $update_info_array['is_verified'] = FALSE;
                    $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                    $update_info_array['message'] = "Purchase Code Not Verify!";
                    $update_info_array['next_version_name'] = "";
                    $update_info_array['next_version_description'] = "";
                    $update_info_array['next_version_all_data'] = array();
                    $update_info_array['next_version_zip_urls'] = array();
                    $update_info_array['next_version_all_in_one_zip'] = '#';
                    $update_info_array['added'] = date("Y-m-d H:i:s");
                    $update_info_array['updated'] = date("Y-m-d H:i:s");
                }
                
                $setting_update_info['update_info'] = json_encode($update_info_array);

                $this->db->update('settings',$save_token);
                $this->db->update('settings', $setting_update_info);
            }

            redirect(base_url('admin/updates'));    
        }

        

    }