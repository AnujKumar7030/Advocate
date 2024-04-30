<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Dashboard extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_session();
        $this->load->model("dashboard_model");
        $this->load->model("employees_model");
        $this->load->model("tasks_model");
        $this->load->model("cases_model");
        $this->load->model("case_study_model");
        $this->load->model("clients_model");
        $this->load->model("setting_model");
        $this->load->model("attendance_model");
        $this->load->model("leave_types_model");


        $this->add_external_css(base_url('assets/plugins/fullcalendar/fullcalendar.css'));
        $this->add_external_css(base_url('assets/plugins/fullcalendar/fullcalendar.print.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/dataTables.bootstrap.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        $this->add_external_js(base_url('assets/plugins/morris/raphael-min.js'));
        $this->add_external_js(base_url('assets/plugins/morris/morris.min.js'));
        $this->add_external_js(base_url('assets/plugins/sparkline/jquery.sparkline.min.js'));
        $this->add_external_js(base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'));
        $this->add_external_js(base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'));
        $this->add_external_js(base_url('assets/plugins/fullcalendar/moment.min.js'));
        $this->add_external_js(base_url('assets/plugins/fullcalendar/fullcalendar.min.js'));
        $this->add_external_js(base_url('assets/plugins/fullcalendar/lang-all.js'));
        $this->add_external_js(base_url('assets/plugins/jqueryKnob/jquery.knob.js'));


        //$this->add_external_js(base_url('assets/plugins/datatables/jquery.dataTables.js'));
        //$this->add_external_js(base_url('assets/plugins/datatables/dataTables.bootstrap.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/js/redactor3.js'));
        $this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/dashboard/script.js?ver='.$this->updation->site_version));
    }
    
    
    function index()
    {
        $data = $this->includes;

        $data['case_study'] = $this->case_study_model->get_all();
        $data['my_tasks'] = $this->tasks_model->get_my_tasks();
        $data['tasks'] = $this->tasks_model->get_all();
        $data['todays_leaves'] = $this->attendance_model->get_todays_leaves();
        $data['employees'] = $this->employees_model->get_all();
        $data['att_status'] = $this->attendance_model->get_attendance_today();
        $data['check_today'] = $this->attendance_model->check_today_is_leave();
        $data['clients']     = $this->dashboard_model->get_clients();
        $data['notice']     = $this->dashboard_model->get_notice();
        $data['my_cases']    = $this->clients_model->get_case_by_client();
        $data['starred']     = $this->cases_model->get_all_starred();
        $data['archived']     = $this->cases_model->get_all_archived();
        $data['client_setting']   = $this->setting_model->get_notification_setting_client();
        $data['cases']         = $this->dashboard_model->get_todays_cases();
        $data['to_do']         = $this->dashboard_model->get_todays_to_do();
        $data['case_all']     = $this->dashboard_model->get_case_all();
        $appointment_of_month_array = $this->dashboard_model->get_appointment_of_month();
        $data['leave_types'] = $this->leave_types_model->get_all();
        $data['tasks']         = $this->dashboard_model->get_tasks();

        $time_limit_in_minutes = $this->settings_data->appointment_meeting_time_limit_in_minutes;
        $appointment_of_month = array();
        foreach ($appointment_of_month_array as $key => $value_array) 
        {
            $title = $value_array['title'];
            $start = date("Y-m-d H:i:s",strtotime($value_array['date_time']));
            $end = date("Y-m-d H:i:s", strtotime("+$time_limit_in_minutes minutes", strtotime($start)));

            $appointment_of_month[] = array('title' => $title , 'start' => $start, 'end' => $end);
           
        }
        
        $data['appointment_of_month'] = json_encode($appointment_of_month);

        $data['appointments_array'] = $this->leave_types_model->get_all();


        $data['page_title'] = lang('dashboard');
        $data['body'] = 'dashboard/dashboard';
        $this->load->view('template/main', $data);     

    }    
    
        
    
}
