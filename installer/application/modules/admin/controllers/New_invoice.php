<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class New_Invoice extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("invoice_model");

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
        $this->add_external_js(base_url('assets/js/invoice/script.js')); 
        
    }
    
    
    function index()
    {
        $data = $this->includes;
        $data['invoice'] = $this->invoice_model->get_all_invoice();
        
        $data['page_title'] = lang('invoice');
        $data['body'] = 'invoice/list';
        $this->load->view('template/main', $data);
    }

    function add()
    {
        $data = $this->includes;
        $data['categories'] = $this->invoice_model->get_all_category();
        $data['cases'] = $this->invoice_model->get_all_cases();
        $data['items'] = $this->invoice_model->get_all_product_services();
        $data['taxes'] = $this->invoice_model->get_all_tax();
        $invoice = $this->invoice_model->get_invoice_number();
        
        if(empty($invoice->invoice)) {
            $data['invoice_no'] = $this->settings->invoice_no;
        }else{
            $data['invoice_no'] = $invoice->invoice+1;
        }
        
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('cases', 'lang:cases', 'required');
            $this->form_validation->set_rules('issue_date', 'lang:issue_date', 'required');
            $this->form_validation->set_rules('due_date', 'lang:due_date', 'required');

            if ($this->form_validation->run()==true) {
                $save['case_id'] = $this->input->post('cases');
                $save['issue_date'] = $this->input->post('issue_date');
                $save['due_date'] = $this->input->post('due_date');
                $save['invoice'] = $this->input->post('invoice_number');
                $save['new_category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['status'] = ($this->input->post('status')) ? $this->input->post('status') : 0;
                $save['ref_no'] = $this->input->post('reference_number');
                //$save['email'] = $this->input->post('email');
                $save['new_tax_id'] = ($this->input->post('tax_name')) ? $this->input->post('tax_name') : 0;
                $save['sub_total'] = $this->input->post('sub_total');
                $save['discount'] = $this->input->post('discount_total');
                $save['new_tax_total'] = $this->input->post('tax_total');
                $save['new_total_amount'] = $this->input->post('gross_total');
                $save['added'] = date('Y-m-d H:i:s');
                $save['updated'] = date('Y-m-d H:i:s');
                
                $invoice_id = $this->invoice_model->save($save);
                if($invoice_id) {
                    $product_service_data = array();
                    $product_name_data = $this->input->post('product') ? $this->input->post('product', true) : array();

                    if(count($product_name_data)>=1) {

                        foreach($product_name_data as $p_key => $p_value)
                        {
                            
                            if($p_value) {
                                $product_id = $this->input->post('product')[$p_key];
                                $product_name = $this->invoice_model->get_product_name_by_id($product_id);
                                $product_service_data['invoice_id'] = $invoice_id;
                                $product_service_data['product_id'] = $this->input->post('product')[$p_key];
                                $product_service_data['product_item'] = $product_name->name;
                                $product_service_data['quantity'] = $this->input->post('quantity')[$p_key];
                                $product_service_data['price'] = $this->input->post('price')[$p_key];
                                $product_service_data['tax_value'] = $this->input->post('tax')[$p_key];
                                $product_service_data['discount'] = $this->input->post('discount')[$p_key];
                                $product_service_data['amount'] = $this->input->post('invoice_amount')[$p_key];
                                $product_service_data['description'] = $this->input->post('description')[$p_key];

                                $this->invoice_model->save_product_service_data($product_service_data);
                            }

                        }
                        
                        
                    }
                }

                $this->session->set_flashdata('message', lang('invoice_created'));
                redirect('admin/new_invoice');
                
            }
            
        }        
        
        
        $data['page_title'] = lang('add') . lang('invoice');
        $data['body'] = 'invoice/form';
        $this->load->view('template/main', $data);    
    }

    function get_case_data()
    {
        $data = $this->includes;
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "something went wrong";
        $response['data'] = "";
        
        if($_POST['case_id']) 
        {
            $case_data = $this->invoice_model->get_case_by_id($_POST['case_id']);

            $data['case_data'] = $case_data;
            
            $response['data'] = $this->load->view('invoice/client_data', $data, true);
            $response['status'] = "success";
        }
        echo json_encode($response);
    }

    function get_product_data()
    {
        $data = $this->includes;
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "something went wrong";
        $response['data'] = "";
        if($_POST['product_id']) {
            $product_data = $this->invoice_model->get_product_by_id($_POST['product_id']);
            $response['data'] = $product_data;
            $response['status'] = "success";
        }
        
        echo json_encode($response);
    }

    function edit($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;
        $data['categories'] = $this->invoice_model->get_all_category();
        $data['cases'] = $this->invoice_model->get_all_cases();
        $data['items'] = $this->invoice_model->get_all_product_services();
        $data['taxes'] = $this->invoice_model->get_all_tax();
        $invoice = $this->invoice_model->get_invoice_number();
        $data['invoice'] = $this->invoice_model->get_invoice_by_id($id);
        $data['invoice_product'] = $this->invoice_model->get_invoice_product_by_id($id);


        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('cases', 'lang:cases', 'required');
            $this->form_validation->set_rules('issue_date', 'lang:issue_date', 'required');
            $this->form_validation->set_rules('due_date', 'lang:due_date', 'required');
             
            if ($this->form_validation->run()==true) {
                $save['case_id'] = $this->input->post('cases');
                $save['issue_date'] = $this->input->post('issue_date');
                $save['due_date'] = $this->input->post('due_date');
                $save['invoice'] = $this->input->post('invoice_number');
                $save['new_category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['status'] = ($this->input->post('status')) ? $this->input->post('status') : 0;
                $save['ref_no'] = $this->input->post('reference_number');
                $save['new_tax_id'] = ($this->input->post('tax_name')) ? $this->input->post('tax_name') : 0;
                $save['sub_total'] = $this->input->post('sub_total');
                $save['discount'] = $this->input->post('discount_total');
                $save['new_tax_total'] = $this->input->post('tax_total');
                $save['new_total_amount'] = $this->input->post('gross_total');
                $save['added'] = $data['invoice']->added;
                $save['updated'] = date('Y-m-d H:i:s');
                
                $this->invoice_model->update($save, $id);
                $this->invoice_model->delete_invoice_product($id);
                if($id) {
                    $product_service_data = array();
                       $product_name_data = $this->input->post('product') ? $this->input->post('product', true) : array();

                    if(count($product_name_data)>=1) {
                        foreach($product_name_data as $p_key => $p_value)
                        {
                            
                            if($p_value) {
                                $product_id = $this->input->post('product')[$p_key];
                                $product_name = $this->invoice_model->get_product_name_by_id($product_id);
                                $product_service_data['invoice_id'] = $id;
                                $product_service_data['product_id'] = $this->input->post('product')[$p_key];
                                $product_service_data['product_item'] = $product_name->name;
                                $product_service_data['quantity'] = $this->input->post('quantity')[$p_key];
                                $product_service_data['price'] = $this->input->post('price')[$p_key];
                                $product_service_data['tax_value'] = $this->input->post('tax')[$p_key];
                                $product_service_data['discount'] = $this->input->post('discount')[$p_key];
                                $product_service_data['amount'] = $this->input->post('invoice_amount')[$p_key];
                                $product_service_data['description'] = $this->input->post('description')[$p_key];

                                $this->invoice_model->save_product_service_data($product_service_data);
                            }
                        }    
                    }
                }

                $this->session->set_flashdata('message', lang('invoice_updated'));
                redirect('admin/new_invoice');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('invoice');
        $data['body'] = 'invoice/form';
        $this->load->view('template/main', $data);
    }    

    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->invoice_model->delete($id);
            $this->session->set_flashdata('message', lang('invoice_deleted'));
            redirect('admin/new_invoice');
        }
    }

    function view($id=false)
    {    
        $data = $this->includes;
        $data['details'] = $this->invoice_model->get_detail($id);
        $data['setting']   = $this->invoice_model->get_setting();
        $data['invoice_product'] = $this->invoice_model->get_invoice_product_by_id($id);
        $data['page_title'] = lang('invoice_detail');
        $data['body'] = 'invoice/invoice'; 
        $this->load->view('template/main', $data);
    }

}
