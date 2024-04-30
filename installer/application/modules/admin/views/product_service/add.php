<section class="content-header">
    <h1>
        <?php echo lang('product_service');?>
        <?php if(isset($product_service->id)) {
            ?>
            <small><?php echo lang('edit');?></small>
            <?php
        }
        else{
            ?>
        <small><?php echo lang('add');?></small>
        <?php } ?>
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
                
                <?php echo form_open_multipart('', array('role'=>'form')); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('name');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('name') ? $this->input->post('name') : (isset($product_service->name) && !empty($product_service->name) ? $product_service->name : ""));
                                    ?>
                                    <input type="text" name="name" value="<?php echo $populate_data; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('sku');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('sku') ? $this->input->post('sku') : (isset($product_service->sku) && !empty($product_service->sku) ? $product_service->sku : ""));
                                    ?>
                                    <input type="text" name="sku" value="<?php echo $populate_data; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('description');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('description') ? $this->input->post('description') : (isset($product_service->description) && !empty($product_service->description) ? $product_service->description : ""));
                                    ?>
                                    <textarea name="description"class="form-control"><?php echo $populate_data; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('sale_price');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('sale_price') ? $this->input->post('sale_price') : (isset($product_service->sale_price) && !empty($product_service->sale_price) ? $product_service->sale_price : ""));
                                    ?>
                                    <input type="number" name="sale_price" value="<?php echo $populate_data; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('purchase_price');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('purchase_price') ? $this->input->post('purchase_price') : (isset($product_service->purchase_price) && !empty($product_service->purchase_price) ? $product_service->purchase_price : ""));
                                    ?>
                                    <input type="number" name="purchase_price" value="<?php echo $populate_data; ?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax" ><?php echo lang('tax');?></label>
                                    <select name="tax" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('tax');?>---</option>
                                        <?php 
                                     
                                        $populate_data = ($this->input->post('tax') ? $this->input->post('tax') : (isset($product_service->tax_id) && !empty($product_service->tax_id) ? $product_service->tax_id : ""));
                                    
                                        foreach($tax as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax" ><?php echo lang('category');?></label>
                                    <select name="category" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('category');?>---</option>
                                        <?php 
                                        $populate_data = ($this->input->post('category') ? $this->input->post('category') : (isset($product_service->category_id) && !empty($product_service->category_id) ? $product_service->category_id : ""));    
                                        foreach($categories as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax" ><?php echo lang('unit');?></label>
                                    <select name="unit" class="form-control chzn">
                                        <option value="">--<?php echo lang('select') ." ". lang('unit');?>---</option>
                                        <?php 
                                            $populate_data = ($this->input->post('unit') ? $this->input->post('unit') : (isset($product_service->unit) && !empty($product_service->unit) ? $product_service->unit : ""));
                                            
                                            $sel_inch = $sel_pc = "";
                                        if($populate_data == 'inch') {
                                            $sel_inch = "selected";
                                        }
                                        else if($populate_data == 'pc') {
                                            $sel_pc = "selected";
                                        }
                                        ?>
                                        <option value="inch" <?php echo $sel_inch; ?>>Inch</option>
                                        <option value="pc" <?php echo $sel_pc; ?>>Pc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="name" ><?php echo lang('type');?> </label><br/>
                                   <?php 
                                        $populate_data = ($this->input->post('type') ? $this->input->post('type') : (isset($product_service->type) && !empty($product_service->type) ? $product_service->type : ""));
                                        $check_product = $check_service = "";
                                    if($populate_data == 'product') {
                                        $check_product = "checked";
                                    }
                                    else if($populate_data == 'service') {
                                        $check_service = "checked";
                                    }
                                    ?>
                                   <input type="radio" name="type" value="product" class="" <?php echo $check_product; ?>> <?php echo lang('product');?> 
                                   <input type="radio" name="type" value="service" class="" <?php echo $check_service; ?>> <?php echo lang('service');?> 
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>