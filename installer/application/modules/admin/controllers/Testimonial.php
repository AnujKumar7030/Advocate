<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonial extends MX_Controller {
    function __construct() 
    {
        parent::__construct();
       
        $this->load->model('TestimonialModel');
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
        $this->add_external_js(base_url('assets/js/testimonial/script.js'));
        
    }


    function index() 
    {
        $data = $this->includes;
        $data['testimonial_data'] = $this->TestimonialModel->get_all_testimonial();
        $data['page_title'] = lang('testimonial');
        $data['body'] = 'testimonial/list';
        $data['path_link'] = base_url("assets/uploads/testimonial/");
        $this->load->view('template/main', $data);  
    }

    function add() 
    {
        $data = $this->includes;
        $profile_img = NULL;
        $this->form_validation->set_rules('name', lang('testimonial_name'), 'required|trim');
        $this->form_validation->set_rules('content',lang('testimonial_message'), 'required|trim');

        if (empty($_FILES['profile']['name'])) 
        {
            $this->form_validation->set_rules('profile', lang('admin_testimonial_image'), 'required|trim');
        }
        else
        {
            $path = "./assets/uploads/testimonial/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }

            $new_name = time().$_FILES["profile"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile')) 
            {
                $file = $this->upload->data();
                $profile_img = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('profile', lang('admin_testimonial_image'), 'required|trim');
            }
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            action_not_permitted();
            $testimonial_content = array();

            $testimonial_content['name'] = $this->input->post('name',TRUE);
            $testimonial_content['content'] = $this->input->post('content',TRUE);
            if($profile_img)
            {
                $testimonial_content['profile'] = $profile_img;
            }

            $testimonial_content['added'] =  date('Y-m-d H:i:s');
            $testimonial_id = $this->TestimonialModel->insert_testimonial($testimonial_content);

            if($testimonial_id)
            {
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }

            redirect(base_url('admin/testimonial'));
        }

        $data['path_link'] = base_url("assets/uploads/testimonial/");
        $data['testimonial_id'] = NULL;
        $data['testimonial_id'] = NULL;
        $data['page_title'] = lang('add') . lang('testimonial');
        $data['body'] = 'testimonial/add';
        $this->load->view('template/main', $data); 
    }

    function update($testimonial_id = NULL) 
    {
        $data = $this->includes;
        if(empty($testimonial_id))
        {
           $this->session->set_flashdata('error', lang('invalid_url')); 
           redirect(base_url('admin/testimonial'));
        }

        $testimonial_data = $this->TestimonialModel->get_testimonial_by_id($testimonial_id);

        if(empty($testimonial_data))
        {
           $this->session->set_flashdata('error', lang('admin_invalid_id')); 
           redirect(base_url('admin/testimonial'));
        }

        $this->form_validation->set_rules('name', lang('admin_testimonial_name'), 'required|trim');
        $this->form_validation->set_rules('content', lang('admin_testimonial_message'), 'required|trim');

        if (empty($_FILES['profile']['name']) && empty($testimonial_data->profile)) 
        {
            $this->form_validation->set_rules('profile',lang('admin_testimonial_image'), 'required|trim');
        }

        $profile_img = NULL;
        if(isset($_FILES['profile']['name']) && $_FILES['profile']['name'])
        {
            $path = "./assets/uploads/testimonial/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }

            $new_name = time().$_FILES["profile"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile')) 
            {
                $file = $this->upload->data();
                $profile_img = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('profile', lang('admin_testimonial_image'), 'required|trim');
            }
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $testimonial_content = array();

            $testimonial_content['name'] = $this->input->post('name',TRUE);
            $testimonial_content['content'] = $this->input->post('content',TRUE);

            if($profile_img)
            {
                $testimonial_content['profile'] = $profile_img;
            }

            $testimonial_content['updated'] =  date('Y-m-d H:i:s');
            $page_update_status = $this->TestimonialModel->update_testimonial($testimonial_id, $testimonial_content);

            if($page_update_status)
            {
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_during_update_record')); 
            }
            
            redirect(base_url('admin/testimonial'));
        }

      
        $data['path_link'] = base_url("assets/uploads/testimonial/");
        $data['testimonial_id'] = $testimonial_id;
        $data['testimonial_data'] = $testimonial_data;
        $data['page_title'] = lang('update') . lang('testimonial');
        $data['body'] = 'testimonial/edit';
        $this->load->view('template/main', $data);  
    }

    function delete($testimonial_id = NULL)
    {

        $status = $this->TestimonialModel->delete_testimonial($testimonial_id);
        if ($status) 
        {
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));  
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/testimonial'));
    }

}
