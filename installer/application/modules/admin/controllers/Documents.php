<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Documents extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("document_model");
        $this->load->model("cases_model");
        $this->load->library('form_validation');
        $this->load->helper('date_time_helper');
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
        $this->add_external_js(base_url('assets/js/documents/script.js'));
    }
    
    function index()
    {
        $data = $this->includes;
        $data['documents'] = $this->document_model->get_all();
        $data['page_title'] = lang('documents');
        $data['body'] = 'documents/list';
        $this->load->view('template/main', $data);

        
    }    
    
    function add()
    {
        $data = $this->includes;
        $data['cases'] = $this->cases_model->get_all();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
             //p('yyy');
            $this->load->library('form_validation');
            //$this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('is_case', 'Is case', 'trim');
            
           
            if ($this->form_validation->run()==true) {
                
                $save['is_case']  = $is_case = $this->input->post('is_case');
                if($is_case == 1) {
                    $save['case_id'] = $this->input->post('case_id');
                    $save['title'] = $this->input->post('title');
                }else{
                    $save['title'] = $this->input->post('title');
                }
                
                
                $this->document_model->save($save);
                $this->session->set_flashdata('message', lang('document_saved'));
                redirect('admin/documents');
            }
            
        }        
        $data['page_title'] = lang('add') . lang('document');
        $data['body'] = 'documents/add';
        $this->load->view('template/main', $data);    
    }    
    


    function edit($id=false)
    {
        $data = $this->includes;
        $data['document'] = $this->document_model->get($id);
        $data['cases'] = $this->cases_model->get_all();
        $data['id'] = $id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            //$this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('is_case', 'Is case', 'trim');
            
            if ($this->form_validation->run()) {
            
                $save['is_case']  = $is_case = $this->input->post('is_case');
                if($is_case == 1) {
                    $save['case_id'] = $this->input->post('case_id');
                    $save['title'] = $this->input->post('title');
                }else{
                    $save['title'] = $this->input->post('title');
                }
                
                $this->document_model->update($save, $id);
                $this->session->set_flashdata('message', lang('document_updated'));
                redirect('admin/documents');
            }
            
            
        }
        $data['page_title'] = lang('edit') . lang('document');
        $data['body'] = 'documents/edit';
        $this->load->view('template/main', $data);    

    }
    
    
    function download($id)
    {
        $data = $this->includes;
        $document = $this->document_model->get_document($id);
        $filename = $document->file_name;
        $this->load->helper('download');
        $data = file_get_contents(base_url('/assets/uploads/documents/'.$filename));
        force_download($filename, $data);
        exit;
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
    
    function delete_document($id)
    {
        $data = $this->includes;
        $document = $this->document_model->get_document($id);
        
        $file = BASEPATH.'../uploads/documents/'.$document->file_name;
        if (file_exists($file)) {
            unlink($file);
        }
        $this->document_model->delete_document($id);
        $this->session->set_flashdata('message', lang('document_deleted'));
        redirect('admin/documents/manage/'.$document->document_id);
    }
    function manage($id=false)
    {
        $data = $this->includes;
        $data['document'] = $this->document_model->get($id);
        $data['document_types'] = $this->document_model->get_all_document_type();
        $data['documents'] = $this->document_model->get_all_documents($id);
        $data['id'] = $id;
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            

            if(isset($_FILES['doc']['name']) && $_FILES['doc']['name']) {
                $config['upload_path'] = './uploads/documents/';
                $config['allowed_types'] = '*';
                $config['max_size']    = '10000';
                $config['max_width']  = '10000';
                $config['max_height']  = '6000';

                $ids = [];
                $files = $_FILES;
                $cpt = count($_FILES['doc']['name']);
                for($i=0; $i<$cpt; $i++)
                 {           
                    $_FILES['doc']['name']= $files['doc']['name'][$i];
                    $_FILES['doc']['type']= $files['doc']['type'][$i];
                    $_FILES['doc']['tmp_name']= $files['doc']['tmp_name'][$i];
                    $_FILES['doc']['error']= $files['doc']['error'][$i];
                    $_FILES['doc']['size']= $files['doc']['size'][$i]; 

                    $new_name = slugify_string(time().'_'.$_FILES['doc']['name']);
                    $config['file_name'] = $new_name; 
                    $this->load->library('upload', $config);

                        
                    //Title Name
                    $title = $_POST['title'][$i];
                    $type_id = $_POST['type'][$i];


                    if (!$this->upload->do_upload('doc')) {
                         $error = $this->upload->display_errors();
                         $this->session->set_flashdata('error', 'Document Upload Error... !');
                         redirect('admin/documents/manage/'.$id);
                    }
                    else
                    {
                        $img_data = $this->upload->data();
                        $save['file_name'] = $img_data['file_name'];
                        $save['document_id'] = $id;
                        $save['title'] = $title;
                        $save['type_id'] = $type_id;
                        $ids[] = $this->document_model->save_document($save);
                    }
                }

            }
            else
            {
                $this->session->set_flashdata('error', "Something Went Wrong Please Try Again ....! ");
            }                
            redirect('admin/documents/manage/'.$id);

        }    
            
        

        $data['page_title'] = lang('manage') . lang('documents');
        $data['body'] = 'documents/manage';
        $this->load->view('template/main', $data);    

    }    
    


    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->document_model->delete($id);
            $this->session->set_flashdata('message', lang('document_deleted'));
            redirect('admin/documents');
        }
    }    
        
    function set_upload_options($file_name="")
    {
        $data = $this->includes;
        //  upload an image and document options
        $config = array();
        $config['upload_path'] = BASEPATH.'../uploads/documents/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '0'; // 0 = no file size limit
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['overwrite'] = true;
        $new_name = slugify_string(time().'_'.$file_name);
        $config['file_name'] = $new_name;

        return $config;
    }

    function delete_case_document($id)
    {
        $data = $this->includes;
        //$document = $this->document_model->get_document($id);
        $case_document = $this->document_model->get_document_case($id);
        
        // $file = BASEPATH.'../uploads/documents/'.$document->file_name;
        // if (file_exists($file)) {
        //     unlink($file);
        // }
        //$this->document_model->delete_document($id);
        $this->db->where('id',$id)->delete('documents');
        $this->session->set_flashdata('message', lang('document_deleted'));
        redirect($_SERVER['HTTP_REFERER']);
    }   



    public function document_types()
    {
        $data = $this->includes;
        $data['object'] = $this->document_model->get_all_document_type();
        $data['page_title'] = lang('manage') . lang('Documents Types');
        $data['body'] = 'documents/types/list';
        $this->load->view('template/main', $data);    

    }

    public function document_types_add_update($id = null)
    {
        $data = $this->includes;
        $DataObj = false;
        if($id)
        {
            $DataObj = $this->document_model->get_document_type_by_id($id);
            if(empty($DataObj))
            {
                $this->session->set_flashdata('error', lang('something_was_wrong... !'));
                return redirect(base_url('admin/documents/types'));
            }
        }

        $data['DataObj'] = $DataObj;
        $data['id'] = $id;

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('color', lang('color'), 'required|trim');
        
        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {    


            $saveData['name'] = $this->input->post('name');
            $saveData['color'] = $this->input->post('color');
            if($id)
            {
                $saveData['updated_at'] =date("Y-m-d H:i:s");
                $this->document_model->update_document_type($saveData,$id);
                $this->session->set_flashdata('message', 'Record Update Successfully... !');
            }
            else
            {
                $saveData['created_at'] =date("Y-m-d H:i:s");
                $save_id = $this->document_model->save_document_type($saveData);

                if($save_id)
                {
                    $this->session->set_flashdata('message', 'Record Saved Successfully... !');
                }              
                else
                {
                    $this->session->set_flashdata('error', "Something Went Wrong Please Try Again ....! ");
                }
            }
            redirect('admin/documents/types');
            

        }    
            

        $data['page_title'] = lang('manage') . lang('Documents Types');
        $data['body'] = 'documents/types/form';
        $this->load->view('template/main', $data);    
    } 

    public function document_types_delete($id)
    {
        $data = $this->includes;
        $DataObj = $this->document_model->get_document_type_by_id($id);
        if(empty($DataObj))
        {
            $this->session->set_flashdata('error', lang('something_was_wrong... !'));
            return redirect(base_url('admin/documents/types'));
        }
        $status = $this->document_model->delete_document_type($id);
        if($status)
        {
            $this->session->set_flashdata('message', 'Record Update Successfully... !');
        }
        else
        {
            $this->session->set_flashdata('error', 'Detlete Operation Not Performed Successfully... !');
        }
        redirect('admin/documents/types');
    } 
    

    
}
