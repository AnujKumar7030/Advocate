
<section class="content-header">
    <h1>
        <?php echo lang('appointments');?>
        <small><?php echo lang('view');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/appointments')?>"><?php echo lang('appointments');?></a></li>
        <li class="active"><?php echo lang('view');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('view');?> <?php echo $appointment->title;?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart(''); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" > <?php echo lang('title');?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo $appointment->title;?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('contact');?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php foreach($contacts as $new) {
                                        $sel = "";
                                        if($new->id==$appointment->contact_id) { echo $new->name;
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('motive');?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo $appointment->motive;?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('date');?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo date_time_convert($appointment->date_time);?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('notes');?></label>
                                </div>    
                                <div class="col-md-4">    
                                    <?php echo $appointment->notes;?>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $CI = get_instance();
                        if($fields) 
                        {
                            foreach($fields as $doc)
                            {
                                $output = '';
                                if($doc->field_type==1) //testbox
                                {
                                    ?>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">    
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."' ")->row();?>        
                                                <?php echo @$result->reply; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php     
                                } 

                                if($doc->field_type==2) //dropdown list
                                {
                                    $values = explode(",", $doc->values); ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">    
                                               <?php  
                                               $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."'  ")->row();
                                                if(!empty($values) || !empty($result)) 
                                                {
                                                    foreach($values as $key=>$val) 
                                                    {

                                                        if($val==@$result->reply) 
                                                        { 
                                                            echo @$val;
                                                        }
                                                    }
                                                } ?>            
                                            </div>
                                        </div>
                                    </div>  <?php	        
                                } 

                                if($doc->field_type==3) //radio buttons
                                {
                                    $values = explode(",", $doc->values);
                                    ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">    
                                               <?php	
                                                foreach($values as $key=>$val) 
                                                { 
                                                    $x="";
                                                    $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."' ")->row();

                                                    if(!empty($result->reply)) 
                                                    {
                                                        if($result->reply==$val) {
                                                            $x= $val;
                                                        }else{
                                                            $x='';
                                                        }
                                                    }  
                                                    echo $x;            
                                                } ?>            
                                            </div>
                                        </div>
                                    </div> <?php 
                                }

                                if($doc->field_type==4) //checkbox
                                {
                                   $values = explode(",", $doc->values);
                                    ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">    
                                                <?php	
                                                foreach($values as $key=>$val) 
                                                { 
                                                    $x="";
                                                    $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."' ")->row();
                                                    $x='';
                                                    if(!empty($result->reply)) 
                                                    {
                                                        if($result->reply==$val) 
                                                        {
                                                            $x= 'checked="checked"';
                                                        }
                                                    }
                                                    echo $val;
                                                } ?>            
                                            </div>
                                        </div>
                                    </div>  <?php 
                                }    

                                if($doc->field_type==5) //Textarea
                                {  ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">    
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."'")->row();?>    
                                                <?php echo @$result->reply;?>
                                            </div>
                                        </div>
                                    </div> <?php 
                                }   

                                if($doc->field_type==6) //URl
                                {        ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."'")->row();?>    
                                                <a href="<?php echo @$result->reply;?>" target="_blank"> <?php echo @$result->reply;?></a>
                                            </div>
                                        </div>
                                    </div> <?php 
                                }    

                                if($doc->field_type==7) //EMAIL
                                {        ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."'")->row();?>    
                                                <a href="mailto:<?php echo @$result->reply;?>" target="_top"> <?php echo @$result->reply;?></a>
                                            </div>
                                        </div>
                                    </div>  <?php 
                                }    

                                if($doc->field_type==8) //Phone
                                {        ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="contact" ><?php echo $doc->name; ?></label>
                                            </div>    
                                            <div class="col-md-4">
                                                <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$appointment->id."' AND form = '".$doc->form."'")->row();?>    
                                                <?php echo @$result->reply;?>
                                            </div>
                                        </div>
                                    </div>  <?php 
                                }    
                            }
                        }  ?>  
                    </div><!-- /.box-body -->


                <?php form_close()?>
            </div><!-- /.box -->
        </div>
    </div>
</section>  