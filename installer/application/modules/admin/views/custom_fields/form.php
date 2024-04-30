<section class="content-header">
    <h1><?php echo lang('custom_fields')?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
      
        <li class="active"><?php echo lang('custom_fields')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php 
        if(validation_errors()) {
            ?>
        <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                            </div>

        <?php  } ?>  
                   
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                   
                </div><!-- /.box-header -->
                <!-- form start -->
                
            
                <form method="post" enctype="multipart/form-data"  action="<?php echo site_url('admin/custom_fields/')?>">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('select_form')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="form" class="form-control">
                                        <option value="0">--<?php echo lang('select_form')?>--</option>
                                        <option value="1"><?php echo lang('clients')?></option>
                                        <option value="2"><?php echo lang('case')?></option>
                                        <option value="3"><?php echo lang('to_do')?></option>
                                        <option value="4"><?php echo lang('contacts')?></option>
                                        <option value="5"><?php echo lang('appointments')?></option>
                                        <option value="6"><?php echo lang('employees')?></option>
                                        <option value="7"><?php echo lang('tasks')?></option>
                                    </select>    
                                </div>
                             </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('field_type')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="type" class="form-control" id="field">
                                        <option value="0">--<?php echo lang('select_field_type')?>--</option>
                                        <option value="1">Text Box</option>
                                        <option value="2">Dropdown List</option>
                                        <option value="3">Radio Button</option>
                                        <option value="4">Checkbox</option>
                                        <option value="5">Textarea</option>
                                        <option value="6">URL</option>
                                        <option value="7">Email</option>
                                        <option value="8">Phone</option>
                                    </select>    
                                </div>
                                <div class="col-md-4">
                                
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('field_name')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group" id="value-div">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('enter_field_values')?></b>
                                </div>
                                <div class="col-md-4">
                                      <textarea name="values" class="form-control"></textarea>
                                </div>
                                <div class="col-md-4">
                                        <?php echo lang('custom_field_instruction')?>
                                </div>
                             </div>
                        </div>
                                
                      
                      
                     <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>  
                      
                      
                       <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('field_name');?></th>
                                <th><?php echo lang('field_type');?></th>
                                <th><?php echo lang('form');?></th>
                                <th><?php echo lang('values');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($fields)) :?>
                        <tbody>
                            <?php $i=1;foreach ($fields as $new){
                                if($new->field_type==1) {
                                    $type= lang('textbox');
                                }
                                if($new->field_type==2) {
                                    $type=lang('dropdown_list');
                                }
                                if($new->field_type==3) {
                                    $type=lang('radio_button');;
                                }
                                if($new->field_type==4) {
                                    $type=lang('checkbox');
                                }
                                if($new->field_type==5) {
                                    $type=lang('textarea');
                                }
                                if($new->field_type==6) {
                                    $type=lang('url');
                                }
                                if($new->field_type==7) {
                                    $type=lang('email');
                                }
                                if($new->field_type==8) {
                                    $type=lang('phone');
                                }
                            
                                if($new->form==1) {
                                    $form_new=lang('clients');
                                }
                                if($new->form==2) {
                                    $form_new =lang('case');
                                }
                                if($new->form==3) {
                                    $form_new =lang('to_do');
                                }
                                if($new->form==4) {
                                    $form_new =lang('contacts');
                                }
                                if($new->form==5) {
                                    $form_new =lang('appointments');
                                }
                            
                                if($new->form==6) {
                                    $form_new =lang('employees');
                                }
                                if($new->form==7) {
                                    $form_new =lang('tasks');
                                }
                            
                            
                                ?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->name?></td>
                                    <td><?php echo $type?></td>
                                    <td><?php echo $form_new?></td>
                                    <td><?php echo $new->values?></td>
                                     
                                    <td>
                                        <div class="btn-group">
                                       <?php if(check_user_role(30)==1) {?> 
                                         <a class="mr-25 badge badge-danger" href="<?php echo site_url('admin/custom_fields/delete/'.$new->id); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo lang('delete'); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i></a>
                                       <?php } ?>     
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                        <?php endif;?>
                    </table>
                      
                      
                        
                    </div><!-- /.box-body -->
    
                   
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section>  