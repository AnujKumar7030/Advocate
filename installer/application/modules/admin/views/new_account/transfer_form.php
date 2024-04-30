<section class="content-header">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <h1>
        <?php echo lang('transfer');?>
        <?php if(isset($id)) { ?>
            <small><?php echo lang('edit');?></small>
        <?php } else { ?>
            <small><?php echo lang('add');?></small>
        <?php } ?>
    </h1>
</section>

<section class="content">
    <div class="row">
        <?php if(validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
            </div>        
        <?php } ?>
        <div class="col-md-12">
            <div class="box box-primary">  
                <?php echo form_open_multipart('', array('role'=>'form')); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('from_account');?> </label>
                                    <select name="from_id" class="form-control chzn client">
                                        <?php 
                                            $populate_data = (isset($transfer->from_id) && !empty($transfer->from_id) ? $transfer->from_id : "");
                                            $sel = ($populate_data == '0') ? "selected" : "";
                                            
                                        ?>
                                        <option value="0" <?php echo $sel; ?>><?php echo lang('cash'); ?></option>
                                        <?php     
                                            $populate_data = ($this->input->post('from_id') ? $this->input->post('from_id') : (isset($transfer->from_id) && !empty($transfer->from_id) ? $transfer->from_id : ""));
                                            
                                        foreach($bank_name as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->bank_name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('to_account');?> </label>
                                    <select name="to_id" class="form-control chzn client">
                                        <?php 
                                            $populate_data = (isset($transfer->to_id) && !empty($transfer->to_id) ? $transfer->to_id : "");
                                            $sel = ($populate_data == '0') ? "selected" : "";
                                        ?>
                                        <option value="0" <?php echo $sel; ?>><?php echo lang('cash'); ?></option>
                                        <?php     
                                            $populate_data = ($this->input->post('to_id') ? $this->input->post('to_id') : (isset($transfer->to_id) && !empty($transfer->to_id) ? $transfer->to_id : ""));

                                        foreach($bank_name as $new) {
                                            $sel = ($populate_data == $new->id) ?  "selected" : "";
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->bank_name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('amount');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('amount') ? $this->input->post('amount') : (isset($transfer->amount) && !empty($transfer->amount) ? $transfer->amount : ""));
                                    ?>
                                    <input type="number" name="amount" value="<?php echo $populate_data; ?>" class="form-control">
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('date');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('date') ? $this->input->post('date') : (isset($transfer->transfer_date) && !empty($transfer->transfer_date) ? $transfer->transfer_date : ""));
                                    ?>
                                    <input type="text" name="date" value="<?php echo $populate_data; ?>" class="form-control datepicker" autocomplete="off">
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" ><?php echo lang('reference');?> </label>
                                    <?php 
                                        $populate_data = ($this->input->post('reference') ? $this->input->post('reference') : (isset($transfer->reference_no) && !empty($transfer->reference_no) ? $transfer->reference_no : ""));
                                    ?>
                                    <input type="text" name="reference" value="<?php echo $populate_data; ?>" class="form-control">
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="name" ><?php echo lang('description');?> </label> 
                                   <?php 
                                        $populate_data = ($this->input->post('description') ? $this->input->post('description') : (isset($transfer->description) && !empty($transfer->description) ? $transfer->description : ""));
                                    ?>
                                    <textarea name="description" class="form-control"><?php echo $populate_data; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                        </div>
                    </div>
                <?php form_close(); ?>
            </div>
        </div>
    </div>
</section>