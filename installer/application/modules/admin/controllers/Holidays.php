<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Holidays extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("holiday_model");


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
        $this->add_external_js(base_url('assets/js/holidays/script.js'));  
        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['holidays'] = $this->holiday_model->get_all();
        $data['months'] = $this->holiday_model->get_months();
        
        $data['page_title'] = lang('holidays');
        $data['body'] = 'holidays/list';
        $this->load->view('template/main', $data);    

    }    

    function sortByOrder($a, $b)
    {
        $data = $this->includes;
        if($a['DayOfMonth']>31) {
            return ;
        }else{
            return $a['DayOfMonth'] - $b['DayOfMonth'];
        }
    }

    
    function add()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('date', 'lang:date', 'required');
            $this->form_validation->set_message('required', '%s can not be blank');
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['date'] = $this->input->post('date');
                $save['month_id'] = $this->input->post('month_id');
                $this->holiday_model->save($save);
                $this->session->set_flashdata('message', lang('holiday saved'));
                redirect('admin/holidays');
            }
        }        
        $data['month_list'] = $this->db->get('months')->result();        
        $data['page_title'] = lang('add') . lang('holiday');
        $data['body'] = 'holidays/add';
        
        $this->load->view('template/main', $data);    
    }    

    function delete($id=false)
    {
        $data = $this->includes;
        
        if($id) {
            $this->holiday_model->delete($id);
            $this->session->set_flashdata('message', lang('holiday_deleted'));
            redirect('admin/holidays');
            
        }
    }    
        
    
}
