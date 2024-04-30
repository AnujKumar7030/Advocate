<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Product_Service extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_service_model");

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
        $this->add_external_js(base_url('assets/js/product_service/script.js')); 
        
    }

    function index()
    {
        $data = $this->includes;
        $data['product_service'] = $this->product_service_model->get_all();
        $data['page_title'] = lang('product_service');
        $data['body'] = 'product_service/list';
        $this->load->view('template/main', $data);
    }

    function add()
    {
        $data = $this->includes;
        $data['categories'] = $this->product_service_model->get_all_category();
        $data['tax'] = $this->product_service_model->get_all_tax();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'lang:name', 'required');
            $this->form_validation->set_rules('sku', 'lang:sku', 'required|trim|is_unique[product_service.sku]');
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['sku'] = $this->input->post('sku');
                $save['description'] = $this->input->post('description');
                $save['sale_price'] = $this->input->post('sale_price');
                $save['purchase_price'] = $this->input->post('purchase_price');
                $save['tax_id'] = ($this->input->post('tax')) ? $this->input->post('tax') : 0;
                $save['category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['unit'] = ($this->input->post('unit')) ? $this->input->post('unit') : 0;
                $save['type'] = $this->input->post('type');
                
                $this->product_service_model->save($save);
                $this->session->set_flashdata('message', lang('product_service_created'));
                redirect('admin/product_service');
            }
            
        }        
        
        
        $data['page_title'] = lang('add') . lang('product_service');
        $data['body'] = 'product_service/add';
        $this->load->view('template/main', $data);    
    }

    function edit($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;

        $data['product_service'] = $this->product_service_model->get_product_service_by_id($id);
        
        $data['categories'] = $this->product_service_model->get_all_category();
        $data['tax'] = $this->product_service_model->get_all_tax();

        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'name', 'required');
            if ($id) {
                   $this->form_validation->set_rules('sku', 'sku', 'required|trim');
            }
             
            if ($this->form_validation->run()==true) {
                $save['name'] = $this->input->post('name');
                $save['sku'] = $this->input->post('sku');
                $save['description'] = $this->input->post('description');
                $save['sale_price'] = $this->input->post('sale_price');
                $save['purchase_price'] = $this->input->post('purchase_price');
                $save['tax_id'] = ($this->input->post('tax')) ? $this->input->post('tax') : 0;
                $save['category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['unit'] = ($this->input->post('unit')) ? $this->input->post('unit') : 0;
                $save['type'] = $this->input->post('type');
                
                $this->product_service_model->update($save, $id);
                $this->session->set_flashdata('message', lang('product_service_update'));
                redirect('admin/product_service');
            }
            
        }        
        
        
        $data['page_title'] = lang('edit') . lang('product_service');
        $data['body'] = 'product_service/add';
        $this->load->view('template/main', $data);    
    }

    function _check_sku($id = false) 
    {
        $data = $this->includes;
        if ($this->input->post('sku')) {
            $check_sku = $this->input->post('sku');
            p($check_sku); 
            $sku_result = $this->product_service_model->check_unique_sku($check_sku, $id);
        } 

        if ($sku_result == 0) {
            return true;
        } 
        else 
        {
            $this->form_validation->set_message('check_sku', lang('sku_must_be_unique'));
            $sku_response = false;
        }
        return $sku_response;
    }

    function delete($id=false)
    {
        $data = $this->includes;
        
        if($id) {
            $this->product_service_model->delete($id);
            $this->session->set_flashdata('message', lang('category_deleted'));
            redirect('admin/product_service');
        }
    }

}
