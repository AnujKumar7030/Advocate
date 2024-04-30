<section class="content-header">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <h1>
        <?php echo lang('invoice');?>
        <?php if(isset($id)) { ?>
            <small><?php echo lang('edit');?></small>
        <?php } else { ?>
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
            <?php echo form_open_multipart('', array('role'=>'form')); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('account_holder');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('bank_holder_name') ? $this->input->post('bank_holder_name') : (isset($account->bank_holder_name) && !empty($account->bank_holder_name) ? $account->bank_holder_name : ""));
                                ?>
                                <input type="text" name="bank_holder_name" value="<?php echo $populate_data; ?>" class="form-control">
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('bank_name');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('bank_name') ? $this->input->post('bank_name') : (isset($account->bank_name) && !empty($account->bank_name) ? $account->bank_name : ""));
                                ?>
                                <input type="text" name="bank_name" value="<?php echo $populate_data; ?>" class="form-control">
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('account_number');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('account_number') ? $this->input->post('account_number') : (isset($account->account_number) && !empty($account->account_number) ? $account->account_number : ""));
                                ?>
                                <input type="text" name="account_number" value="<?php echo $populate_data; ?>" class="form-control">
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('opening_balance');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('opening_balance') ? $this->input->post('opening_balance') : (isset($account->opening_balance) && !empty($account->opening_balance) ? $account->opening_balance : ""));
                                ?>
                                <input type="number" name="opening_balance" value="<?php echo $populate_data; ?>" class="form-control">
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('contact_number');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('contact_number') ? $this->input->post('contact_number') : (isset($account->contact_number) && !empty($account->contact_number) ? $account->contact_number : ""));
                                ?>
                                <input type="text" name="contact_number" value="<?php echo $populate_data; ?>" class="form-control">
                            </div>    
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" ><?php echo lang('bank_address');?> </label>
                                <?php 
                                    $populate_data = ($this->input->post('bank_address') ? $this->input->post('bank_address') : (isset($account->bank_address) && !empty($account->bank_address) ? $account->bank_address : ""));
                                ?>
                                <textarea name="bank_address" class="form-control"><?php echo $populate_data; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    </div>
</section>