<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Languages extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin')=="") {
            redirect('admin/login');
        }
        $this->load->model("language_model");
        $this->load->model("setting_model");



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
        $this->add_external_js(base_url('assets/js/languages/script.js'));  
    }
    


    function index($id=false)
    {
        $data = $this->includes;
        
        $data['langs'] = $this->language_model->get_all();
        $data['lang'] =    $language    =    $this->language_model->get_language_id($id);
        if($id && empty( $language ))
        {
            $this->session->set_flashdata('error', lang('something_went_wrong'));
            redirect('admin/languages');
        }

        if($this->input->server('REQUEST_METHOD') === 'POST') 
        {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:language_name', 'required');
            
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_message('direction', lang('direction_required'));
                    
            if($this->form_validation->run()==true) 
            {
                if(empty($_FILES['img'])) 
                {
                    if(empty($id))
                    {
                        $this->form_validation->set_rules('img', 'img', 'required');
                    }
                }
                if(isset($_FILES['img']['name']) && $_FILES['img']['name'])
                { 
                    $config['upload_path'] = './assets/uploads/images/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '10000';
                    $config['max_width']  = '10000';
                    $config['max_height']  = '6000';
                
                    $this->load->library('upload', $config);
                
                    if ($this->upload->do_upload('img') == false) 
                    {
                        $this->session->set_flashdata('error', lang('flag_upload_error'));
                        redirect('admin/languages');
                    }
                    else
                    {
                        $img_data = array('upload_data' => $this->upload->data());
                        $save['flag'] = $img_data['upload_data']['file_name'];
                    }
                        
                }           
                
                //create language folder and create default eng language file
                $path = site_url('application/language/');
                $language_name = strtolower($this->input->post('name'));
                $upload_config = array('upload_path' => './application/language/' . $language_name, 'allowed_types' =>
                'php|php3|php4', 'max_size' => '20000', 'max_width' => '68000', 'max_height' =>
                '43500000000', );
                
                if (!file_exists('./application/language/' . $language_name)) {
                    mkdir('./application/language/' . $language_name, 0777, true);
                }
                $eng_file    =    FCPATH.'application/language/english/admin_lang.php';
                $new_file    =    FCPATH.'application/language/'.$language_name.'/admin_lang.php';
                copy($eng_file, $new_file);
                    
                $save['name'] = strtolower($this->input->post('name'));
                $save['direction'] = strtolower($this->input->post('direction'));
                            
                if(!empty($id)) 
                {
                    $this->session->set_flashdata('message', lang('language_updated'));
                    $this->language_model->update($save, $id);
                }
                else
                {
                    $this->session->set_flashdata('message', lang('language_saved'));
                    $this->language_model->save($save);
                }
                                
                redirect('admin/languages');
                
            }
        }        
        
        
        $data['page_title'] = lang('language');
        $data['body'] = 'language/language';
        $this->load->view('template/main', $data);    

    }
    



    function switch_language($language = "",$f=false,$s=false,$t=false,$ft=false)
    {
        $data = $this->includes;
        if($language) 
        {
            $lang =    $this->language_model->get_language_id($language); 
            
            $this->session->set_userdata(
                array(
                        'lang'=> $language,
                        'direction' => $lang->direction
                    )
            );

            redirect(site_url($f.'/'.$s.'/'.$t.'/'.$ft));
        }
    }
    
    function download()
    {
        $data = $this->includes;
        $file = BASEPATH.'../application/language/english/admin_lang.php';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
    
    
    function download_lang($name)
    {
        $data = $this->includes;
        $lang = strtolower($name);
        $file = BASEPATH.'../application/language/'.$lang.'/admin_lang.php';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }


    function delete($id)
    {
        $lang    =    $this->language_model->get_language_id($id);
        
        if($lang->name == 'english')
        {
            $this->session->set_flashdata('error', lang('admin_you_cannot_delete_this_language')); 
            redirect('admin/languages');    
        }

        $data = $this->includes;
        $name = strtolower($lang->name);
        $file = BASEPATH.'../application/language/'.$name.'/admin_lang.php';
        unlink($file);
        
        $file = BASEPATH.'../application/language/'.$name;
        rmdir($file);
        
        $this->language_model->delete($id);
        
        redirect('admin/languages');
    }
    
}
