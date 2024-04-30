<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');
}

class Banking extends MX_Controller
{  
    public function __construct()
    {
        parent::__construct();
        $this->load->model("banking_model");

        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/datatables/datatables.net-responsive-dt/css/responsive.dataTables.min.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net/js/jquery.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/datatables.net-dt/js/dataTables.dataTables.min.js'));
        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));

        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/js/banking/script.js'));

    }

    function index()
    {
        $data = $this->includes;
        $data['account_list'] = $this->banking_model->get_all_account_list();
        
        $data['page_title'] = lang('account_manage');
        $data['body'] = 'new_account/account_list';
        $this->load->view('template/main', $data);
    }

    function add_account()
    {
        $data = $this->includes;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_holder_name', 'lang:account_holder', 'required');
            $this->form_validation->set_rules('bank_name', 'lang:bank_name', 'required');
            $this->form_validation->set_rules('account_number', 'lang:account_number', 'required');

            if ($this->form_validation->run()==true) {
                   $save['bank_holder_name'] = $this->input->post('bank_holder_name');
                $save['bank_name'] = $this->input->post('bank_name');
                $save['account_number'] = $this->input->post('account_number');
                $save['opening_balance'] = $this->input->post('opening_balance');
                $save['contact_number'] = $this->input->post('contact_number');
                $save['bank_address'] = $this->input->post('bank_address');
                $save['added'] = date('Y-m-d H:i:s');
                $save['updated'] = date('Y-m-d H:i:s');
                $account_id = $this->banking_model->save($save);

                   $this->session->set_flashdata('message', lang('account_created'));
                redirect('admin/banking');
            }
        }

        $data['page_title'] = lang('add') . lang('account');
        $data['body'] = 'new_account/form';
        $this->load->view('template/main', $data);
    }

    function edit_account($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;
        $data['account'] = $this->banking_model->get_account_by_id($id);
        

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_holder_name', 'lang:account_holder', 'required');
            $this->form_validation->set_rules('bank_name', 'lang:bank_name', 'required');
            $this->form_validation->set_rules('account_number', 'lang:account_number', 'required');

            if ($this->form_validation->run()==true) {
                $save['bank_holder_name'] = $this->input->post('bank_holder_name');
                $save['bank_name'] = $this->input->post('bank_name');
                $save['account_number'] = $this->input->post('account_number');
                $save['opening_balance'] = $this->input->post('opening_balance');
                $save['contact_number'] = $this->input->post('contact_number');
                $save['bank_address'] = $this->input->post('bank_address');
                $save['added'] = $data['account']->added;
                $save['updated'] = date('Y-m-d H:i:s');
                $this->banking_model->update($save, $id);

                $this->session->set_flashdata('message', lang('account_updated'));
                redirect('admin/banking');
            }
        }

        $data['page_title'] = lang('edit') . lang('account');
        $data['body'] = 'new_account/form';
        $this->load->view('template/main', $data);
    }

    function delete_account($id=false)
    {
        $data = $this->includes;
        if($id) {
            $this->banking_model->delete($id);
            $this->session->set_flashdata('message', lang('account_deleted'));
            redirect('admin/banking');
        }
    }

    function transfer()
    {
        $data = $this->includes;
        $data['transfer_list'] = $this->banking_model->get_all_transfer_list();
        
        $data['page_title'] = lang('bank_transfer');
        $data['body'] = 'new_account/transfer_list';
        $this->load->view('template/main', $data);    
    }

    function add_transfer()
    {
        $data = $this->includes;
        $data['bank_name'] = $this->banking_model->get_all_account_name();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('from_id', 'lang:from_account', 'required');
            $this->form_validation->set_rules('to_id', 'lang:to_account', 'required');
            $this->form_validation->set_rules('amount', 'lang:amount', 'required');

            if ($this->form_validation->run()==true) {
                   $save['from_id'] = $this->input->post('from_id');
                $save['to_id'] = $this->input->post('to_id');
                $save['amount'] = $this->input->post('amount');
                $save['transfer_date'] = $this->input->post('date');
                $save['reference_no'] = $this->input->post('reference');
                $save['description'] = $this->input->post('description');
                $save['added'] = date('Y-m-d H:i:s');
                $save['updated'] = date('Y-m-d H:i:s');
                
                $transfer_id = $this->banking_model->save_transfer($save);

                   $this->session->set_flashdata('message', lang('transfer_created'));
                redirect('admin/banking/transfer');    
            }
        }

        $data['page_title'] = lang('add') . lang('transfer');
        $data['body'] = 'new_account/transfer_form';
        $this->load->view('template/main', $data);    
    }

    function edit_transfer($id=false)
    {
        $data = $this->includes;
        $data['id'] =$id;
        $data['bank_name'] = $this->banking_model->get_all_account_name();
        $data['transfer'] = $this->banking_model->get_transfer_by_id($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('from_id', 'lang:from_account', 'required');
            $this->form_validation->set_rules('to_id', 'lang:to_account', 'required');
            $this->form_validation->set_rules('amount', 'lang:amount', 'required');

            if ($this->form_validation->run()==true) {
                   $save['from_id'] = $this->input->post('from_id');
                $save['to_id'] = $this->input->post('to_id');
                $save['amount'] = $this->input->post('amount');
                $save['transfer_date'] = $this->input->post('date');
                $save['reference_no'] = $this->input->post('reference');
                $save['description'] = $this->input->post('description');
                $save['added'] = $data['transfer']->added;
                $save['updated'] = date('Y-m-d H:i:s');

                $this->banking_model->transfer_data_update($save, $id);

                $this->session->set_flashdata('message', lang('transfer_updated'));
                redirect('admin/banking/transfer');
            }
        }

        $data['page_title'] = lang('edit') . lang('transfer');
        $data['body'] = 'new_account/transfer_form';
        $this->load->view('template/main', $data);
    }

    function delete_transfer($id = false)
    {
        $data = $this->includes;
        if($id) {
            $this->banking_model->delete_transfer_data($id);
            $this->session->set_flashdata('message', lang('transfer_deleted'));
            redirect('admin/banking/transfer');
        }
    }

}
