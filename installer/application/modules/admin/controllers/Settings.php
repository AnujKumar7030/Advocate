<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Settings extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->auth->check_access('1', true);
        $this->load->model("cases_model");
        $this->load->model("setting_model");

        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-responsive-dt/css/responsive.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net/js/jquery.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-dt/js/dataTables.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/js/redactor3.js'));
        $this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/settings/script.js'));        
    }
    
    function index()
    {
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));
        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/settings/script.js'));

        $data = $this->includes;

        $data['settings'] = $this->setting_model->get_setting();
        $data['days'] = $this->setting_model->get_days();

        if($this->input->server('REQUEST_METHOD') === 'POST') 
        {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:company_name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
            if ($this->form_validation->run()==true) 
            {
                if(isset($_FILES['img'] ['name']) && $_FILES['img'] ['name']) 
                { 
                    $upload_rsp = $this->do_upload($file_data =$_FILES['img'], $file_name = 'img');

                    if($upload_rsp['status'] == 'success')
                    {
                        $save['image'] = $upload_rsp['file_name'];
                    } 
                }

                if(isset($_FILES['favicon'] ['name']) && $_FILES['favicon'] ['name']) 
                { 
                    $upload_rsp = $this->do_upload($file_data =$_FILES['favicon'], $file_name = 'favicon');
                    if ($upload_rsp['status'] == 'success')
                    {
                        $save['favicon'] = $upload_rsp['file_name'];
                    } 
                }
                    
                if (isset($_FILES['home_first_slide']['name']) && $_FILES['home_first_slide']['name']) 
                {
                    $upload_rsp = $this->do_upload($_FILES['home_first_slide'], 'home_first_slide');
                    if ($upload_rsp['status'] == 'success') 
                    {
                        $save['home_first_slide'] = $upload_rsp['file_name'];
                    }
                }
                    
                if (isset($_FILES['home_slide_second']['name']) && $_FILES['home_slide_second']['name']) 
                {
                    $upload_rsp = $this->do_upload($_FILES['home_slide_second'], 'home_slide_second');
                    if ($upload_rsp['status'] == 'success') 
                    {
                        $save['home_slide_second'] = $upload_rsp['file_name'];
                    }
                }

                    
                if (isset($_FILES['home_third_slide']['name']) && $_FILES['home_third_slide']['name']) 
                {
                    $upload_rsp = $this->do_upload($_FILES['home_third_slide'], 'home_third_slide');
                    if ($upload_rsp['status'] == 'success') 
                    {
                        $save['home_third_slide'] = $upload_rsp['file_name'];
                    }
                }

                $form_data = $this->input->post();

                if(isset($form_data['header_javascript']) && $form_data['header_javascript'])
                {
                    $save['header_javascript'] = html_entity_decode($form_data['header_javascript']);
                }

                if(isset($form_data['footer_javascript']) && $form_data['footer_javascript'])
                {
                    $save['footer_javascript'] = html_entity_decode($form_data['footer_javascript']);
                }
                
                if(isset($form_data['custom_css']) && $form_data['custom_css'])
                {
                    $save['custom_css'] = html_entity_decode($form_data['custom_css']);
                }

                
                $save['name'] = $this->input->post('name');
                $save['address'] = $this->input->post('address');
                $save['header_setting'] = $this->input->post('header_setting');
                $save['contact'] = $this->input->post('contact');
                $save['email'] = $this->input->post('email');
                $save['employee_id'] = $this->input->post('employee_id');
                $save['date_format'] = $this->input->post('date_format');
                $save['timezone'] = $this->input->post('timezone');
                $save['smtp_host'] = $this->input->post('smtp_host');
                $save['smtp_user'] = $this->input->post('smtp_user');
                $save['smtp_pass'] = $this->input->post('smtp_pass');
                $save['smtp_port'] = $this->input->post('smtp_port');
                $save['mark_out_time'] = $this->input->post('mark_out_time');
                $save['invoice_no'] = $this->input->post('invoice_no');


                $save['footer_text_heading'] = $this->input->post('footer_text_heading');
                $save['site_footer_text'] = $this->input->post('site_footer_text');
                $save['site_facebook_url'] = $this->input->post('site_facebook_url');
                $save['site_twitter_url'] = $this->input->post('site_twitter_url');
                $save['site_google_plus_url'] = $this->input->post('site_google_plus_url');
                $save['site_linkedin_url'] = $this->input->post('site_linkedin_url');
                $save['site_pininterest_url'] = $this->input->post('site_pininterest_url');
                $save['site_instagram_url'] = $this->input->post('site_instagram_url');
                $save['disable_right_click'] = $this->input->post('disable_right_click');
                $save['disable_print_screen'] = $this->input->post('disable_print_screen');
                $save['disable_copy_paste_click'] = $this->input->post('disable_copy_paste_click');
                $save['header_logo_height'] = $this->input->post('header_logo_height');
                $save['site_update_token'] = $this->input->post('site_update_token');

                $save['cookies_content_display'] = $this->input->post('cookies_content_display');
                $save['cookies_content'] = $this->input->post('cookies_content');
                $save['cookies_content_btn_text'] = $this->input->post('cookies_content_btn_text');
                $save['footer_last_row_left_text'] = $this->input->post('footer_last_row_left_text');
                $save['footer_last_row_right_text'] = $this->input->post('footer_last_row_right_text');
                $save['display_content_on_home_page'] = $this->input->post('display_content_on_home_page');
                $save['home_first_slide_text'] = $this->input->post('home_first_slide_text');
                $save['home_first_slide_button_text'] = $this->input->post('home_first_slide_button_text');
                $save['home_first_slide_button_link'] = $this->input->post('home_first_slide_button_link');
                $save['home_second_slide_text'] = $this->input->post('home_second_slide_text');
                $save['home_second_slide_button_text'] = $this->input->post('home_second_slide_button_text');
                $save['home_second_slide_button_link'] = $this->input->post('home_second_slide_button_link');
                $save['home_third_slide_text'] = $this->input->post('home_third_slide_text');
                $save['home_third_slide_button_text'] = $this->input->post('home_third_slide_button_text');
                $save['home_third_slide_button_link'] = $this->input->post('home_third_slide_button_link');
                //p($save);

                $this->setting_model->update($save);
                
                if(isset($_POST['days'])) 
                {                   
                    foreach($_POST['days'] as $key => $val)
                    {
                        $this->setting_model->update_days($key, $val);
                    }
                }  

                $last_site_update_token = $this->settings_data->site_update_token;
                $curent_site_update_token = (isset($form_data['site_update_token']) && $form_data['site_update_token']) ? $form_data['site_update_token'] : NULL;

                $this->SettingsModel->save_site_settings($curent_site_update_token,$last_site_update_token);

               
                $this->session->set_flashdata('message', lang('general_settings_updated'));
                redirect('admin/settings');
                
            }
        }        
        
        
        $data['page_title'] = lang('genral_settings');
        $data['body'] = 'setting/setting';
        $this->load->view('template/main', $data);    

    }
    
    function canned_messages()
    {
        $this->add_external_css(base_url('assets/plugins/datatables/dataTables.bootstrap.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/jquery.dataTables.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/dataTables.bootstrap.js'));
        $this->add_external_js(base_url('assets/js/canned_message/script.js'));
        $data = $this->includes;

        $data['canned_messages'] = $this->canned_message_model->get_list();
        $data['body'] = 'canned_message/canned_messages';
        $data['page_title'] = lang('canned_messages');
        $this->load->view('template/main', $data);    
    }

  
    function canned_message_form($id=false)
    {
        $this->add_external_js(base_url('assets/js/redactor3.js'));
        $this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/canned_message/script.js'));
        $data = $this->includes;

        $data['page_title'] = lang('canned_message_form');

        $data['id']         = $id;
        $data['name']       = '';
        $data['subject']    = '';
        $data['content']    = '';
        $data['deletable']  = 1;
        
        if($id) {
            $message = $this->canned_message_model->get_message($id);
                        
            $data['name']       = $message['name'];
            $data['subject']    = $message['subject'];
            $data['content']    = $message['content'];
            $data['deletable']  = $message['deletable'];
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'lang:message_name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('subject', 'lang:subject', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('content', 'lang:message_content', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $data['errors'] = validation_errors();
            
            $data['body'] = 'canned_message/canned_message_form';
            $this->load->view('template/main', $data);    
        }
        else
        {
            
            $save['id']         = $id;
            $save['name']       = $this->input->post('name');
            $save['subject']    = $this->input->post('subject');
            $save['content']    = $this->input->post('content');
            
            //all created messages are typed to order so admins can send them from the view order page.
            if($data['deletable']) {
                $save['type'] = 'order';
            }
            $this->canned_message_model->save_message($save);
            
            $this->session->set_flashdata('message', lang('message_saved_message'));
            redirect('admin/settings/canned_messages');
        }
    }
    
    function delete_message($id)
    {
        $this->canned_message_model->delete_message($id);
        
        $this->session->set_flashdata('message', lang('message_deleted_message'));
        redirect('admin/settings/canned_messages');
    }    
    
    

    public function do_upload($file_data, $file_name) 
    {
        $config['upload_path'] = "./assets/uploads/images/";
        $config['allowed_types'] = '*';
        $config['overwrite'] = TRUE;
        $new_name = time() . $file_data['name'];
        $config['file_name'] = $new_name;

        if (!is_dir($config['upload_path'])) 
        {
            mkdir($config['upload_path'], 0775, TRUE);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload($file_name) == false) 
        {
            $response['response'] = $this->upload->display_errors();
            $response['status'] = 'error';
            return $response;
        } 
        else 
        {
            $response['success'] = $this->upload->data();
            $response['status'] = 'success';
            $response['file_name'] = $this->upload->data('file_name');
            return $response;
        }
    }

        
    
}
