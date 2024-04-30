<style>
    .add-btn
    {
        border:solid 1px #000000;
        padding:4px 10px;
        color:#000000;
    }
</style>

<section class="content-header">
    <h1>
        <?php echo lang('case')?>
        <small><?php echo lang('add'); //9990911444?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo base_url('admin/cases')?>"><?php echo lang('case')?></a></li>
        <li class="active"><?php echo lang('add')?></li>
    </ol>
</section>

<?php 
if(validation_errors()) 
{
    ?>
    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                    </div>

    <?php  
} ?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('admin/cases/add/'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?> <?php echo lang('title')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>">
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?> <?php echo lang('number')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="case_no" class="form-control" value="<?php echo set_value('case_no')?>">
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('client')?> <?php echo lang('name')?></b>
                                
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <select name="client_id" class="form-control chzn">
                                           <option value="">--<?php echo lang('select')?> <?php echo lang('client')?>--</option>
                                        <?php foreach($clients as $new) {
                                            $sel = "";
                                            if(set_select('client_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                            
                                        ?>
                                        </select>
                                        <span><a href="#myModal" data-toggle="modal" class="btn bg-olive btn-flat margin"><?php echo lang('add')?>  <?php echo lang('new')?> <?php echo lang('client')?></a></span>
                                    </div>
                                    
                                </div>
                                  <div class="col-md-4 mt-2">
                                        <a href="<?php echo base_url('admin/clients/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div>
                        
                        <?php /**
                        <!-- 

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('location')?></b>
                                </div>
                                <div class="col-md-4" id="location_result">
                                    <select name="location_id" id="location_id" class="chzn col-md-12" >
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('location')?>--</option>
                                        <?php foreach($locations as $new) {
                                            $sel = "";
                                            if(set_select('location_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-2">
                                        <a href="<?php echo base_url('admin/location/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('court')?> <?php echo lang('category')?></b>
                                </div>
                                <div class="col-md-4" id="court_category_result">
                                    <select name="court_category_id"  id="court_category_id" class="chzn col-md-12">
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('court')?> <?php echo lang('category')?>--</option>
                                        <?php foreach($court_categories as $new) {
                                            $sel = "";
                                            if(set_select('court_category_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-2">
                                        <a href="<?php echo base_url('admin/court_category/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div> -->  **/ ?>
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('court')?></b>
                                </div>
                                <div class="col-md-4" id="court_result">
                                    <select name="court_id" id="court_id"  class="chzn col-md-12" >
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('court')?>--</option>
                                        <?php  foreach($courts as $new) 
                                        {
                                            $sel = "";
                                            if(set_select('court_id', $new->id)) 
                                            { 
                                                $sel = "selected='selected'";
                                            } ?>
                                                <option value="<?php echo $new->id; ?>" <?php echo $sel; ?>>
                                                    <?php echo $new->name; ?>, <?php echo $new->location_name; ?> ( <?php echo $new->court_categorie_name; ?> )
                                                </option>
                                            <?php
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-2">
                                        <a href="<?php echo base_url('admin/court/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?>  <?php echo lang('category')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="case_category_id[]" class="chzn col-md-12" multiple="multiple" >
                                        <?php foreach($case_categories as $new) {
                                            $sel = "";
                                            if(set_select('case_category_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-2">
                                        <a href="<?php echo base_url('admin/case_category/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?> <?php echo lang('stage')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="case_stage_id" class="chzn col-md-12">
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('case')?> <?php echo lang('stage')?>--</option>
                                        <?php foreach($stages as $new) {
                                            $sel = "";
                                            if(set_select('case_stage_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mt-2">
                                        <a href="<?php echo base_url('admin/case_stage/add'); ?>" class="add-btn">Add</a>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('act')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="act_id[]" class="chzn col-md-12" multiple="multiple" >
                                        <?php foreach($acts as $new) {
                                            $sel = "";
                                            if(set_select('act_id', $new->id)) { $sel = "selected='selected'";
                                            }
                                            echo '<option value="'.$new->id.'" '.$sel.'>'.$new->title.'</option>';
                                        }
                                        
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('description')?></b>
                                </div>
                                <div class="col-md-4">
                                   <textarea name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('filling_date')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="start_date" autocomplete="off" class="form-control datepicker" value="<?php echo set_value('start_date'); ?>"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('hearing_date')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="hearing_date" autocomplete="off" value="<?php echo set_value('hearing_date'); ?>"class="form-control datepicker"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('opposite_lawyer')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="o_lawyer" value="<?php echo set_value('o_lawyer'); ?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('total_fees')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="fees" value="<?php echo set_value('fees'); ?>" class="form-control"/>
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
                                <div class="col-md-3">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    </div>
                                <div class="col-md-4">
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
                                <div class="col-md-3">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">    
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
                                <div class="col-md-3">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-3">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-3">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
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
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
                <?php echo form_close(); ?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
             <div id="err">  
                <?php 
                if(validation_errors()) {
                    ?>
        <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                            </div>
        
                <?php  } ?>  
            </div>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('add')?> <?php echo lang('new')?> <?php echo lang('client')?></h4>
      </div>
      <div class="modal-body">
            <form method="post" action="<?php echo site_url('admin/clients/add_client') ?>" id="my_form">
                     <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" ><?php echo lang('name')?></label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="gender" ><?php echo lang('gender')?></label>
                                    <input type="radio" name="gender" id="gender" value="Male" /> <?php echo lang('male')?>
                                    <input type="radio" name="gender" id="gender"value="Female" /> <?php echo lang('female')?>
                                </div>
                            </div>
                        </div>
               
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="dob" ><?php echo lang('date_of_birth')?></label>
                                    <input type="text" name="dob" id="dob"  class="form-control datepicker">
                                    
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="email" ><?php echo lang('email')?></label>
                                    <input type="text" name="email" id="email" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="username" ><?php echo lang('username')?></label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="password" ><?php echo lang('password')?></label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="password" ><?php echo lang('confirm')?> <?php echo lang('password')?></label>
                                    <input type="password" name="confirm" id="confirm" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="contact" ><?php echo lang('phone')?></label>
                                    <input type="text" name="contact" id="contact" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                              <div class="row">
                                <div class="col-md-12">
                                    <label for="contact" ><?php echo lang('address')?></label>
                                    <textarea name="address"  id="address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        
                            
                        <?php 
                        if($fields_clients) {
                            foreach($fields_clients as $doc){
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
                                    <label for="contact" ><?php echo $doc->name; ?></label>
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
                        <button type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close')?></button>  
                    </div>
             </form>

      </div>
      
    </div>
  </div>
</div>