<section class="content-header">
    <h1>
        <?php echo lang('contact');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/contacts')?>"><?php echo lang('contacts');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
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
                                        <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                                    </div>

        <?php  } ?>
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/contacts/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('name');?></label>
                                    <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('phone');?></label>
                                    <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('email');?></label>
                                    <input type="text" name="email" value="<?php echo set_value('email'); ?>"class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('address');?></label>
                                    <textarea name="address" class="form-control"><?php echo set_value('address'); ?></textarea>
                                </div>
                            </div>
                        </div>
                            <?php 
                            if($fields) {
                                foreach($fields as $doc){
                                    $output = '';
                                    if($doc->field_type==1) //testbox
                                    {
                                        ?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            <input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" id="req_doc" />
                                </div>
                            </div>
                        </div>
                                    <?php     }    
                                    if($doc->field_type==2) //dropdown list
                                    {
                                                $values = explode(",", $doc->values);
                                        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            <select name="reply[<?php echo $doc->id ?>]" class="form-control">
                                                         <?php	
                                                            foreach($values as $key=>$val) {
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                                            ?>            
                            </select>    
                                </div>
                            </div>
                        </div>
                                    <?php	}    
                                    if($doc->field_type==3) //radio buttons
                                    {
                                           $values = explode(",", $doc->values);
                                        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                                              <?php	
                                                                foreach($values as $key=>$val) { ?>
                                        
                                        <input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" />    <?php echo $val;?> &nbsp; &nbsp; &nbsp; &nbsp;
                                                                <?php             }
                                                                ?>            
                                </div>
                            </div>
                        </div>
                        
                                    <?php }
                                    if($doc->field_type==4) //checkbox
                                    {
                                                           $values = explode(",", $doc->values);
                                        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            
                                                           <?php	
                                                            foreach($values as $key=>$val) { ?>
                                        
                                        <input type="checkbox" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" class="form-control" />    &nbsp; &nbsp; &nbsp; &nbsp;
                                                            <?php             }
                                                            ?>            
                                </div>
                            </div>
                        </div>
                                    <?php }    if($doc->field_type==5) //Textarea
                                    {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ></textarea        
                                ></div>
                            </div>
                        </div>
                    
                    
                        
                                        <?php 
                                    }    if($doc->field_type==6) //url
                                    {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="url"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                            
                                               <?php 
                                    }    if($doc->field_type==7) //Email
                                    {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="email"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                                    
                                        <?php 
                                    }    if($doc->field_type==8) //Phone
                                    {?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <input type="number"  value=""name="reply[<?php echo $doc->id ?>]" class="form-control" >
                                </div>
                            </div>
                        </div>
                                                    
                                
                        
                        
                                        <?php 
                                    }    
                                }
                            }
                            ?>    
                        
                        </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  