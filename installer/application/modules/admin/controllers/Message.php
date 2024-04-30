<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Message extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("act_model");
        $this->load->model("clients_model");
        $this->load->model("message_model");  


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
        $this->add_external_js(base_url('assets/js/message/script.js'));        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $user_role = get_staff_role_id();
        
        $data['clients'] = $this->db->where('user_role', $user_role)->where('employee_id', 0)->where('message_status',1)->get('users')->result();
        
        $data['page_title'] = lang('message');
        $data['body'] = 'message/list';
        $this->load->view('template/main', $data);    
    }    
    
    
    function send($id=false)
    {
        $data = $this->includes;
        $this->message_model->message_is_view_by_admin($id);
        $data['client']         = $this->message_model->get_client_by_id($id);
        $data['messages']      = $this->message_model->get_message_by_id($id);
        $data['id'] =$id;
        $admin = $this->session->userdata('admin');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('message', 'lang:message', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['from_id'] = $admin['id'];
                $save['to_id'] = $id;
                $save['message'] = $this->input->post('message');
                $save['is_view_to'] = 1;
                
                $this->message_model->save_message($save);
                
                
                $msg                  = html_entity_decode($save['message'], ENT_QUOTES, 'UTF-8');
                $params['recipient'] = $data['client']->email;
                $params['subject']      = "You Have New Message From :". $admin['name'];
                $params['message']   = $msg;
                modules::run('admin/fomailer/send_email', $params);
                
                $this->session->set_flashdata('message', 'Message Sent');
                redirect('admin/message/send/'.$id);
                
            }
        }        
    
        $data['page_title'] = lang('send') . lang('message');
        $data['body'] = 'message/send';
        $this->load->view('template/main', $data);    

    }    
    
    function send_message($id=false)
    {
        $data = $this->includes;
        $admin = $this->session->userdata('admin');
        $access = $admin['user_role'];
        $data['client'] = $this->message_model->get_client_by_id($id);
        $data['messages'] = $this->message_model->get_message_by_id($id);
        $data['count'] = $this->message_model->get_message_count_by_id();
    
        $data['id'] = $admin['id'];
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('message', 'lang:message', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
                $save['from_id'] = $admin['id'];
                $save['to_id'] = 1;
                $save['message'] = $this->input->post('message');
                $save['is_view_to'] = 1;
                $this->message_model->save_message($save);
                   $this->session->set_flashdata('message', lang('message_sent'));
                redirect('admin/message/send_message/'.$id);
                
            }
        }        
    
        $this->message_model->message_is_view_by_user();
        $data['page_title'] = lang('send') . lang('message');
        $data['body'] = 'message/send_message';
        $this->load->view('template/main', $data);    

    }    
    
    function delete($id=false)
    {
        $data = $this->includes;
        if($id) 
        {
            $this->db->set('message_status',0)->where('id',$id)->update('users');
            // $this->act_model->delete($id);
            $this->session->set_flashdata('message', lang('message_deleted'));
            redirect('admin/message');
        }
    }    
      

    function contact_enquiry()
    {
        $data = $this->includes;
        $data['messages'] = $this->message_model->get_all_contact_enquiry();
        $data['page_title'] = lang('contact_enquiry');
        $data['body'] = 'message/contact_enquiry';
        $this->load->view('template/main', $data);    
    }    
      
    
}
