<section class="content-header">
    <h1>
        <?php echo lang('contact');?>
        <small><?php echo lang('view');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/contacts')?>"><?php echo lang('contacts');?></a></li>
        <li class="active"><?php echo lang('view');?></li>
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
                    <h3 class="box-title"><?php echo lang('view');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                   <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" > <?php echo lang('name');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo @$contact->name ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('phone');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo $contact->contact?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('email');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo @$contact->email ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name" ><?php echo lang('address');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo $contact->address?>
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
                              
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."' ")->row();?>        
                            </div>
                                <div class="col-md-4">
                                                    <?php echo @$result->reply; ?>
                                </div>
                            </div>
                        </div>
                                <?php     }    
                                if($doc->field_type==2) //dropdown list
                                {
                                        $values = explode(",", $doc->values);
                                    ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
                                                 <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."' ")->row();?>    
                                                 <?php	
                                                    foreach($values as $key=>$val) {
                                                        if($val==$result->reply) { echo $val;
                                                        }
                                                    }
                                                    ?>            
                                </div>
                            </div>
                        </div>
                                <?php	}    
                                if($doc->field_type==3) //radio buttons
                                {
                                                  $values = explode(",", $doc->values);
                                    ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
                                                  <?php	
                                                    foreach($values as $key=>$val) { ?>
                                                        <?php 
                                                        $x="";
                                                        $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."' ")->row();
                                                        if(!empty($result->reply)) {
                                                            if($result->reply==$val) {
                                                                $x= $val;
                                                            }else{
                                                                $x='';
                                                            }
                                                        }
                                                        ?>            
                        
                                                        <?php echo $x;?> 
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
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                            </div>
                                <div class="col-md-4">
                                               <?php	
                                                foreach($values as $key=>$val) { ?>
                                                    <?php 
                                                    $x="";
                                                    $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."' ")->row();
                                                    if(!empty($result->reply)) {
                                                        if($result->reply==$val) {
                                                            $x= $val;
                                                        }else{
                                                            $x='';
                                                        }
                                                    }
                                                    ?>    
                                        
                                                    <?php echo $x;?> 
                                                <?php             }
                                                ?>            
                                </div>
                            </div>
                        </div>
                                <?php }    if($doc->field_type==5) //Textarea
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."'")->row();?>    
                                    <?php echo @$result->reply;?>
                                </div>
                            </div>
                        </div>
                            
                                <?php }    if($doc->field_type==6) //URl
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."'")->row();?>    
                                        <a href="<?php echo @$result->reply;?>" target="_blank"> <?php echo @$result->reply;?></a>
                                </div>
                            </div>
                        </div>
                        
                                <?php }    if($doc->field_type==7) //EMAIL
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                        <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."'")->row();?>    
                                        <a href="mailto:<?php echo @$result->reply;?>" target="_top"> <?php echo @$result->reply;?></a>
                                </div>
                            </div>
                        </div>                
                    
                                <?php }    if($doc->field_type==8) //Phone
                                {        ?>    <div class="form-group">
                              <div class="row">
                                <div class="col-md-2">
                                    <label for="contact" ><?php echo $doc->name; ?></label>
                                </div>    
                                <div class="col-md-4">
                                    <?php  $result = $CI->db->query("select * from rel_form_custom_fields where custom_field_id = '".$doc->id."' AND table_id = '".$contact->id."' AND form = '".$doc->form."'")->row();?>    
                                        <?php echo @$result->reply;?>
                                </div>
                            </div>
                        </div>    
                        
                        
                        
                        
                                    <?php 
                                }    
                            }
                        }
                        ?>        

                        
                        
                           
                      
                        
                    </div><!-- /.box-body -->
    
                   
            </div><!-- /.box -->
        </div>
     </div>
</section> 
