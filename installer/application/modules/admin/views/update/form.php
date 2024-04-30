<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row page">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
      <div class="card">



        <?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?> 
        <div class="row">

          <div class="col-12">
            <div class="form-group <?php echo form_error('update') ? ' has-error' : ''; ?>">
              <?php echo  form_label(lang('Update Name'), 'update'); ?>

              <span class="required">*</span>
              <?php 
                $populateData = isset($update_data->update) && $update_data->update ? $update_data->update :  ''; 
              ?> 
              <input type="text" name="update" id="zip" class="form-control" value="<?php echo xss_clean($populateData);?>">
              <span class="small form-error"> <?php echo strip_tags(form_error('update')); ?> </span> 
            </div>
          </div>


          <div class="clearfix"></div>

          <hr />

          <div class="col-12">

            <input type="submit" name="submit"  value="<?php echo "Save Update";?>" class="btn btn-primary px-5 float-right">
          </div>
          <div class="clearfix"></div>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>
