<section class="content-header">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <h1>
       <?php echo lang('fees')?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('cases')?></a></li>
        <li class="active"><?php echo lang('fees')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                    <?php 
                    if(validation_errors()) {
                        ?>
                    <div class="alert alert-danger alert-dismissable">
                                                            <i class="fa fa-ban"></i>
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                            <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                                        </div>

                    <?php  } ?>
                        
                    <?php $total_rec = $this->db->query("select sum(amount)  as tot_rec from receipt where case_id = '".$id."'")->row();
                                                                $tot = $total_rec->tot_rec;
                                                                $due = $case->fees - $total_rec->tot_rec;

                    ?>              
                    <div class="box-body">
                       <div class="box-body no-padding">
                                    <table class="table table-striped" border="1">
                                        <tbody>
                                        <tr>
                                            <th width="25%"><?php echo lang('case')?> <?php echo lang('number')?></th>
                                            <td width="25%"><?php echo $case->case_no?></td>
                                            <th width="25%"><?php echo lang('case')?> <?php echo lang('title')?></th>
                                            <td width="25%"><?php echo $case->title?></td>
                                        </tr>
                                        <tr>
                                            <th width="25%"><?php echo lang('fees_agreed')?> </th>
                                            <td width="25%"><?php echo $case->fees?></td>
                                            <th width="25%"><?php echo lang('paid')?></th>
                                            <td width="25%"><?php echo @$tot;?></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                </div>
                                
                <div class="tabbable mt-5" >
                            
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1" data-toggle="tab"><?php echo lang('invoice');?></a></li>
                                    <li style="display: none;"><a href="#2" data-toggle="tab"><?php echo lang('receipt');?></a></li>                            
                                </ul>
                            <div class="tab-content">
                                    <div class="tab-pane active" id="1">
              <!-- form start -->
              <?php echo form_open_multipart(base_url('admin/cases/fees/'.$id), array('role'=>'form')); ?>
        
            
            
                <input type="hidden" name="inr" id="inr" value="<?php echo $case->fees?>" />
                <input type="hidden" name="bal" id="bal" value="<?php echo @$fees_all[0]->bal?>" />                
                <div class="form-group mt-5" > 
                    <legend><?php echo lang('invoice')?></legend>  
                </div>
                
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <legend><?php echo lang('client')?></legend>
                                <div >Name: <?php echo ($case->name) ? $case->name : "-"; ?></div>
                                <div>Address: <?php echo ($case->address) ? $case->address : "-";?></div>
                                <div>Gender: <?php echo ($case->gender) ? $case->gender : "-";?></div>
                                <div>Contact: <?php echo ($case->contact) ? $case->contact : "-" ;?></div>
                                <div>Email: <?php echo ($case->email) ? $case->email : "-" ;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('issue_date');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('issue_date') ? $this->input->post('issue_date') : (isset($invoice->issue_date) && !empty($invoice->issue_date) ? date('Y-m-d', strtotime($invoice->issue_date)) : ""));
                                    ?>
                                    <input type="text" name="issue_date" value="<?php echo $populate_data; ?>" class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('due_date');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('due_date') ? $this->input->post('due_date') : (isset($invoice->due_date) && !empty($invoice->due_date) ? date('Y-m-d', strtotime($invoice->due_date)) : ""));
                                    ?>
                                    <input type="text" name="due_date" value="<?php echo $populate_data; ?>" class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('payment_mode');?> </label>
                                    <select name="payment_mode_id" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('payment_mode');?>---</option>
                                        <?php
                                            $populate_data = ($this->input->post('payment_mode_id') ? $this->input->post('payment_mode_id') : (isset($invoice->payment_mode_id) && !empty($invoice->payment_mode_id) ? $invoice->payment_mode_id : "")); 
                                        foreach($payment_modes as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";   
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('invoice_number');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('invoice_no') ? $this->input->post('invoice_no') : (isset($invoice_no) && !empty($invoice_no) ? $invoice_no : ""));
                                        
                                    ?>
                                    <input type="text" name="invoice_no" value="<?php echo $populate_data ;?>" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('category');?> </label>
                                    <select name="category" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('category');?>---</option>
                                        <?php
                                            $populate_data = ($this->input->post('category') ? $this->input->post('category') : (isset($invoice->new_category_id) && !empty($invoice->new_category_id) ? $invoice->new_category_id : "")); 
                                        foreach($categories as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";   
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('status');?> </label>
                                    <select name="status" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('status');?>---</option>
                                        <?php 
                                            $status_array = array('paid'=>'paid','unpaid'=>'unpaid','partially paid'=>'partially paid');

                                            $populate_data = ($this->input->post('status') ? $this->input->post('status') : (isset($invoice->status) && !empty($invoice->status) ? $invoice->status : ""));
                                        foreach($status_array as $new) {
                                            $sel = ($populate_data == $new) ?  "selected" : "";
                                            echo '<option value="'.$new.'" '.$sel.'>'.$new.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="name" ><?php echo lang('ref_number');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('reference_number') ? $this->input->post('reference_number') : (isset($invoice->ref_no) && !empty($invoice->ref_no) ? $invoice->ref_no : ""));
                                    ?>
                                    <input type="text" name="reference_number" value="<?php echo $populate_data; ?>" class="form-control">
                                </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="name" ><?php echo lang('tax');?> </label>
                                    <select name="tax_name" class="form-control chzn tax-list">
                                        <option value="">--<?php echo lang('select') ." ". lang('tax');?>---</option>
                                        <?php 
                                            $populate_data = ($this->input->post('tax_name') ? $this->input->post('tax_name') : (isset($invoice->new_tax_id) && !empty($invoice->new_tax_id) ? $invoice->new_tax_id : ""));
                                        foreach($tax as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h1>
                            <?php echo lang('product_service');?>
                        </h1>                       
                    </div>
                    <div class="col-md-12">
                        <div class="after_product_section">
                            <div class="row row_number_of_colum">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('items');?></label>
                                        <?php 
                                            $populate_data_arr = $this->input->post('product') ? $this->input->post('product') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->product_id) ? $invoice_product[0]->product_id :  '' ); 
                                        ?>
                                        <select name="product[]" class="form-control chzn product-name">
                                            <option value="">--<?php echo lang('select') ." ". lang('items');?>---</option>
                                            <?php 
                                            foreach($items as $new) {
                                                $sel = ($populate_data == $new->id) ?  "selected" : "";    
                                                echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('quantity');?></label>
                                        <?php 
                                        $populate_data_arr = $this->input->post('quantity') ? $this->input->post('quantity') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->quantity) ? $invoice_product[0]->quantity :  '' );
                                        ?>
                                        <input type="text" name="quantity[]" value="<?php echo $populate_data; ?>" class="form-control quantity">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('price');?></label>
                                        <?php 
                                            $populate_data_arr = $this->input->post('price') ? $this->input->post('price') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->price) ? $invoice_product[0]->price :  '' );
                                        ?>
                                        <input type="text" name="price[]" value="<?php echo $populate_data; ?>" class="form-control price">
                                    </div>
                                </div>    
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('tax');?></label><br/>
                                        <?php 
                                            $populate_data_arr = $this->input->post('tax') ? $this->input->post('tax') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->tax_value) ? $invoice_product[0]->tax_value :  '' );
                                        ?>
                                        <label for="name"  class="tax-label"><?php echo $populate_data; ?></label>
                                        <input type="hidden" name="tax[]" value="<?php echo $populate_data; ?>" class="form-control tax-input">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('discount');?></label>
                                        <?php 
                                            $populate_data_arr = $this->input->post('discount') ? $this->input->post('discount') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->discount) ? $invoice_product[0]->discount :  '' );
                                        ?>
                                        <input type="text" name="discount[]" value="<?php echo $populate_data; ?>" class="form-control discount">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('amount');?></label><br/>
                                        <?php
                                            $populate_data_arr = $this->input->post('amount') ? $this->input->post('amount') :array(); 
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->amount) ? $invoice_product[0]->amount :  '' );
                                        ?>
                                        <label for="name"  class="amount-label"><?php echo $populate_data; ?></label>
                                        <input type="hidden" name="invoice_amount[]" value="<?php echo $populate_data; ?>" class="form-control amount-input">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name" ><?php echo lang('description');?></label>
                                        <?php 
                                            $populate_data_arr = $this->input->post('description') ? $this->input->post('description') :array();
                                            $populate_data = isset($populate_data_arr[0]) ? $populate_data_arr[0] : (isset($invoice_product[0]->description) ? $invoice_product[0]->description :  '' );
                                        ?>
                                        <textarea name="description[]" class="form-control"><?php echo $populate_data; ?></textarea>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group m-t-20">
                                      <button class="btn btn-primary  btn-block add-more" type="button">
                                        <?php echo lang('admin_add_more'); ?></button>
                                      </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-100">
                    <div class="col-md-12 text-right pb-5 border-bottom-1-eee" >
                        <label for="name" class="label-clear-inline-padding" ><?php echo lang('sub_total');?></label>
                        <?php
                            $populate_data = ($this->input->post('sub_total') ? $this->input->post('sub_total') : (isset($invoice->sub_total) && !empty($invoice->sub_total) ? $invoice->sub_total : ""));
                        ?>
                        <div class="sub-total display-inline pr-5" ><?php echo $populate_data; ?></div>
                        <input type="hidden" name="sub_total" class="sub-total-input" value="<?php echo $populate_data; ?>">
                    </div>
                    <hr class="w-100">
                    <div class="col-md-12 border-bottom-1-eee text-right py-5" >
                        <label for="name" class="label-clear-inline-padding"><?php echo lang('discount');?></label>
                        <?php
                            $populate_data = ($this->input->post('discount_total') ? $this->input->post('discount_total') : (isset($invoice->discount) && !empty($invoice->discount) ? $invoice->discount : ""));
                        ?>
                        <div class="discount-total display-inline pr-5" ><?php echo $populate_data; ?></div>
                        <input type="hidden" name="discount_total" class="discount-total-input" value="<?php echo $populate_data; ?>">
                    </div>
                    <hr class="w-100">
                    <div class="col-md-12 text-right border-bottom-1-eee py-5">
                        <label for="name" class="label-clear-inline-padding tax-type "><?php echo lang('tax');?></label>
                        <?php
                            $populate_data = ($this->input->post('tax_total') ? $this->input->post('tax_total') : (isset($invoice->new_tax_total) && !empty($invoice->new_tax_total) ? $invoice->new_tax_total : ""));
                        ?>
                        <div class="tax-total display-inline pr-5" ><?php echo $populate_data; ?></div>
                        <input type="hidden" name="tax_total" class="tax-total-input" value="<?php echo $populate_data; ?>">
                    </div>
                    <hr class="w-100">
                    <div class="col-md-12 text-right py-5 border-bottom-1-eee ">
                        <label for="name" class="label-clear-inline-padding"><?php echo lang('total_amount');?></label>
                        <?php
                            $populate_data = ($this->input->post('gross_total') ? $this->input->post('gross_total') : (isset($invoice->new_total_amount) && !empty($invoice->new_total_amount) ? $invoice->new_total_amount : ""));
                        ?>
                        <div class="amount-total display-inline pr-5" ><?php echo $populate_data; ?></div>
                        <input type="hidden" name="gross_total" class="gross-total-input" value="<?php echo $populate_data; ?>">
                    </div>
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
                
                    
                </form>    
                    
                    
             <div class="box-body table-responsive mt-5" >
                    <table id="example2" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('invoice no')?></th>
                                <th><?php echo lang('date')?></th>
                                <th><?php echo lang('amount')?></th>
                                <th><?php echo lang('payment_mode')?></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($fees_all)) :?>
                        <tbody>
                            <?php $i=1;foreach ($fees_all as $new){
                                //p($fees_all);
                                ?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->invoice ?></td>
                                    <td><?php echo (isset($new->issue_date) && $new->issue_date ? date('Y-m-d', strtotime($new->issue_date)) : date('Y-m-d')); ?></td>
                                    <td><?php echo (isset($new->amount) && $new->amount) ? $new->amount : $new->new_total_amount;?></td>
                                    <td><?php echo $new->mode ? $new->mode : 'N/A';?></td>
                                    
                                    <td width="20%">
                                <?php if(check_user_role(108)==1) {?>
                                         <a class="btn btn-default ml-5"  href="<?php echo site_url('admin/invoice/index/'.$new->id); ?>" ><i class="fa fa-list"></i> <?php echo lang('invoice')?></a>
                                <?php } ?>     
                                <?php if(check_user_role(166)==1) {?>
                                         <a class="btn btn-danger ml-5"  href="<?php echo site_url('admin/cases/delete_fees/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                        <?php endif;?>
                    </table>
                    </div>                
                                    
                                    </div>
                                    <div class="tab-pane" id="2">
                                        
                                                  <!-- form start -->
                                            
            <?php if($due > 0) { ?>                                      
                <form method="post" action="<?php echo site_url('admin/cases/receipt/'.$id)?>" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
            
                <input type="hidden" name="case_id" value="<?php echo $id ?>" />
                    <div class="form-group mt-5" > 
                             <legend><?php echo lang('receipt_details')?></legend>  
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('invoice')?></b>
                                </div>
                                <div class="col-md-4">
                                   <select name="fees_id" class="form-control" required>
                                    <option value="">--<?php echo lang('select')?> <?php echo lang('invoice')?>--</option>
                                    <?php foreach ($fees_all as $new){?>
                                        <option value="<?php echo $new->id?>"><?php echo $new->invoice?></option>
                                    <?php } ?>
                                   </select>
                                    
                                </div>
                            </div>
                        </div>
                      
                        
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('date')?></b>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="r_date" value="" class="form-control datepicker" required />
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('amount')?></b>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="r_amount" value="" id="r_amount" class="form-control" required />
                                    
                                </div>
                            </div>
                        </div>
                    
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
                    
                </form>    
            <?php } ?>            
                    
             <div class="box-body table-responsive mt-5 " style="display: none;">
                    <table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('date')?></th>
                                <th><?php echo lang('amount')?></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($receipts)) : ?>
                        <tbody>
                            <?php $i=1;foreach ($receipts as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->date ?></td>
                                    <td><?php echo $new->amount?></td>
                                    
                                    <td width="20%">
                                <?php if(check_user_role(167)==1) {?>    
                                         <a class="btn btn-default ml-5" href="<?php echo site_url('admin/cases/view_receipt/'.$new->id); ?>" ><i class="fa fa-list"></i> <?php echo lang('receipt')?></a>
                                <?php }?>         
                                <?php if(check_user_role(169)==1) {?>         
                                         <a class="btn btn-danger ml-5"  href="<?php echo site_url('admin/cases/delete_deceipt/'.$new->id.'/'.$id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                <?php } ?>       
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                        <?php endif;?>
                    </table>
                    </div>                
            
                                    </div>                
                            </div>
            </div>                
                
                      
                          
                        
                           
                      
                        
                    </div><!-- /.box-body -->
    
                  
                    
                    
                </div><!-- /.box-body -->
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section>  


<section class="copy_product_section d-none">
    <div class="copied_product_section row_number_of_colum col-12 ">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="product[]" class="form-control chzn product-name">
                        <option value="">--<?php echo lang('select') ." ". lang('items');?>---
                        <?php 
                        foreach($items as $new) {
                            echo '<option value="'.$new->id.'">'.$new->name.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <input type="text" name="quantity[]" value="" class="form-control quantity">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <input type="text" name="price[]" value="" class="form-control price">
                </div>
            </div>    
            <div class="col-md-1">
                <div class="form-group">
                    <label for="name"  class="tax-label"></label>
                    <input type="hidden" name="tax[]" value="" class="form-control tax-input">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <input type="text" name="discount[]" value="" class="form-control discount">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="name"  class="amount-label"></label>
                    <input type="hidden" name="invoice_amount[]" value="" class="form-control amount-input">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <textarea name="description[]" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <button class="btn btn-danger btn-block remove_block_btn" type="button"><?php echo lang('admin_record_remove'); ?></button>
              </div>
            </div>
        </div>
    </div>
</section>

<div class="d-none" id="fees_dropdown_item" >
    <div class="row d-none" >
        <div class="col-md-3">
            <span>tax</span>
        </div>

        <div class="col-md-4">
            <select name="tax_id[]" class="form-control tax" required id="tax'+t+'">
                <option value="">-- Select Tax --</option>
                <?php foreach($tax as $new)
                {
                    echo "<option value=".$new->id.">".$new->name." - ".$new->percent."</option>";
                }?>
            </select>
        </div>

        <a href="#" class="remove_field btn btn-danger">Remove</a>
    </div>
</div>