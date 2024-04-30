<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Appointments extends MX_Controller
{ 

    public function __construct()
    {
        parent::__construct();

        $this->load->model("appointment_model");
        $this->load->model("custom_field_model");

        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-responsive-dt/css/responsive.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net/js/jquery.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-dt/js/dataTables.dataTables.min.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/appointments/script.js'));

    }

    
    function index()
    {
        $data = $this->includes;
        $data['appointments'] = $this->appointment_model->get_all();
        //p($data['appointments']);
        $data['page_title'] =  lang('appointments');
        $data['body'] = 'appointments/list';
        $this->load->view('template/main', $data);    
    }    
    
    function view_all()
    {
        $data = $this->includes;
        $data['appointments'] = $this->appointment_model->get_appointment_by_date();
        $ids='';
        foreach($data['appointments'] as $ind => $key){
        
            $ids[]=$key->id;
        }
        $this->appointment_model->appointments_view_by_admin($ids);
        $data['page_title'] = lang('view_all') . lang('appointments');
        $data['body'] = 'appointments/view_all';
        $this->load->view('template/main', $data);    
    }    
    
    function add()
    {

        $data = $this->includes;
        $data['contact_fields'] = $this->custom_field_model->get_custom_fields(4);    
        $data['fields'] = $this->custom_field_model->get_custom_fields(5);    
        $data['contacts'] = $this->appointment_model->get_contacts();
        $get_user_role_slug = $this->db->select('id,slug')->where('id',$this->session->userdata('admin')['user_role'])->get('user_role')->row();
        $data['get_user_role_slug'] = $get_user_role_slug;

        if ($this->input->post('ok')) {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'lang:title', 'required');
            if($get_user_role_slug->slug == 'admin') {
                $this->form_validation->set_rules('contact_id', 'lang:contact', 'required');
            }
            $this->form_validation->set_rules('motive', 'lang:motive', 'required');
            $this->form_validation->set_rules('date_time', 'lang:date', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
            $contact_id = ($get_user_role_slug->slug == 'admin') ? $this->input->post('contact_id') : $this->session->userdata('admin')['id'];
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('title');
                $save['contact_id'] = $contact_id;
                $save['motive'] = $this->input->post('motive');
                $save['date_time'] = $this->input->post('date_time');
                $save['notes'] = $this->input->post('notes');
                
                $p_key = $this->appointment_model->save($save);
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                          $save_fields[] = array(
                        'custom_field_id'=> $key,
                        'reply'=> $val,
                        'table_id'=> $p_key,
                        'form'=> 5,
                          );    
                
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }    
                   $this->session->set_flashdata('message', lang('appointment_created'));
                redirect('admin/appointments');
                
                
            }
        }        
        
        
        $data['page_title'] = lang('add') . lang('appointment');
        $data['body'] = 'appointments/add';
        
        $this->load->view('template/main', $data);    
    }    
    
    
    function edit($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(5);    
        $data['contacts'] = $this->appointment_model->get_contacts();
        $data['appointment'] = $this->appointment_model->get_appointment_by_id($id);
        $data['id'] =$id;
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'name:title', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['title'] = $this->input->post('title');
                $save['contact_id'] = $this->input->post('contact_id');
                $save['motive'] = $this->input->post('motive');
                $save['date_time'] = $this->input->post('date_time');
                $save['notes'] = $this->input->post('notes');
                
                $this->appointment_model->update($save, $id);
                
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $id,
                         'form'=> 5,
                        );    
                    
                    }    
                    $this->custom_field_model->delete_answer($id, $form=5);
                    $this->custom_field_model->save_answer($save_fields);
                }    
                   $this->session->set_flashdata('message', lang('appointment_updated'));
                redirect('admin/appointments');
                
                
            }
            
        }            
    
        $data['page_title'] = lang('edit') . lang('appointment');
        $data['body'] = 'appointments/edit';
        $this->load->view('template/main', $data);    

    }
    
    function view_appointment($id=false)
    {
        $data = $this->includes;
        $data['fields'] = $this->custom_field_model->get_custom_fields(5);    
        $data['contacts'] = $this->appointment_model->get_contacts();
        $data['appointment'] = $data['clients'] = $this->appointment_model->get_appointment_by_id($id);
        $data['id'] =$id;
        $this->appointment_model->appointment_view_by_admin($id);
        $data['page_title'] = lang('view') . lang('appointment');
        $data['body'] = 'appointments/view';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->appointment_model->delete($id);
            $this->session->set_flashdata('message', lang('appointment_deleted'));
            redirect('admin/appointments');
        }
    }    
        
    
}
