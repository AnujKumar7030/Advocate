    <?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Reports extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("reports_model");

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

        $this->add_external_js(base_url('assets/plugins/morris/raphael-min.js')); 
        $this->add_external_js(base_url('assets/plugins/morris/morris.min.js')); 
        $this->add_external_js(base_url('assets/js/reports/echarts-en.min.js')); 
        $this->add_external_js(base_url('assets/js/reports/jquery.sparkline.min.js')); 
        $this->add_external_js(base_url('assets/js/reports/script.js')); 
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['months'] = $this->reports_model->get_earning_by_month();
        $data['weeks'] = $this->reports_model->get_earning_by_week();
        $data['years'] = $this->reports_model->get_earning_by_year();

        $data['clients'] = $this->reports_model->get_earning_by_client();
        $data['page_title'] = lang('reports');
        $data['body'] = 'reports/reports';
        $this->load->view('template/main', $data);    
    }    
}
