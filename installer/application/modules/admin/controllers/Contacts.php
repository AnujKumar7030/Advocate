<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }
require FCPATH . 'vendor/autoload.php';
use Rap2hpoutre\FastExcel\FastExcel;

class Contacts extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("contact_model");
        $this->load->model("custom_field_model");
        $this->load->library('excel');

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
        $this->add_external_js(base_url('assets/js/contacts/script.js'));

    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['contacts'] = $this->contact_model->get_all();
        $data['page_title'] = lang('contacts');
        $data['body'] = 'contacts/list';
        $this->load->view('template/main', $data);    
    }    
    
    function export()
    {
        $data = $this->includes;
        $data['contacts'] = $this->contact_model->get_all();
        $this->load->view('contacts/export', $data);    
    }    
    
    
    function add()
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(4);    
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('email', 'lang:email', '');
            $this->form_validation->set_rules('phone', 'lang:phone', '');
            $this->form_validation->set_rules('address', 'lang:address', '');
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['contact'] = $this->input->post('phone');
                $save['email'] = $this->input->post('email');
                $save['address'] = $this->input->post('address');
                   $p_key = $this->contact_model->save($save);
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $p_key,
                         'form'=> 4,
                        );    
                    
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }    
                $this->session->set_flashdata('message', lang('contact_created'));   
                redirect('admin/contacts');
                
            }
        }    
        $data['page_title'] = lang('add') . lang('contact');
        $data['body'] = 'contacts/add';
        
        $this->load->view('template/main', $data);    

    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(4);
        $data['contact'] = $data['clients'] = $this->contact_model->get_contact_by_id($id);
        $data['id'] =$id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['contact'] = $this->input->post('phone');
                $save['email'] = $this->input->post('email');
                $save['address'] = $this->input->post('address');
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $id,
                         'form'=> 4,
                        );    
                    
                    }    
                    $this->custom_field_model->delete_answer($id, $form=4);
                    $this->custom_field_model->save_answer($save_fields);
                }
                $this->contact_model->update($save, $id);
                $this->session->set_flashdata('message', lang('contact_updated'));
                redirect('admin/contacts');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('contact');
        $data['body'] = 'contacts/edit';
        $this->load->view('template/main', $data);    

    }
    
    function view($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(4);
        $data['contact'] = $data['clients'] = $this->contact_model->get_contact_by_id($id);
        $data['id'] =$id;
        
        $data['page_title'] = lang('view') . lang('contact');
        $data['body'] = 'contacts/view';
        $this->load->view('template/main', $data);    

    }    
    
    // function import_old()
    // {
    //     $data = $this->includes;

    //     if ($this->input->server('REQUEST_METHOD') === 'POST') {

    //         $config['upload_path'] = './assets/uploads/files/';
    //     }
    //     $config['file_name'] = 'myfile';
    //     $config['allowed_types'] = 'xlsx|xml|xls';
    //     $config['overwrite'] = true;
    //     $this->load->library('upload', $config);
    //     $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        
    //     if (! $this->upload->do_upload('file')) {
    //         $error = array('error' => $this->upload->display_errors());
    //         $this->session->set_flashdata('error', lang('please_select_correct_file_format'));
    //         redirect(base_url("admin/contacts/"));
    //     }
    //     else
    //     {
    //         $data = array('upload_data' => $this->upload->data());
                
    //     }
          
        
    //     $inputFileName = 'assets/uploads/files/'.$data['upload_data']['file_name'];
        
    //     $inputFileType = @PHPExcel_IOFactory::identify($inputFileName);
    //     $objReader = @PHPExcel_IOFactory::createReader($inputFileType);
                        
    //                     /**
    //             * 
    //               * Define how many rows we want to read for each "chunk"  
    //             **/
    //                     $chunkSize = 1000000;
    //                     /**
    //             * 
    //               * Create a new Instance of our Read Filter  
    //             **/
    //                     $chunkFilter = new chunkReadFilter();
                        
    //                     /**
    //             * 
    //               * Tell the Reader that we want to use the Read Filter that we've Instantiated  
    //             **/
    //                     $objReader->setReadFilter($chunkFilter);
                        
    //                         $chunkFilter->setRows(0, $chunkSize);
    //                         /**
    //             * 
    //               * Load only the rows that match our filter from $inputFileName to a PHPExcel Object  
    //             **/
    //         $objPHPExcel = $objReader->load($inputFileName);
    //         $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    //         $save = array();
    //     foreach($sheetData as $ind => $values) {
    //         $save[$ind] = '';
                
    //         foreach($values as $in=>$val){
    //             if($in=='A') {
    //                 $save[$ind]['name'] = $val;
    //             }
    //             if($in=='B') {
    //                 $save[$ind]['contact'] = $val;
    //             }
    //             if($in=='C') {
    //                 $save[$ind]['email'] = $val;
    //             }
    //             if($in=='D') {
    //                 $save[$ind]['address'] = $val;
    //             }
    //         }    
    //     }
            
    //         $this->contact_model->import_data($save);
            
    //         $this->session->set_flashdata('message', lang('data_imported'));
    //         //import code end
    //         redirect(site_url("admin/contacts/"));

    // }    
    
    function import()
    {
        $data = $this->includes;

        $excel_file = time().'-'.$_FILES["file"]['name'];
        
        $path = "./assets/excel";

        if (!is_dir($path)) 
        {
            mkdir($path, 0775, TRUE);
        }
        
        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $excel_file;
        $config['remove_spaces'] = true;
        $file_ext = pathinfo($excel_file,PATHINFO_EXTENSION);
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if(!$file_ext == 'xlsx' || !$file_ext == 'xls')
        {
            $this->session->set_flashdata('error', lang('please_upload_correct_file_format'));
            redirect(base_url("admin/contacts/"));
        }
        p('eej');
        if (!$this->upload->do_upload('file')) 
        {
            $error =  $this->upload->display_errors();
            $this->session->set_flashdata('error', lang('please_select_correct_file_format'));
            redirect(base_url("admin/contacts/"));
        }
        else
        {
            $file = $this->upload->data();
            $content['category_image'] = $file['file_name'];
        }

        $import = $this->import_Excel_data($file['file_name']);

        if($import)
        { 

            $this->session->set_flashdata('message', $import['insert_count'].' '.lang('record_import_successfully').' '.$import['skip_count'].' '.lang('row_skip_during_import'));

            return redirect(base_url('admin/contacts/'));                
        }
        else
        {
            $this->session->set_flashdata('error',lang('data_import_error'));
            return redirect(base_url('admin/contacts/'));        
        }
    }
    
    private function import_Excel_data($file_name) 
    {
        $file_dir = "./assets/excel/".$file_name;    
        $contact_array = array();

        try
        {
           $contact_array = (new FastExcel)->import($file_dir);
        }
        catch (Exception $e)
        {
            $error =  lang('unable_to_read_this_file_formate');
            $this->session->set_flashdata('error', $error);
            return redirect(base_url('admin/contacts'));
        }

        $contact_array = $contact_array ? $contact_array : array();
        $contact_array = json_decode(json_encode($contact_array), true);
        
        $contact_content_array = array();

        $i = 0;
        $insert_count = 0;
        $skip_count = 0;
        
        foreach ($contact_array as $contact_detail_data) 
        { 
            $i++;
            if(empty($contact_detail_data['Name']))
            {
                break;
            }

            if($contact_detail_data['Name'])
            {
                $insert_count++;
                $contact_data['name'] = $contact_detail_data['Name'];
                $contact_data['contact'] = $contact_detail_data['Mobile Number'];
                $contact_data['email'] = $contact_detail_data['Email'];
                $contact_data['address'] = $contact_detail_data['Address'];

                $contact_content_array[] = $contact_data;
            }
            else
            {
                $skip_count++;
            }
        }

        if($contact_content_array)
        {
            $status = $this->contact_model->insert_bulk_contact($contact_content_array);
        }

        $respone['insert_count']   = $insert_count;     
        $respone['skip_count']   = $skip_count;  
        return $respone;
    }

    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->contact_model->delete($id);
            $this->session->set_flashdata('message', lang('contact_deleted'));
            redirect('admin/contacts/');
        }
    }    
        
    
}


