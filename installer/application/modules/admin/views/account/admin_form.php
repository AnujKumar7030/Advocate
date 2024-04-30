<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('user') . " ". lang('form');?>
        <small><?php echo lang('add')?>/<?php echo lang('update')?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
       
        <li class="active"><?php echo lang('form')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php 
                    if($this->uri->segment(2)=='account') {
                        echo 'Account';
                    }else{
                        echo ($this->uri->segment(4)=='')?'Add':'Update';
                    }?>
                    </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo validation_errors(); ?>
                <form method="post" action="<?php echo site_url('/admin/account/form/'.$id);?>" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                   <label><?php echo lang('name')?></label>
                                    <?php
                                    $data    = array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                        </div>    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                   <label><?php echo lang('profile')?> <?php echo lang('picture')?></label>
                                    <input type="file" name="img" class="form-control" value="" />
                                </div>
                                 <div class="col-md-3">
                                     <?php 
                                        if(!empty($image)) {
                                            ?>
                                     <img src="<?php echo site_url('assets/uploads/images/'.$image);?>" height="70" width="70" />
                                            <?php 
                                        }else{
                                            echo "-";
                                        }
                                        ?>    
                                 </div>
                            </div>
                        </div>  
                         
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label><?php echo lang('username')?></label>
                                    <?php
                                    $data    = array('name'=>'username', 'value'=>set_value('username', $username), 'class'=>'form-control', 'disabled'=>'disabled');
                                    echo form_input($data);
                                    ?>
                                </div>
                                <div class="col-md-3">
                                   <label><?php echo lang('email')?></label>
                                    <?php
                                    $data    = array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'form-control');
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-3">
                                <label><?php echo lang('password')?></label>
                                <?php
                                $data    = array('name'=>'password', 'class'=>'form-control');
                                echo form_password($data); ?>
                            </div>
                            <div class="col-md-3">
                                <label><?php echo lang('confirm_password')?></label>
                                <?php
                                $data    = array('name'=>'confirm', 'class'=>'form-control');
                                echo form_password($data); ?>
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
                    <?php echo form_hidden('Admin', 'Admin')?>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  


