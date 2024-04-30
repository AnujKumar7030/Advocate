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
        <small><?php echo lang('edit')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('case')?></a></li>
        <li class="active"><?php echo lang('edit')?></li>
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
                    <h3 class="box-title"><?php echo lang('edit')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php echo form_open_multipart('admin/cases/edit/'.$id); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?> <?php echo lang('title')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="title" value="<?php echo $case->title;?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        
                              <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('case')?> <?php echo lang('number')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="case_no" value="<?php echo $case->case_no?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('client')?> <?php echo lang('name')?></b>
                                
                                </div>
                                <div class="col-md-4">
                                    <select name="client_id" class="form-control chzn">
                                    <option value="">--<?php echo lang('select')?> <?php echo lang('client')?>--</option>
                                    <?php foreach($clients as $new) {
                                        $sel = "";
                                        if($new->id==$case->client_id) { $sel = "selected='selected'";
                                        }
                                        echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
                                    }
                                        
                                    ?>
                                    </select>
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
                                            if($new->id==$case->location_id) { $sel = "selected='selected'";
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
                                    <select name="court_category_id"  id="court_category_id" class="chzn col-md-12" >
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('court')?> <?php echo lang('category')?>--</option>
                                        <?php foreach($court_categories as $new) {
                                            $sel = "";
                                            if($new->id==$case->court_category_id) { $sel = "selected='selected'";
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
                                    <b><?php echo lang('court')  ?></b>
                                </div>
                                <div class="col-md-4" id="court_result">
                                    <select name="court_id" id="court_id"  class="chzn col-md-12" >
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('court')?>--</option>
                                        <?php 
                                        foreach($courts as $new) 
                                        {
                                            $sel = "";
                                            if($new->id==$case->court_id) 
                                            { 
                                                $sel = "selected='selected'";
                                            }
                                            ?>

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
                                    <b><?php echo lang('case')?> <?php echo lang('category')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="case_category_id[]" class="chzn col-md-12" multiple="multiple" >
                                        <?php foreach($case_categories as $new) {
                                            $sel = (in_array($new->id, json_decode($case->case_category_id)))?'selected': '';
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
                                    <b><?php echo lang('case')?> <?php echo lang('stages')?></b>
                                </div>
                                <div class="col-md-4">
                                    <select name="case_stage_id" class="chzn col-md-12">
                                        <option value="">--<?php echo lang('select')?> <?php echo lang('case')?> <?php echo lang('stages')?>--</option>
                                        <?php foreach($stages as $new) {
                                            $sel = "";
                                            if($new->id==$case->case_stage_id) { $sel = "selected='selected'";
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
                                        <?php 
                                        
                                        foreach($acts as $new) {
                                            $sel = (in_array($new->id, json_decode($case->act_id)))?'selected': '';
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
                                   <textarea name="description" class="form-control"><?php echo $case->description;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('filling_date')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="start_date" autocomplete="off" value="<?php echo $case->start_date;?>" class="form-control datepicker"/>
                                </div>
                            </div>
                        </div>
                        
                                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('hearing_date')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="hearing_date" autocomplete="off" value="<?php echo $case->hearing_date;?>" class="form-control datepicker"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('opposite_lawyer')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="o_lawyer" value="<?php echo $case->o_lawyer;?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('total_fees')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="text" name="fees" value="<?php echo $case->fees;?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                        $CI = get_instance();
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
                                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();?>        
                            <input type="text" class="form-control" name="reply[<?php echo $doc->id ?>]" value="<?php echo @$result->reply; ?>"/>
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
                                                 <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();?>    
                            <select name="reply[<?php echo $doc->id ?>]" class="form-control">
                                                 <?php	
                                                    foreach($values as $key=>$val) {
                                                        $sel='';
                                                        if($val==$result->reply) { $sel = "selected='selected'";
                                                        }
                                                        echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
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
                                                        <?php 
                                                        $x="";
                                                        $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();
                                                        if(!empty($result->reply)) {
                                                            if($result->reply==$val) {
                                                                $x= 'checked="checked"';
                                                            }else{
                                                                $x='';
                                                            }
                                                        }
                                                        ?>            
                        
                        <input type="radio" name="reply[<?php echo $doc->id ?>]" value="<?php echo $val;?>" <?php echo $x;?> />    <?php echo $val;?> &nbsp; &nbsp; &nbsp; &nbsp;
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
                                                    <?php 
                                                    $x="";
                                                    $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."' ")->row();
                                                    if(!empty($result->reply)) {
                                                        if($result->reply==$val) {
                                                            $x= 'checked="checked"';
                                                        }else{
                                                            $x='';
                                                        }
                                                    }
                                                    ?>    
                                        
                                        <input type="checkbox" name="reply[<?php echo $doc->id ?>]"  <?php echo $x;?> value="<?php echo $val;?>" class="form-control" />    &nbsp; &nbsp; &nbsp; &nbsp;
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
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>    
                                        <textarea class="form-control" name="reply[<?php echo $doc->id ?>]" ><?php echo @$result->reply;?></textarea>
                                </div>
                            </div>
                        </div>
                                <?php }    if($doc->field_type==6) //url
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="url" value="<?php echo @$result->reply;?>" class="form-control" name="reply[<?php echo $doc->id ?>]"  />
                                </div>
                            </div>
                        </div>
                    
                                <?php }    if($doc->field_type==7) //email
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                        <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>    
                                        <input type="email" value="<?php echo @$result->reply;?>" name="reply[<?php echo $doc->id ?>]"  class="form-control" />
                                </div>
                            </div>
                        </div>
                            
                            
                                <?php }    if($doc->field_type==8) //Phone
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$case->id."' AND form = '".$doc->form."'")->row();?>    
                                    <input type="number" value="<?php echo @$result->reply;?>" class="form-control" name="reply[<?php echo $doc->id ?>]" />
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
                        <button type="submit" class="btn btn-primary"><?php echo lang('update')?></button>
                    </div>
             <?php echo form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  
