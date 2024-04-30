<style>
    .add-btn
    {
        border:solid 1px #000000;
        padding:4px 10px;
        color:#000000;
    }
</style>

<section class="content-header">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <h1>
        <?php echo lang('invoice');?>
        <?php if(isset($id)) { ?>
            <small><?php echo lang('edit');?></small>
        <?php } else { ?>
            <small><?php echo lang('add');?></small>
        <?php }  ?>
    </h1>
</section>

<section class="content">
    <div class="row">
    <?php 
    if(validation_errors()) {
        ?>
    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                                    </div>

    <?php  } ?>  
       
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- form start -->
                <?php 
                    $populate_data = $this->input->post('quantity') ? $this->input->post('quantity') : (isset($invoice_product[0]->quantity) ? $invoice_product[0]->quantity :  '' );
                ?>
                <?php echo form_open_multipart('', array('role'=>'form')); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="name" ><?php echo lang('cases');?> </label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="cases" class="form-control chzn client">
                                                    <option value="">--<?php echo lang('select') ." ". lang('cases');?>---</option>
                                                    <?php 
                                                
                                                        $populate_data = ($this->input->post('cases') ? $this->input->post('cases') : (isset($invoice->case_id) && !empty($invoice->case_id) ? $invoice->case_id : ""));

                                                    foreach($cases as $new) {
                                                        $sel = ($populate_data == $new->id) ?  "selected" : "";
                                                        echo '<option value="'.$new->id.'" '.$sel.'>'.$new->title.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <a href="<?php echo base_url('admin/cases/add'); ?>" class="add-btn">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="w-100" id="client-data"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" ><?php echo lang('issue_date');?> </label>
                                            <?php 
                                                $populate_data = ($this->input->post('issue_date') ? $this->input->post('issue_date') : (isset($invoice->issue_date) && !empty($invoice->issue_date) ? date('Y-m-d', strtotime($invoice->issue_date)) : ""));
                                            ?>
                                            <input type="text" name="issue_date" value="<?php echo $populate_data; ?>" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" ><?php echo lang('due_date');?> </label>
                                            <?php 
                                                $populate_data = ($this->input->post('due_date') ? $this->input->post('due_date') : (isset($invoice->due_date) && !empty($invoice->due_date) ? date('Y-m-d', strtotime($invoice->due_date)) : ""));
                                            ?>
                                            <input type="text" name="due_date" value="<?php echo $populate_data; ?>" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name" ><?php echo lang('invoice_number');?> </label>
                                            <?php 
                                                $populate_data = ($this->input->post('invoice_no') ? $this->input->post('invoice_no') : (isset($invoice->invoice) && !empty($invoice->invoice) ? $invoice->invoice : ""));
                                            if(isset($id)) {
                                                $populate_data = $populate_data;
                                            }
                                            else
                                            {
                                                $populate_data = $invoice_no;
                                            }
                                            ?>
                                            <input type="text" name="invoice_number" value="<?php echo $populate_data ;?>" class="form-control" readonly>
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
                                            <div class="col-md-4 mt-2">
                                                <a href="<?php echo base_url('admin/category/add'); ?>" class="add-btn">Add</a>
                                            </div>
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
                                                foreach($taxes as $new) {
                                                    $sel = ($populate_data == $new->id) ?  "selected" : "";
                                                    echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="col-md-4 mt-2">
                                                <a href="<?php echo base_url('admin/tax/add'); ?>" class="add-btn">Add</a>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label for="email" ><?php echo lang('email');?> </label>
                                            <?php 
                                                $populate_data = ($this->input->post('email') ? $this->input->post('email') : (isset($invoice->email) && !empty($invoice->email) ? $invoice->email : ""));
                                            ?>
                                            <input type="email" name="email" value="<?php echo $populate_data; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                                <div class="col-md-4 mt-2">
                                                    <a href="<?php echo base_url('admin/product_service/add'); ?>" class="add-btn">Add</a>
                                                </div>
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
                                                <input type="text" name="discount[]" value="<?php echo $populate_data; ?>" class="form-control discount total_amount_discount">
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
                                    <?php if(isset($invoice_product) && !empty($invoice_product)) { 
                                        unset($invoice_product[0]);
                                        foreach($invoice_product as $i_p_key => $i_p_value) {
                                            ?> 
                                        <div class="copied_product_section row_number_of_colum col-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select name="product[]" class="form-control chzn product-name">
                                                            <option value="">--<?php echo lang('select') ." ". lang('items');?>---
                                                            <?php 
                                                                $populate_data_arr = $this->input->post('product') ? $this->input->post('product') :array();
                                                                $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->product_id) ? $i_p_value->product_id :  '' );
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
                                                        <?php 
                                                            $populate_data_arr = $this->input->post('quantity') ? $this->input->post('quantity') :array();
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->quantity) ? $i_p_value->quantity :  '' );
                                                        ?>
                                                        <input type="text" name="quantity[]" value="<?php echo $populate_data; ?>" class="form-control quantity">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <?php 
                                                            $populate_data_arr = $this->input->post('price') ? $this->input->post('price') :array();
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->price) ? $i_p_value->price :  '' );
                                                        ?>
                                                        <input type="text" name="price[]" value="<?php echo $populate_data; ?>" class="form-control price">
                                                    </div>
                                                </div>    
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <?php 
                                                            $populate_data_arr = $this->input->post('tax') ? $this->input->post('tax') :array();
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->tax_value) ? $i_p_value->tax_value :  '' );
                                                        ?>
                                                        <label for="name"  class="tax-label"><?php echo $populate_data; ?></label>
                                                        <input type="hidden" name="tax[]" value="<?php echo $populate_data; ?>" class="form-control tax-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <?php 
                                                            $populate_data_arr = $this->input->post('discount') ? $this->input->post('discount') :array();
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->discount) ? $i_p_value->discount :  '' );
                                                        ?>
                                                        <input type="text" name="discount[]" value="<?php echo $populate_data; ?>" class="form-control discount">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <?php
                                                            $populate_data_arr = $this->input->post('amount') ? $this->input->post('amount') :array(); 
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->amount) ? $i_p_value->amount :  '' );
                                                        ?>
                                                        <label for="name"  class="amount-label"><?php echo $populate_data; ?></label>
                                                        <input type="hidden" name="invoice_amount[]" value="<?php echo $populate_data; ?>" class="form-control amount-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <?php 
                                                            $populate_data_arr = $this->input->post('amount') ? $this->input->post('amount') :array();
                                                            $populate_data = isset($populate_data_arr[$i_p_key]) ? $populate_data_arr[$i_p_key] : (isset($i_p_value->description) ? $i_p_value->description :  '' );
                                                        ?>
                                                        <textarea name="description[]" class="form-control"><?php echo $populate_data; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                  <div class="form-group">
                                                    <button class="btn btn-danger btn-block remove_block_btn" type="button"><?php echo lang('admin_record_remove'); ?></button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <?php } 
                                    } ?>  
                                </div>
                                <hr class="w-100">
                                <div class="col-md-12 text-right border-bottom-1-eee pb-5">
                                    <label for="name" class="pr-100 display-inline"><?php echo lang('sub_total');?></label>
                                    <?php
                                        $populate_data = ($this->input->post('sub_total') ? $this->input->post('sub_total') : (isset($invoice->sub_total) && !empty($invoice->sub_total) ? $invoice->sub_total : 0));
                                        //p($invoice);
                                    ?>
                                    <div class="sub-total display-inline pr-20" ><?php echo $populate_data; ?></div>
                                    <input type="hidden" name="sub_total" class="sub-total-input" value="<?php echo $populate_data; ?>">
                                </div>
                                <hr class="w-100">
                                <div class="col-md-12 text-right border-bottom-1-eee">
                                    <label for="name" class="display-inline pr-100 " ><?php echo lang('discount');?></label>
                                    <?php
                                        $populate_data = ($this->input->post('discount_total') ? $this->input->post('discount_total') : (isset($invoice->discount) && !empty($invoice->discount) ? $invoice->discount : 0));
                                    ?>
                                    <div class="discount-total display-inline pr-20"><?php echo $populate_data; ?></div>
                                    <input type="hidden" name="discount_total" id="total_amount_discount_text" class="discount-total-input" value="<?php echo $populate_data; ?>">
                                </div>
                                <hr class="w-100">
                                <div class="col-md-12 text-right border-bottom-1-eee py-5">
                                    <label for="name" class="display-inline pr-100 tax-type"><?php echo lang('tax');?></label>
                                    <?php
                                        $populate_data = ($this->input->post('tax_total') ? $this->input->post('tax_total') : (isset($invoice->new_tax_total) && !empty($invoice->new_tax_total) ? $invoice->new_tax_total : 0));
                                    ?>
                                    <div class="tax-total display-inline pr-20 "><?php echo $populate_data; ?></div>
                                    <input type="hidden" name="tax_total" class="tax-total-input" value="<?php echo $populate_data; ?>">
                                </div>
                                <hr class="w-100">
                                <div class="col-md-12 text-right border-bottom-1-eee py-5">
                                    <label for="name" class="display-inline pr-100" ><?php echo lang('total_amount');?></label>
                                    <?php
                                        $populate_data = ($this->input->post('gross_total') ? $this->input->post('gross_total') : (isset($invoice->new_total_amount) && !empty($invoice->new_total_amount) ? $invoice->new_total_amount : 0));
                                    ?>
                                    <div class="amount-total display-inline pr-20"><?php echo $populate_data; ?></div>
                                    <input type="hidden" name="gross_total" class="gross-total-input" value="<?php echo $populate_data; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>

<section class="copy_product_section d-none">
    <div class="copied_product_section row_number_of_colum col-12">
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