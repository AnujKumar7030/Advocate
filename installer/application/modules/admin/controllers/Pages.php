<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("pages_model");

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
        
        $this->add_external_js(base_url('assets/js/pages/script.js'));

	}
	
	
	function index(){
		$data = $this->includes;
		$data['page_data'] = $this->pages_model->get_all();
		$data['page_title'] = lang('Content') ." ". lang('Pages');
		$data['body'] = 'pages/list';
		$this->load->view('template/main', $data);	
	}	
	
	function add()
	{
		$data = $this->includes;
		$featured_image = NULL;
        $this->form_validation->set_rules('title', lang('admin_page_title'), 'required|trim|is_unique[pages.title]');
        $this->form_validation->set_rules('content', lang('admin_page_content'), 'required|trim');

        if (empty($_FILES['featured_image']['name'])) 
        {
            $this->form_validation->set_rules('featured_image', lang('admin_page_image'), 'required|trim');
        }
        else
        {
            $path  = "./assets/uploads/page/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }

			$new_name = time().$_FILES["featured_image"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('featured_image')) 
            {
                $file = $this->upload->data();
                $featured_image = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('featured_image', lang('image'), 'required|trim');
            }
        
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else
        {
 			$page_content = array();

            $title_slug = slugify_string($this->input->post('title',TRUE));
            $slug_count = $this->pages_model->page_slug_like_this($title_slug,NULL);

            $page_content['title'] = $this->input->post('title',TRUE);
            $page_content['slug'] = $title_slug.$slug_count;
            $page_content['content'] = $this->input->post('content',TRUE);
            $page_content['on_menu'] = $this->input->post('on_menu',TRUE) ? 1 : 0;
            $page_content['meta_title'] =  $this->input->post('metatitle');
            $page_content['meta_keywords'] =  $this->input->post('metakeywords');
            $page_content['meta_description'] =  $this->input->post('metadescription');

            if($featured_image)
            {                
                $page_content['featured_image'] = $featured_image;
            }
            $page_content['added'] =  date('Y-m-d H:i:s');

            $page_id = $this->pages_model->insert_pages($page_content);

            if($page_id)
            {                
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));                  
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }
         	
         	redirect(base_url('admin/pages'));
        }

		
       	$data['path_link'] = base_url("assets/uploads/page/");
       	$data['page_id'] = NULL;
       	$data['page_data'] = NULL;
		$data['page_title'] = lang('add') . lang('page');
		$data['body'] = 'pages/add';
		$this->load->view('template/main', $data);	
	}	
	

    function update($page_id = NULL) 
    {
    	$data = $this->includes;
        if(empty($page_id))
        {
           $this->session->set_flashdata('error', lang('invalid_url')); 
           redirect(base_url('admin/pages'));
        }

        $page_data = $this->pages_model->get_pages_by_id($page_id);

        if(empty($page_data))
        {
           $this->session->set_flashdata('error', lang('admin_invalid_id')); 
           redirect(base_url('admin/pages'));
        }

        $title_unique = $this->input->post('title')  != $page_data->title ? '|is_unique[pages.title]' : '';

        $this->form_validation->set_rules('title', lang('admin_page_title'), 'required|trim'.$title_unique);
        $this->form_validation->set_rules('content', lang('admin_page_content'), 'required|trim');

        if (empty($_FILES['featured_image']['name']) && empty($page_data->featured_image)) 
        {
            $this->form_validation->set_rules('featured_image',lang('admin_page_image'), 'required|trim');
        }
        

        $featured_image = NULL;
        if(isset($_FILES['featured_image']['name']) && $_FILES['featured_image']['name'])
        {
            $path = "./assets/uploads/page/";
            if (!is_dir($path)) 
            {
                @mkdir($path, 0775, TRUE);
            }
            $new_name = time().$_FILES["featured_image"]['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size']    = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('featured_image')) 
            {
                $file = $this->upload->data();
                $featured_image = $file['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                $this->form_validation->set_rules('featured_image', lang('image'), 'required|trim');
            }

        }
        
        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            
            $page_content = array();
            $title_slug = slugify_string($this->input->post('title',TRUE));
            $slug_count = $this->pages_model->page_slug_like_this($title_slug, $page_id);

            $page_content['title'] = $this->input->post('title',TRUE);
            $page_content['slug'] = $title_slug.$slug_count;
            $page_content['content'] = $this->input->post('content',TRUE);
            $page_content['on_menu'] = $this->input->post('on_menu',TRUE) ? 1 : 0;
            $page_content['meta_title'] =  $this->input->post('metatitle');
            $page_content['meta_keywords'] =  $this->input->post('metakeywords');
            $page_content['meta_description'] =  $this->input->post('metadescription');

            if($featured_image)
            {
                $page_content['featured_image'] = $featured_image;
            }

            $page_content['updated'] =  date('Y-m-d H:i:s');

            $page_update_status = $this->pages_model->update_pages($page_id, $page_content);

            if($page_update_status)
            {
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_during_update_record')); 
            }

            redirect(base_url('admin/pages'));
        }
        $data['path_link'] = base_url("assets/uploads/page/");
       	$data['page_id'] = $page_id;
       	$data['page_data'] = $page_data;
       	$data['page_title'] = lang('update') . lang('page');
		$data['body'] = 'pages/edit';
		$this->load->view('template/main', $data);	
    }


    function delete($page_id = NULL)
    {
        $status = $this->pages_model->delete_page($page_id);
        if($status) 
        {
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));  
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/pages'));
    }


	
}
