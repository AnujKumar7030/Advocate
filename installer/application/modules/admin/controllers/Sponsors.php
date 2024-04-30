<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sponsors extends MX_Controller {
    function __construct() {
        parent::__construct();
        
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
        $this->add_external_js(base_url('assets/js/sponsors/script.js'));

        $this->load->model('SponsorsModel');
     
    }

    function index() 
    {
        $data = $this->includes;
        $data['sponsors_data'] = $this->SponsorsModel->get_all_sponsors();
        $data['page_title'] = lang('Sponsors');
        $data['body'] = 'sponsors/list';
        $data['path_link'] = base_url("assets/uploads/sponsors/");
        $this->load->view('template/main', $data);  
    }


    function add() 
    {
        $data = $this->includes;
        $sponsors_logo = NULL;

        $this->form_validation->set_rules('name', lang('admin_sponser_name'), 'required|trim');
        $this->form_validation->set_rules('link', lang('admin_sponser_link'), 'required|trim');

        if (empty($_FILES['logo']['name'])) 
        {
            $this->form_validation->set_rules('logo',lang('sponsors_logo'), 'required|trim');
        }
        else
        {

            $path = "./assets/uploads/sponsors/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }

            $new_name = time().$_FILES["logo"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) 
            {
                $file = $this->upload->data();
                $sponsors_logo = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('profile', lang('sponsors_logo'), 'required|trim');
            }
        
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $sponsors_content = array();
            $sponsors_content['name'] = $this->input->post('name',TRUE);
            $sponsors_content['link'] = $this->input->post('link',TRUE);
            if($sponsors_logo)
            {                
                $sponsors_content['logo'] = $sponsors_logo;
            }
            $sponsors_content['added'] =  date('Y-m-d H:i:s');

            $sponsors_id = $this->SponsorsModel->insert_sponsors($sponsors_content);

            if($sponsors_id)
            {                
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));                  
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }
            redirect(base_url('admin/sponsors'));
        }
            
        
        $data['path_link'] = base_url("assets/uploads/sponsors/");
        $data['sponsors_id'] = NULL;
        $data['sponsors_data'] = NULL;
        $data['page_title'] = lang('add') . lang('sponsors');
        $data['body'] = 'sponsors/add';
        $this->load->view('template/main', $data); 

    }

    function update($sponsors_id = NULL) 
    {
        if(empty($sponsors_id))
        {
           $this->session->set_flashdata('error', lang('invalid_url')); 
           redirect(base_url('admin/sponsors'));
        }

        $data = $this->includes;
        $sponsors_data = $this->SponsorsModel->get_sponsors_by_id($sponsors_id);

        if(empty($sponsors_data))
        {
           $this->session->set_flashdata('error', lang('admin_invalid_id')); 
           redirect(base_url('admin/sponsors'));
        }

        $this->form_validation->set_rules('name', lang('admin_sponser_name'), 'required|trim');
        $this->form_validation->set_rules('link', lang('admin_sponser_link'), 'required|trim');

        if (empty($_FILES['logo']['name']) && empty($sponsors_data->logo)) 
        {
            $this->form_validation->set_rules('logo',lang('sponsors_logo'), 'required|trim');
        }
        
        $sponsors_logo = NULL;
        if(isset($_FILES['logo']['name']) && $_FILES['logo']['name'])
        {
           $path = "./assets/uploads/sponsors/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }

            $new_name = time().$_FILES["logo"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) 
            {
                $file = $this->upload->data();
                $sponsors_logo = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('profile', lang('sponsors_logo'), 'required|trim');
            }
        
        }
        
        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $sponsors_content = array();
            $sponsors_content['name'] = $this->input->post('name',TRUE);
            $sponsors_content['link'] = $this->input->post('link',TRUE);

            if($sponsors_logo)
            {                
                $sponsors_content['logo'] = $sponsors_logo;
            }

            $sponsors_content['updated'] =  date('Y-m-d H:i:s');

            $page_update_status = $this->SponsorsModel->update_sponsors($sponsors_id, $sponsors_content);

            if($page_update_status)
            {
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_during_update_record')); 
            }
            redirect(base_url('admin/sponsors'));
        }


        $data['path_link'] = base_url("assets/uploads/sponsors/");
        $data['sponsors_id'] = $sponsors_id;
        $data['sponsors_data'] = $sponsors_data;
        $data['page_title'] = lang('add') . lang('sponsors');
        $data['body'] = 'sponsors/edit';
        $this->load->view('template/main', $data); 
    }

    function delete($sponsors_id = NULL)
    {

        $status = $this->SponsorsModel->delete_sponsors($sponsors_id);
        if ($status) 
        {
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));  
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/sponsors'));
    }


}
