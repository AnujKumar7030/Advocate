<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Expense extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("expense_model");
        $this->auth->is_logged_in();


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
        $this->add_external_js(base_url('assets/js/expense/script.js'));  
    }

    function index($id=false)
    { 
        $data = $this->includes;
        $data['expense'] = $this->expense_model->get_all_expense();
  
        $data['page_title'] = lang('expenses');
        $data['body'] = 'expense/list';
        $this->load->view('template/main', $data);    

    }

    function add()
    {
        $data = $this->includes;
        $bill_no = $this->expense_model->get_bill_number();
        $data['categories'] = $this->expense_model->get_all_category();
        $data['taxes'] = $this->expense_model->get_all_tax();
        $data['items'] = $this->expense_model->get_all_product_services();
        if(empty($bill_no->bill_number)) {
            $data['bill_no'] = 1;
        }else{
            $data['bill_no'] = $bill_no->bill_number+1;
        }
        $data['vendors'] = $this->expense_model->get_all_vendors();

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            //$this->form_validation->set_rules('vendor_id', 'lang:vendor', 'required');
            $this->form_validation->set_rules('bill_date', 'lang:bill_date', 'required');
            $this->form_validation->set_rules('due_date', 'lang:due_date', 'required');

            if ($this->form_validation->run()==true) {
                $save['vendor_id'] = $this->input->post('vendor_id');
                $save['bill_date'] = $this->input->post('bill_date');
                $save['due_date'] = $this->input->post('due_date');
                $save['bill_number'] = $this->input->post('bill_number');
                $save['category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['status'] = ($this->input->post('status')) ? $this->input->post('status') : 0;
                $save['order_no'] = $this->input->post('order_number');
                $save['tax_id'] = ($this->input->post('tax_name')) ? $this->input->post('tax_name') : 0;
                $save['sub_total'] = ($this->input->post('sub_total')) ? $this->input->post('sub_total') : 0;
                $save['discount'] = ($this->input->post('discount_total')) ? $this->input->post('discount_total') : 0 ;
                $save['tax_total'] = ($this->input->post('tax_total')) ? $this->input->post('tax_total') : 0;
                $save['total_amount'] = ($this->input->post('gross_total')) ? $this->input->post('gross_total') : 0;
                $save['added'] = date('Y-m-d H:i:s');
                $save['updated'] = date('Y-m-d H:i:s');

                $expense_id = $this->expense_model->save($save);
                if($expense_id) {
                    $product_service_data = array();
                    $product_name_data = $this->input->post('product') ? $this->input->post('product', true) : array();
                    if(count($product_name_data)>=1) {

                        foreach($product_name_data as $p_key => $p_value)
                        {
                            
                            if($p_value) {
                                $product_id = $this->input->post('product')[$p_key];
                                $product_name = $this->expense_model->get_product_name_by_id($product_id);
                                $product_service_data['expense_id'] = $expense_id;
                                $product_service_data['product_id'] = $this->input->post('product')[$p_key];
                                $product_service_data['product_item'] = $product_name->name;
                                $product_service_data['quantity'] = $this->input->post('quantity')[$p_key];
                                $product_service_data['price'] = $this->input->post('price')[$p_key];
                                $product_service_data['tax_value'] = $this->input->post('tax')[$p_key];
                                $product_service_data['discount'] = $this->input->post('discount')[$p_key];
                                $product_service_data['amount'] = $this->input->post('invoice_amount')[$p_key];
                                $product_service_data['description'] = $this->input->post('description')[$p_key];

                                $this->expense_model->save_product_service_data($product_service_data);
                            }
                        }
                    }
                }
                $this->session->set_flashdata('message', lang('expense_created'));
                redirect('admin/expense');
            }    
        }

        $data['page_title'] = lang('add') . lang('expenses');
        $data['body'] = 'expense/form';
        $this->load->view('template/main', $data);
    }

    function get_vendor_data()
    {
        $data = $this->includes;
        $response = array();
        $response['status'] = "error";
        $response['msg'] = "something went wrong";
        $response['data'] = "";
        if($_POST['vendor_id']) {
            $vendor_data = $this->expense_model->get_vendor_by_id($_POST['vendor_id']);

            $data['vendor_data'] = $vendor_data;
            $response['data'] = $this->load->view('expense/vendor_data', $data, true);
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
            $product_data = $this->expense_model->get_product_by_id($_POST['product_id']);
            $response['data'] = $product_data;
            $response['status'] = "success";
        }
        
        echo json_encode($response);
    }

    function edit($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;
        $data['categories'] = $this->expense_model->get_all_category();
        $data['taxes'] = $this->expense_model->get_all_tax();
        $data['items'] = $this->expense_model->get_all_product_services();
        $data['expense'] = $this->expense_model->get_expense_by_id($id);
        $data['expense_product'] = $this->expense_model->get_expense_product_by_id($id);
        $data['vendors'] = $this->expense_model->get_all_vendors();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            //$this->form_validation->set_rules('vendor_id', 'lang:vendor', 'required');
            $this->form_validation->set_rules('bill_date', 'lang:bill_date', 'required');
            $this->form_validation->set_rules('due_date', 'lang:due_date', 'required');

            if ($this->form_validation->run()==true) {
                   $save['vendor_id'] = $this->input->post('vendor_id');
                $save['bill_date'] = $this->input->post('bill_date');
                $save['due_date'] = $this->input->post('due_date');
                $save['bill_number'] = $this->input->post('bill_number');
                $save['category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['status'] = ($this->input->post('status')) ? $this->input->post('status') : 0;
                $save['order_no'] = $this->input->post('order_number');
                $save['tax_id'] = ($this->input->post('tax_name')) ? $this->input->post('tax_name') : 0;
                $save['sub_total'] = ($this->input->post('sub_total')) ? $this->input->post('sub_total') : 0;
                $save['discount'] = ($this->input->post('discount_total')) ? $this->input->post('discount_total') : 0 ;
                $save['tax_total'] = ($this->input->post('tax_total')) ? $this->input->post('tax_total') : 0;
                $save['total_amount'] = ($this->input->post('gross_total')) ? $this->input->post('gross_total') : 0;
                $save['added'] = $data['expense']->added;
                $save['updated'] = date('Y-m-d H:i:s');

                $this->expense_model->update($save, $id);
                $this->expense_model->delete_expense_product($id);
                if($id) {
                    $product_service_data = array();
                       $product_name_data = $this->input->post('product') ? $this->input->post('product', true) : array();
                    if(count($product_name_data)>=1) {

                        foreach($product_name_data as $p_key => $p_value)
                        {
                            
                            if($p_value) {
                                $product_id = $this->input->post('product')[$p_key];
                                $product_name = $this->expense_model->get_product_name_by_id($product_id);
                                $product_service_data['expense_id'] = $id;
                                $product_service_data['product_id'] = $this->input->post('product')[$p_key];
                                $product_service_data['product_item'] = $product_name->name;
                                $product_service_data['quantity'] = $this->input->post('quantity')[$p_key];
                                $product_service_data['price'] = $this->input->post('price')[$p_key];
                                $product_service_data['tax_value'] = $this->input->post('tax')[$p_key];
                                $product_service_data['discount'] = $this->input->post('discount')[$p_key];
                                $product_service_data['amount'] = $this->input->post('invoice_amount')[$p_key];
                                $product_service_data['description'] = $this->input->post('description')[$p_key];

                                $this->expense_model->save_product_service_data($product_service_data);
                            }
                        }
                    }
                }
                $this->session->set_flashdata('message', lang('expense_updated'));
                redirect('admin/expense');
            }    
        }
        $data['page_title'] = lang('edit') . lang('expense');
        $data['body'] = 'expense/form';
        $this->load->view('template/main', $data);
    }

    function delete($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->expense_model->delete($id);
            $this->session->set_flashdata('message', lang('expense_deleted'));
            redirect('admin/expense');
        }
    }

    function view($id=false)
    {    
        $data = $this->includes;
        $data['details'] = $this->expense_model->get_expense_detail($id);

        $data['setting']   = $this->expense_model->get_setting();
        $data['expense_product'] = $this->expense_model->get_expense_product_by_id($id);
        
        $data['page_title'] = lang('expense_detail');
        $data['body'] = 'expense/expense_view';
        $this->load->view('template/main', $data);
    }

}
