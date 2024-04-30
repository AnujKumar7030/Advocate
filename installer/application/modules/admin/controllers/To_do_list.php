<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class To_do_list extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("to_do_list_model");
        $this->load->model("custom_field_model");


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
        $this->add_external_js(base_url('assets/js/to_do_list/script.js'));        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['lists'] = $this->to_do_list_model->get_all();
        $data['page_title'] = 'To Do List';
        $data['body'] = 'to_do_list/list';
        $this->load->view('template/main', $data);    

    }    
    
    
    function view_all()
    {
        $data = $this->includes;
        $data['lists'] = '';
        $data['lists'] = $this->to_do_list_model->get_all_by_date();
        $ids='';
        foreach($data['lists'] as $ind => $key){
        
            $ids[]=@$key->case_id;
        }
        
        $this->to_do_list_model->to_dos_view_by_admin($ids);
        $data['page_title'] = 'View All To Do';
        $data['body'] = 'to_do_list/view_all';
        $this->load->view('template/main', $data);    

    }    
    
    function add()
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_time', 'Date Time', 'required');
            
             
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');
                $save['date'] = $this->input->post('date_time');
                
                $p_key = $this->to_do_list_model->save($save);
                $reply = $this->input->post('reply');
                if(!empty($reply)) {    
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $p_key,
                         'form'=> 3,
                        );    
                    
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }    
                   $this->session->set_flashdata('message', lang('to_do_created'));
                redirect('admin/to_do_list');
                
            }
            
            
        }        
        
        $data['page_title'] = 'Add To Do ';
        $data['body'] = 'to_do_list/add';
        
        $this->load->view('template/main', $data);    

    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(3);    
        $data['list'] = $data['clients'] = $this->to_do_list_model->get_list_by_id($id);
        $data['id'] =$id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_time', 'Date Time', 'required');
            
             
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('name');
                $save['description'] = $this->input->post('description');
                $save['date'] = $this->input->post('date_time');
                
                $this->to_do_list_model->update($save, $id);
                
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                        'custom_field_id'=> $key,
                        'reply'=> $val,
                        'table_id'=> $id,
                        'form'=> 3,
                        );    
                    
                    }    
                    $this->custom_field_model->delete_answer($id, $form=3);
                    $this->custom_field_model->save_answer($save_fields);
                }
                $this->session->set_flashdata('message', lang('to_do_updated'));
                redirect('admin/to_do_list');
                
            }
        }    
        $data['page_title'] = 'Edit To Do ';
        $data['body'] = 'to_do_list/edit';
        $this->load->view('template/main', $data);    

    }
    
    
    function view_to_do($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(3);    
        $data['list'] = $data['clients'] =$this->to_do_list_model->get_list_by_id($id);
        $data['id'] =$id;
        $this->to_do_list_model->to_do_view_by_admin($id);
        $data['page_title'] = 'View To Do ';
        $data['body'] = 'to_do_list/view';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->to_do_list_model->delete($id);
            $this->session->set_flashdata('message', lang('to_do_deleted'));
            redirect('admin/to_do_list');
        }
    }    
        
    
}
