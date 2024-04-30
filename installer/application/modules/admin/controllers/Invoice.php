<?php if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Invoice extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("invoice_model");
        $this->load->model('setting_model');
        $this->auth->is_logged_in();
        $this->load->library("SendMail");

        $this->add_external_css(base_url('assets/plugins/datatables/dataTables.bootstrap.css'));
        $this->add_external_css(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'));
        $this->add_external_css(base_url('assets/plugins/chosen/chosen.css'));

        $this->add_external_js(base_url('assets/plugins/datatables/jquery.dataTables.js'));
        $this->add_external_js(base_url('assets/plugins/datatables/dataTables.bootstrap.js'));
        $this->add_external_js(base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.js'));

        $this->add_external_js(base_url('assets/plugins/chosen/chosen.jquery.min.js'));
        $this->add_external_js(base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
        $this->add_external_js(base_url('assets/js/bootstrap-datepicker.js'));
        $this->add_external_js(base_url('assets/js/redactor3.js'));
		$this->add_external_css(base_url('assets/css/redactor.min.css'));
        $this->add_external_js(base_url('assets/js/invoice/script.js'));  
    }

    function index($id=false)
    { 
    	$data = $this->includes;
    	$this->load->library('encryption');
        $data['details'] = $this->invoice_model->get_detail($id);

        $data['invoice_product'] = $this->invoice_model->get_invoice_product_by_id($id);

        $data['taxes'] = $this->invoice_model->get_taxes($id);

        foreach ($data['taxes'] as $new) { 
            $sum_tax_old[] =  $new->percent/100*$data['details']->amount;
        }

        $data['old_tax'] = array_sum($sum_tax_old);
        $data['setting']   = $this->setting_model->get_setting();    
        $data['page_title'] = lang('invoice');
        $data['body'] = 'invoice/invoice';
        $this->load->view('template/main', $data);    

    }    
    
    function pdf($id=false)
    {
    	$data = $this->includes;
        $this->load->helper('dompdf_helper');
        $this->load->helper('download');
        $data['details'] = $this->invoice_model->get_detail($id);
        $data['invoice_product'] = $this->invoice_model->get_invoice_product_by_id($id);
        $data['taxes'] = $this->invoice_model->get_taxes($id);    
        $data['setting']   = $this->setting_model->get_setting();    
        $data['page_title'] = lang('invoice');
        $html = $this->load->view('invoice/pdf', $data, true); 
        // echo $html;

        pdf_create($html, 'Invoice_'.$data['details']->invoice);
        

    }    
    
    
    public function mail($id=false)
    { 
    	$data = $this->includes;
        $data['details'] = $this->invoice_model->get_detail($id);
        $taxes = $this->invoice_model->get_taxes($id);        
        $data['setting']   = $this->setting_model->get_setting();
        $this->load->library('encryption');
        $data['body'] = 'invoice/pdf';
        if(!empty($data['setting']->image)) { 
            $img = '<img src="'.site_url('assets/uploads/images/'.$data['setting']->image).'" class="height-70 width-80 pl-30" />';
        }
            
        $message = '
						<html>
							<head>
								<title>Invoice</title>
							</head>
							<body>
								<table class="border-1-f4f4f4"  width="90%" align="center" style="border: 1px solid #f4f4f4">
									<tr>
										<th colspan="3">'.lang('invoice').'</th>
									</tr>
									<tr >
										<th colspan="3" align="center">
											 <table border="0" width="100%"> 
												<tr>
													<td width="20%">
													'.@$img.'
													</td>
													<td><h2>'.$data['setting']->name.'</h2></td>
													<td></td>
												</tr>
											</table>
										</th>
									</tr>
									<tr>
										<th>'.lang('from').'</th>
										<th>'.lang('to').'</th>
										<th></th>
									</tr>
									<tr>
										<td>'.$data['setting']->name.'</td>
										<td>'.$data['details']->client.'</td>
										<td>'.lang('invoice').' : #'.$data['details']->invoice.'</td>
									</tr>
									<tr>
										<td>'.$data['setting']->address.'</td>
										<td>'.$data['details']->address.'</td>
										<td><b>'.lang('case_number').'</b>  :'.$data['details']->case_no.'</td>
									</tr>
									<tr>
										<td>'.$data['setting']->contact.'</td>
										<td>'.$data['details']->contact.'</td>
										<td><b>'.lang('payment_mode').'</b> :'.$data['details']->mode.'</td>
									</tr>
									<tr>
										<td>'.$data['setting']->email.'</td>
										<td>'.$data['details']->email.'</td>
										<td><b>'.lang('date').'</b> :'.date_convert($data['details']->date).'</td>
									</tr>
									<tr>
										<td colspan="3" style="border:0px;">
											<table width="100%" style="border: 1px solid #f4f4f4">
												<tr>												
													<th align="left">'.lang('details').'</th>
													<th align="right">'.lang('amount').'</th>
												 </tr>	
												<tr>
													<td align="left">'.lang('payment').'</th>
													<td align="right">'.$data['details']->amount.'</th>
													
												</tr>
										';
        foreach($taxes as $new){
            echo '<tr>
													<td align="left">'.$new->name.'<span  style="float:right">  '.$new->percent.'</span></td>
													<td align="right">'.number_format((float)$new->percent/100*$data['details']->amount, 2, '.', '').'</td>
													
												</tr>';
                                        
        }        
                                    echo '	
											<tr>
													<td align="left">'.lang('total').'</th>
													<td align="right">'.$data['details']->total.'</th>
													
												</tr>
										</table>	
										</td>
									</tr>	
								</table>
							
							</body>
						</html>

				';
        //$msg                  = html_entity_decode($message, ENT_QUOTES, 'UTF-8');

        $params['recipient'] =  $data['details']->email;
        $params['subject']      = "Invoice";
        $params['message']   = $message;

        $status = $this->sendmail->sendTo($data['details']->email, $params['subject'], 'ATN', $params['message']);
        //modules::run('admin/fomailer/send_email', $params);
        
    	if($status == 1)
    	{
    		$this->session->set_flashdata('message', lang('invoice_sent'));
        	redirect('admin/invoice/index/'.$id);
    	}
       
        
    }
    
        
    
    
}
