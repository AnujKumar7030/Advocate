<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Cases extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
               
        $this->load->model("cases_model");
        $this->load->model("tax_model");
        $this->load->model("location_model");
        $this->load->model("case_stage_model");
        $this->load->model("custom_field_model");
        $this->load->model("document_model");
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
        
    }
    
    
    function index()
    {
        $this->add_external_js(base_url('assets/js/cases/list.js'));
        $data = $this->includes; 
        $data['cases'] = $this->cases_model->get_all();
        $data['courts'] = $this->cases_model->get_all_courts();
        $data['clients'] = $this->cases_model->get_all_clients();
        $data['locations'] = $this->location_model->get_all();
        $data['stages'] = $this->case_stage_model->get_all();
        $data['page_title'] = lang('case');
        $data['body'] = 'case/list';
        $this->load->view('template/main', $data);     
    }
    
    
    function get_case_by_client()
    {
        $data = $this->includes;
        $cases = $this->cases_model->get_cases_by_client_id($_POST['id']);
        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_client', $data, true);    
        echo $view_data;
                    
    }
    
    function get_case_by_client_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_client_id_starred($_POST['id']);
        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_client_starred', $data, true);    
        echo $view_data;
                       
    }    
    
    
    
    function get_case_by_court()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_court_id($_POST['id']);
    
        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_court', $data, true);    
        echo $view_data;
                    
    }

    function get_case_by_court_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_court_id_starred($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_court_starred', $data, true);    
        echo $view_data;
                    
        
    }

    

    function get_case_by_location()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_location_id($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_location', $data, true);    
        echo $view_data;
                    
        
    }

    function get_case_by_location_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_location_id_starred($_POST['id']);
        

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_location_starred', $data, true);    
        echo $view_data;
                    
        
    }


    function get_case_by_case_stage_id()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_case_stage_id($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_stage_id', $data, true);    
        echo $view_data;
                    
                    
        
    }

    function get_case_by_case_stage_id_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_case_stage_id_starred($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_stage_id_starred', $data, true);    
        echo $view_data;
                            
    }


    function get_case_by_case_filing_date()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_filing_date($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_stage_id_starred', $data, true);    
        echo $view_data;
        
    }

    function get_case_by_case_filing_date_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_filing_date_starred($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_filing_date_starred', $data, true);    
        echo $view_data;
        
    }


    function get_case_by_case_hearing_date()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_hearing_date($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_hearing_date', $data, true);    
        echo $view_data;
                    
        
    }

    function get_case_by_case_hearing_date_starred()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_cases_by_hearing_date_starred($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_case_by_case_hearing_date_starred', $data, true);    
        echo $view_data;
        
    }


    
    function view_all()
    {
        $this->add_external_js(base_url('assets/js/cases/view_all.js'));
        $data = $this->includes; 
        $data['cases'] = $this->cases_model->get_case_by_date();
        $ids='';
        foreach($data['cases'] as $ind => $key){
        
            $ids[]=$key->case_id;
        }
        
        $this->cases_model->cases_view_by_admin($ids);
        $data['page_title'] =  lang('view_all') . lang('cases');
        $data['body'] = 'case/view_all';
        $this->load->view('template/main', $data);    

    }    
    
    function get_court_categories()
    {
        $data = $this->includes; 
        $data['case_categories']     = $this->cases_model->get_all_case_categories();
        $result = $this->cases_model->get_court_catogries_by_location($_POST['id']);
      
        echo '<select name="court_category_id" id="court_category_id" class="chzn col-md-12" >
										<option value="">--Select Court Category--</option>
									';
        foreach($result as $new) {
            $sel = "";
            if(set_select('court_category_id', $new->id)) { $sel = "selected='selected'";
            }
            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
        }
                                        
        echo'</select>';                        
    }
    
    function get_courts()
    {
        $data = $this->includes; 
        $courts = $this->cases_model->get_all_courts();
        $result = $this->cases_model->get_court_by_location_c_category($_POST['l_id'], $_POST['c_id']);
        echo '<select name="court_id" id="court_id" class="chzn col-md-12" >
										<option value="">--Select Court--</option>
									';
        foreach($result as $new) {
            $sel = "";
            if(set_select('court_id', $new->id)) { $sel = "selected='selected'";
            }
            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
        }
                                        
        echo'</select>';                        
    }
    
    
    function starred_cases()
    {
        
        $this->add_external_js(base_url('assets/js/cases/starred_list.js'));
        $data = $this->includes; 
        $data['cases'] = $this->cases_model->get_all_starred();
        $data['courts'] = $this->cases_model->get_all_courts();
        $data['clients'] = $this->cases_model->get_all_clients();
        $data['locations'] = $this->location_model->get_all();
        $data['stages'] = $this->case_stage_model->get_all();
        $data['page_title'] = lang('case');
        $data['body'] = 'case/starred_list';
        $this->load->view('template/main', $data);    

    }    
    
    
    
    function archived_cases()
    {
        $this->add_external_js(base_url('assets/js/cases/archive_list.js'));
        $data = $this->includes; 
        $data['cases'] = $this->cases_model->get_all_archived();
        $data['courts'] = $this->cases_model->get_all_courts();
        $data['clients'] = $this->cases_model->get_all_clients();
        $data['locations'] = $this->location_model->get_all();
        $data['stages'] = $this->case_stage_model->get_all();
        $data['page_title'] = lang('archived_cases');
        $data['body'] = 'case/archive_list';
        $this->load->view('template/main', $data);    
    }    
    
    function get_archive_case_by_client()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_client_id($_POST['id']);


        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_client', $data, true);    
        echo $view_data;

    }    
    
    
    function get_archive_case_by_court()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_court_id($_POST['id']);



        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_court', $data, true);    
        echo $view_data;
    }    
    
    
    function get_archive_case_by_location()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_location_id($_POST['id']);

        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_location', $data, true);    
        echo $view_data;

    }    
    
    
    function get_archive_case_by_case_stage_id()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_case_stage_id($_POST['id']);


        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_case_stage_id', $data, true);    
        echo $view_data;

    }    
    
    
    function get_archive_case_by_case_filing_date()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_filing_date($_POST['id']);


        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_case_filing_date', $data, true);    
        echo $view_data;

    }    
    
    
    function get_archive_case_by_case_hearing_date()
    {
        $data = $this->includes; 
        $cases = $this->cases_model->get_archive_cases_by_hearing_date($_POST['id']);


        $data['cases'] = $cases;
        $view_data = $this->load->view('case/ajax/get_archive_case_by_case_hearing_date', $data, true);    
        echo $view_data;

    }
    
    
    
    function restore($id)
    {
        $data = $this->includes; 
        $this->cases_model->restore_case($id);
        $this->session->set_flashdata('message', lang('case_has_been_restored'));
        redirect('admin/cases');
    }
    
    
    
    function archived($id=false)
    {

        $this->add_external_js(base_url('assets/js/cases/archive.js'));
        $data = $this->includes; 
    
        $data['clients']             = $this->cases_model->get_all_clients();
        $data['id']                    =$id;
        $data['case']                = $this->cases_model->get_case_by_id($id);
        
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('notes', 'lang:notes', 'required');
            $this->form_validation->set_rules('close_date', 'lang:date', 'trim|required');
             
            if ($this->form_validation->run()==true) {
                $save['notes'] = $this->input->post('notes');
                $save['close_date'] = $this->input->post('close_date');
                $save['case_id'] = $id;
                $this->cases_model->save_archived($save);
                $this->cases_model->set_is_archived($id);
                     $this->session->set_flashdata('message', lang('case_is_archived'));
                redirect('admin/cases/archived_cases');
            }
        }        
    
        $data['page_title'] = lang('archive') . lang('case');
        $data['body'] = 'case/archive';
        $this->load->view('template/main', $data);    
    }
    

    function view_archived_case($id=false)
    {
        $this->add_external_js(base_url('assets/js/cases/view_archived.js'));
        $data = $this->includes; 
        $data['clients']             = $this->cases_model->get_all_clients();
        $data['stages']             = $this->case_stage_model->get_all();
        $data['acts']                 = $this->cases_model->get_all_acts();
        $data['courts']                 = $this->cases_model->get_all_courts();
        $data['locations']             = $this->cases_model->get_all_locations();
        $data['case_categories']     = $this->cases_model->get_all_case_categories();
        $data['court_categories']    = $this->cases_model->get_all_court_categories();
        $data['id']                 = $id;
        $data['payment_modes']        = $this->cases_model->get_all_payment_modes();
        $data['fees_all']            = $this->cases_model->get_fees_all($id);
        $data['case']                = $this->cases_model->get_archive_case_by_id($id);
        $data['cases']                 = $this->cases_model->get_all_extended_case_by_id($id);
        $data['cases']                 = $this->cases_model->get_all_extended_case_by_id($id);
        $data['page_title']         = lang('view') . lang('archived_case');
        $data['body']                 = 'case/view_archived';
    
        $this->load->view('template/main', $data);    
    }
    
    function view_case($id=false)
    {
        $this->add_external_js(base_url('assets/js/cases/view_case.js'));
        $data = $this->includes; 
        $data['fields'] = $this->custom_field_model->get_custom_fields(2);    
        $data['clients']             = $this->cases_model->get_all_clients();
        $data['stages']                = $this->case_stage_model->get_all();
        $data['acts']                 = $this->cases_model->get_all_acts();
        $data['courts']                 = $this->cases_model->get_all_courts();
        $data['locations']             = $this->cases_model->get_all_locations();
        $data['case_categories']     = $this->cases_model->get_all_case_categories();
        $data['court_categories']    = $this->cases_model->get_all_court_categories();
        $data['id']                 = $id;
        $data['payment_modes']        = $this->cases_model->get_all_payment_modes();
        $data['fees_all']            = $this->cases_model->get_fees_all($id);
        $data['case']                = $this->cases_model->get_archive_case_by_id($id);
        $data['cases']                 = $this->cases_model->get_all_extended_case_by_id($id);
        $data['cases']                 = $this->cases_model->get_all_extended_case_by_id($id);
        //$data['documents']          = $this->document_model->get_all_documents($id);
        $data['documents']          = $this->document_model->get_case_documents($id);
        
        $this->cases_model->case_view_by_admin($id);
        
        $data['page_title']            = lang('view') . lang('case');
        $data['body']                 = 'case/view_case';
        $this->load->view('template/main', $data);    
    }
    
    function add()
    {

        $this->add_external_js(base_url('assets/js/cases/add.js'));
        $data = $this->includes; 
        $data['fields_clients'] = $this->custom_field_model->get_custom_fields(1);
        $data['fields']             = $this->custom_field_model->get_custom_fields(2);
        $data['clients']         = $this->cases_model->get_all_clients();
        $data['stages']          = $this->case_stage_model->get_all();
        $data['acts']              = $this->cases_model->get_all_acts();
        // $data['courts']             = $this->cases_model->get_all_courts();
        $data['courts']             = $this->cases_model->get_all_courts_with_location_category();
        $data['locations']          = $this->cases_model->get_all_locations();
        $data['case_categories'] = $this->cases_model->get_all_case_categories();
        $data['court_categories']= $this->cases_model->get_all_court_categories();
        

        if ($this->input->server('REQUEST_METHOD') === 'POST') 
        {    
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('title', 'lang:title', 'required');
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            $this->form_validation->set_rules('case_no', 'Case No', 'trim|required|is_unique[cases.case_no]');
            // $this->form_validation->set_rules('location_id', 'Location', 'required');
            $this->form_validation->set_rules('case_stage_id', 'Case Stage', 'required');
            $this->form_validation->set_rules('court_id', 'Court', 'required');
            // $this->form_validation->set_rules('court_category_id', 'Court Category', 'required');
            $this->form_validation->set_rules('case_category_id[]', 'Case Category', 'required');
            $this->form_validation->set_rules('act_id[]', 'Act', 'required');
            $this->form_validation->set_rules('start_date', 'Filing Date', 'required');
            $this->form_validation->set_rules('description', 'Description', '');
            $this->form_validation->set_rules('fees', 'Fees', '');
            $this->form_validation->set_rules('o_lawyer', 'Opposite Lawyer', '');
            $this->form_validation->set_rules('hearing_date', 'Description', '');
             
            if ($this->form_validation->run()==true) 
            {

                $court_id = $this->input->post('court_id');
                $court_data = $this->cases_model->get_court_by_id($court_id);
                $save['title'] = $this->input->post('title');
                $save['case_no'] = $this->input->post('case_no');
                $save['client_id'] = $this->input->post('client_id');
                $save['location_id'] = $court_data->location_id;
                $save['court_id'] = $this->input->post('court_id');
                $save['court_category_id'] = $court_data->court_category_id;
                $save['case_stage_id'] = $this->input->post('case_stage_id');
                $save['case_category_id'] = json_encode($this->input->post('case_category_id'));
                $save['act_id'] = json_encode($this->input->post('act_id'));
                $save['description'] = $this->input->post('description');
                $save['start_date'] = $this->input->post('start_date');
                $save['hearing_date'] = $this->input->post('hearing_date');
                $save['o_lawyer'] = $this->input->post('o_lawyer');
                $save['fees'] = $this->input->post('fees');
                
                $p_key = $this->cases_model->save($save);
                $reply = $this->input->post('reply');
                if(!empty($reply)) {
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $p_key,
                         'form'=> 2,
                        );    
                    
                    }    
                    $this->custom_field_model->save_answer($save_fields);
                }
                $this->session->set_flashdata('message', lang('case_created'));
                redirect('admin/cases');
                
            }
        }        
        
        
        $data['page_title'] = lang('add') . lang('case');
        $data['body'] = 'case/add'; 
        
        
        $this->load->view('template/main', $data);    

    }    
    
    
    function edit($id=false)
    {
        $this->add_external_js(base_url('assets/js/cases/edit.js'));
        $data = $this->includes; 
        $data['clients']             = $this->cases_model->get_all_clients();
        $data['stages']             = $this->case_stage_model->get_all();
        $data['acts']                 = $this->cases_model->get_all_acts();
        // $data['courts']                 = $this->cases_model->get_all_courts();
        $data['courts']             = $this->cases_model->get_all_courts_with_location_category();
        $data['locations']             = $this->cases_model->get_all_locations();
        $data['case_categories']     = $this->cases_model->get_all_case_categories();
        $data['court_categories']    = $this->cases_model->get_all_court_categories();
        $data['id']                    =    $id;
        $data['case']                 = $this->cases_model->get_case_by_id($id);
        $data['fields']             = $this->custom_field_model->get_custom_fields(2);    
        if ($this->input->server('REQUEST_METHOD') === 'POST') 
        {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('client_id', 'lang:client', 'required');
            $this->form_validation->set_rules('case_no', 'lang:case_number', 'trim|required');
            // $this->form_validation->set_rules('location_id', 'lang:location', 'required');
            $this->form_validation->set_rules('court_id', 'lang:court', 'required');
            // $this->form_validation->set_rules('court_category_id', 'lang:court_category', 'required');
            $this->form_validation->set_rules('case_category_id[]', 'lang:case_category', 'required');
            $this->form_validation->set_rules('act_id[]', 'lang:act', 'required');
            $this->form_validation->set_rules('start_date', 'lang:filing_date', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
            if ($this->form_validation->run()==true) 
            {

                $court_id = $this->input->post('court_id');
                $court_data = $this->cases_model->get_court_by_id($court_id);


                $save['title'] = $this->input->post('title');
                $save['case_no'] = $this->input->post('case_no');
                $save['client_id'] = $this->input->post('client_id');
                $save['location_id'] = $court_data->location_id;
                $save['court_id'] = $this->input->post('court_id');
                $save['court_category_id'] = $court_data->court_category_id;
                $save['case_stage_id'] = $this->input->post('case_stage_id');
                $save['case_category_id'] = json_encode($this->input->post('case_category_id'));
                $save['act_id'] = json_encode($this->input->post('act_id'));
                $save['description'] = $this->input->post('description');
                $save['start_date'] = $this->input->post('start_date');
                $save['hearing_date'] = $this->input->post('hearing_date');
                $save['o_lawyer'] = $this->input->post('o_lawyer');
                $save['fees'] = $this->input->post('fees');
                
                $reply = $this->input->post('reply');
                if(!empty($reply)) {    
                    foreach($this->input->post('reply') as $key => $val) {
                        $save_fields[] = array(
                         'custom_field_id'=> $key,
                         'reply'=> $val,
                         'table_id'=> $id,
                         'form'=> 2,
                        );    
                    
                    }    
                    $this->custom_field_model->delete_answer($id, $form=2);
                    $this->custom_field_model->save_answer($save_fields);
                }
                $this->cases_model->update($save, $id);
                  $this->session->set_flashdata('message',  lang('case_created'));
                redirect('admin/cases');
            }
        }        
    
        $data['page_title'] = lang('edit') . lang('court');
        $data['body'] = 'case/edit';
        $this->load->view('template/main', $data);    

    }
    
    function notes($id=false)
    {
        $this->add_external_js(base_url('redactor.min.js'));
        $this->add_external_js(base_url('assets/js/cases/notes.js')); 
        $data = $this->includes; 
        $data['id']                    =    $id;
        $data['case']                 = $this->cases_model->get_case_by_id($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('notes', 'lang:notes', 'required');
            $this->form_validation->set_message('required', lang('custom_required'));
            if ($this->form_validation->run()==true) {
                $save['notes'] = $this->input->post('notes');
                
                $this->cases_model->update($save, $id);
                     $this->session->set_flashdata('message',  lang('notes_saved'));
                redirect('admin/cases/notes/'.$id);
            }
        }        
    
        $data['page_title'] =  lang('notes');
        $data['body'] = 'case/notes';
        $this->load->view('template/main', $data);    

    }
    
    
    
    function dates($id=false)
    {
        $this->add_external_js(base_url('assets/js/cases/extended_dates.js'));
        $data = $this->includes; 
    
        $data['cases']             = $this->cases_model->get_all_extended_case_by_id($id);
        $data['id'] =$id;
        $data['case']                = $this->cases_model->get_case_by_id($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'date', 'required');
            //$this->form_validation->set_message('required', lang('custom_required'));
             
            if ($this->form_validation->run()==true) {
            
                if($_FILES['img'] ['name'] !='') { 
                        
                    
                    $config['upload_path'] = './assets/uploads/files/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '10000';
                    $config['max_width']  = '10000';
                    $config['max_height']  = '6000';
                
                    $this->load->library('upload', $config);
                    
                    if (!$this->upload->do_upload('img')) {
                    $error = array('error' => $this->upload->display_errors());
                    p($error);
                    
                    }
                    $img_data = array('upload_data' => $this->upload->data());
                
                    
                    
                    $save['document'] = $img_data['upload_data']['file_name'];
                }
                  
                $save['case_id'] = $id;    
                $save['next_date'] = $this->input->post('date');
                $save['last_date'] = $this->input->post('date2');
                $save['note'] = $this->input->post('notes');
                
                $this->cases_model->save_extended_case($save);
                  $this->session->set_flashdata('message', 'Extended Date Saved');
                redirect('admin/cases/dates/'.$id);
                
            }
        }        
    
        
        $data['body'] = 'case/extended_dates';
        $this->load->view('template/main', $data);    

    }
    
    
    function dates_detail($id=false)
    {
        $this->add_external_js(base_url('assets/js/cases/extended_dates_detail.js'));
        $data = $this->includes; 
    
        $data['cases']             = $this->cases_model->get_extended_case_by_id($id);
        $data['id']             = $id;
        $data['case']            = $this->cases_model->get_case_by_id($id);
        $data['body']             = 'case/extended_dates_detail';
        $this->load->view('template/main', $data);    

    }    
    
    function fees($id)
    {
        $this->add_external_js(base_url('assets/js/cases/fees.js'));
        $data = $this->includes; 
        $data['categories'] = $this->invoice_model->get_all_category();
        $data['items'] = $this->invoice_model->get_all_product_services();
        $data['tax']            = $this->tax_model->get_all();

        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();

        $data['receipts']            = $this->cases_model->get_receipts($id);
        $data['case']                    = $this->cases_model->get_case_by_id($id);
        $data['fees_all']                = $this->cases_model->get_fees_all($id);
        
        $data['id']                     = $id;
        $invoice            = $this->cases_model->get_invoice_number();
        
        if(empty($invoice->invoice)) {
            $data['invoice_no'] = $this->settings->invoice_no;
        }else{
            $data['invoice_no'] = $invoice->invoice+1;
        }
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_mode_id', 'lang:payment_mode', 'required');
            $this->form_validation->set_rules('invoice_no', 'lang:invoice', 'required');
            $this->form_validation->set_rules('issue_date', 'lang:issue_date', 'required');
            $this->form_validation->set_rules('due_date', 'lang:due_date', 'required');
            if ($this->form_validation->run()==true) {

                $save['case_id'] = $id; 
                $save['issue_date'] = $this->input->post('issue_date');
                $save['due_date'] = $this->input->post('due_date');
                $save['payment_mode_id'] = $this->input->post('payment_mode_id');
                $save['invoice'] = $this->input->post('invoice_no');
                $save['new_category_id'] = ($this->input->post('category')) ? $this->input->post('category') : 0;
                $save['status'] = ($this->input->post('status')) ? $this->input->post('status') : 0;
                $save['ref_no'] = $this->input->post('reference_number');
                $save['new_tax_id'] = ($this->input->post('tax_name')) ? $this->input->post('tax_name') : 0;
                $save['sub_total'] = $this->input->post('sub_total');
                $save['discount'] = $this->input->post('discount_total');
                $save['new_tax_total'] = $this->input->post('tax_total');
                $save['new_total_amount'] = $this->input->post('gross_total');
                $save['added'] = date('Y-m-d H:i:s');
                $save['updated'] = date('Y-m-d H:i:s');

                $fees_id = $this->cases_model->save_fees($save);
                $product_service_data = array();
                $product_name_data = $this->input->post('product') ? $this->input->post('product', true) : array();
                if(count($product_name_data)>=1) {
                    foreach($product_name_data as $p_key => $p_value)
                    {    
                        if($p_value) {
                            $product_id = $this->input->post('product')[$p_key];
                            $product_name = $this->invoice_model->get_product_name_by_id($product_id);
                            $product_service_data['invoice_id'] = $fees_id;
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
                
                  $this->session->set_flashdata('message', lang('fees_updated'));
                redirect('admin/cases/fees/'.$id);
            }
        }
        $data['body'] = 'case/fees';
        $this->load->view('template/main', $data);
    }
    
    function view_receipt($id)
    {
        $this->add_external_js(base_url('assets/js/cases/view_receipt.js'));
        $data = $this->includes; 
        $data['receipt']            = $this->cases_model->get_receipt($id);
        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();
        $data['setting']     = $this->settings;
        $data['body'] = 'case/view_receipt';
        $this->load->view('template/main', $data);
    }
    
    function print_receipt($id)
    {
        $data = $this->includes; 
        $data['receipt']            = $this->cases_model->get_receipt($id);
        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();
        $data['setting']     = $this->settings;
        $this->load->view('case/print_receipt', $data);
    }
    
    function pdf($id=false)
    {
        $data = $this->includes; 
        $this->load->helper('dompdf_helper');
        $this->load->helper('download');
        $data['receipt']            = $this->cases_model->get_receipt($id);
        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();
        $data['setting']     = $this->settings;
        $data['page_title'] = lang('receipt');
        $html = $this->load->view('case/pdf_receipt', $data, true);        
        pdf_create($html, 'Receipt_'.$data['receipt']->id);
        

    }    
    
    
    
    public function mail($id=false)
    { 
        $data = $this->includes; 
        $data['receipt']            = $this->cases_model->get_receipt($id);
        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();
        $data['setting']     = $this->settings;
        $data['page_title'] = lang('receipt');
        
        if(!empty($data['setting']->image)) { 
            $img = '<img src="'.site_url('assets/uploads/images/'.$data['setting']->image).'" class="height-70 width-80 pl-30"   />';
        }
        $html = $this->load->view('case/pdf_receipt', $data, true);            
        $message = $html;
        $msg                  = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
        $params['recipient'] = $data['receipt']->u_email;;
        $params['subject']      = "Receipt";
        $params['message']   = $msg;
        modules::run('admin/fomailer/send_email', $params);
    
        $this->session->set_flashdata('message', lang('receipt_send'));
        redirect('admin/cases/fees/'.$data['receipt']->case_id);

    }
    
    
    function receipt($id)
    {
        $data = $this->includes; 
        $data['tax']            = $this->tax_model->get_all();
        $data['payment_modes']            = $this->cases_model->get_all_payment_modes();
        $data['case']                    = $this->cases_model->get_case_by_id($id);
        $data['fees_all']                = $this->cases_model->get_fees_all($id);
        $data['id']                     = $id;
        $invoice            = $this->cases_model->get_invoice_number();
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('r_amount', 'lang:amount', '');
            if ($this->form_validation->run()==true) {            
                $save['amount'] = $this->input->post('r_amount');
                $save['date'] = $this->input->post('r_date');
                $save['fees_id'] = $this->input->post('fees_id');
                $save['case_id'] = $this->input->post('case_id');
                
                $this->cases_model->save_receipt($save);
                
                
                
                
                     $this->session->set_flashdata('message', lang('receipt_created'));
                redirect('admin/cases/fees/'.$id);
            }
        }
        $data['body'] = 'case/fees';
        $this->load->view('template/main', $data);
    }
    
    function delete($id=false)
    {
        $data = $this->includes; 
        
        if($id) {
            $this->cases_model->delete($id);
            redirect('admin/cases');
            $this->session->set_flashdata('message',  lang('case_deleted'));
        }
    }
    
    function delete_archive_case($id=false)
    {
        $data = $this->includes; 
        
        if($id) {
            $this->cases_model->delete($id);
            redirect('admin/cases/archived_cases');
            $this->session->set_flashdata('message',  lang('case_deleted'));
        }
    }    
    
    function delete_fees($id=false)
    {
        $data = $this->includes; 
        
        if($id) {
            $this->cases_model->delete_fees($id);
            $this->session->set_flashdata('message', lang('fees_deleted'));
            redirect('admin/cases');
            
        }
    }    
    
    function delete_deceipt($id=false,$c_id = NULL)
    {
        $data = $this->includes;

        if($id) {
            $this->cases_model->delete_receipt($id);
            $this->session->set_flashdata('message', lang('receipt_deleted'));
            redirect('admin/cases/fees/'.$c_id);
            
        }
    }    
    
    
        
    function delete_history($id=false)
    {
        $data = $this->includes; 
        
        if($id) {
            $this->cases_model->delete_history($id);
            $this->session->set_flashdata('message', lang('history_deleted'));
            redirect('admin/cases');
        }
    }    

        
    function set_starred()
    {
        $data = $this->includes; 
        $this->cases_model->set_is_starred($_POST['id']);
    }    
    
    function update_set_starred()
    {
        $data = $this->includes; 
        $this->cases_model->update_set_is_starred($_POST['id']);
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
    
}
