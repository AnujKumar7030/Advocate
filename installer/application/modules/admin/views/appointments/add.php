
<section class="content-header">
    <h1>
        <?php echo lang('appointments');?>
        <small><?php echo lang('add');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/appointments')?>"><?php echo lang('appointments');?></a></li>
        <li class="active"><?php echo lang('add');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    
       
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php 
                if(validation_errors()) {
                       echo validation_errors();   
                } 
                ?>  
                <?php echo form_open_multipart('admin/appointments/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" > <?php echo lang('title');?></label>
                                    <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <?php if($get_user_role_slug->slug == 'admin') 
                        {
                        ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name"><?php echo lang('contact');?></label>
                                           <select name="contact_id" class="form-control chzn">
                                                <option value="">--<?php echo lang('select_contact');?>--</option>
                                                <?php foreach($contacts as $new) {
                                                    $sel = "";
                                                    if(set_select('contact_id', $new->id)) { $sel = "selected='selected'";
                                                    }
                                                    echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                                }
                                                ?>
                                            </select>
                                    </div>
                                    <a href="#myModal" data-toggle="modal" class="btn  btn-default margin"><i class="fa fa-plus"></i> <?php echo lang('add_new');?> <?php echo lang('contact');?></a>
                                </div>
                            </div>
                        <?php } ?>
                            
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('motive');?></label>
                                    <textarea name="motive" class="form-control"><?php echo set_value('motive'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('date');?></label>
                                    <input type="text" name="date_time" autocomplete="off" value="<?php echo set_value('date_time'); ?>" class="form-control datetimepicker">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name"><?php echo lang('notes');?></label>
                                    <textarea name="notes" class="form-control"></textarea>
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
                                    <label for="contact"><?php echo $doc->name; ?></label>
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
                                    <label for="contact"><?php echo $doc->name; ?></label>
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
                        <button type="submit" class="btn btn-primary" name="ok" value="ok"><?php echo lang('save');?></button>
                    </div>
             <?php echo  form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_new');?> <?php echo lang('contact');?></h4>
      </div>
      <div class="modal-body">
            <?php echo form_open_multipart('admin/contacts/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name"> <?php echo lang('name');?></label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" ><?php echo lang('phone');?></label>
                                    <input type="text" name="phone"class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" ><?php echo lang('email');?></label>
                                    <input type="text" name="email"class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" ><?php echo lang('address');?></label>
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                            
                                <?php 
                                if($contact_fields) {
                                    foreach($contact_fields as $doc){
                                        $output = '';
                                        if($doc->field_type==1) //testbox
                                        {
                                            ?>
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <label for="contact"><?php echo $doc->name; ?></label>
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
                                <div class="col-md-12">
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
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <label for="contact"><?php echo $doc->name; ?></label>
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ></textarea        
                                ></div>
                            </div>
                        </div>
                            
                        
                        
                                                <?php 
                                        }    
                                    }
                                }
                                ?>    
                        

                    </div><!-- /.box-body -->
    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close');?></button>  
                    </div>
             </form>

      </div>
    
    </div>
  </div>
</div>
