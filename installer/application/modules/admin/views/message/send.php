<link href="<?php echo base_url('assets/plugins/chosen/chosen.css')?>" rel="stylesheet" type="text/css" />
<?php $admin = $this->session->userdata('admin'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo lang('send');?>
        <small><?php echo lang('message');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/message')?>"><?php echo lang('select');?> <?php echo lang('user');?></a></li>
        <li class="active"><?php echo lang('send');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                             <!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title"><?php echo lang('message');?> <?php echo lang('to');?> <?php echo $client->name; ?></h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                            <?php if(isset($messages)) :?>        
                                <?php 
                                $i=1;foreach ($messages as $new){?>        
                                    <div class="item">
                                    <?php 
                                    if(empty($new->image)) {
                                        ?>
                                        <img src="<?php echo base_url('assets/uploads/images/avatar5.png')?>" alt="user image" class="online"/>
                                    <?php }else{ ?>
                                     <img src="<?php echo base_url('assets/uploads/images/'.$new->image)?>" alt="user image" class="online"/>
                                    <?php }?>    
                                        <p class="message pt-5" >
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo date_time_convert($new->date_time) ?></small>
                                        <?php if($new->from_id== $admin['id']) {
                                        
                                            ?>     
                                            
                                        <span class="text-white-ff" >     <?php echo $new->from_user ?></span> 
                                    
                                        <?php }else    { echo $new->from_user ;
                                        }?>     
                                            </a>
                                             <?php echo $new->message ?> 
                                        </p>
                                    </div><!-- /.item -->
                                    <?php $i++;
                                }?>
                            <?php endif;?> 
                                     
                                </div><!-- /.chat -->
                               
                            </div><!-- /.box (chat box) -->
                        <!-- form start -->
            

                <h3 class="text-white-ff" ><?php echo validation_errors(); ?></h3>
                <?php echo form_open_multipart('admin/message/send/'.$id); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="name" ><?php echo lang('message');?></label>
                                    <textarea name="message"class="form-control redactor"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                           
                         
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section> 