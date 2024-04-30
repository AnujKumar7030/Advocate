<?php $admin = $this->session->userdata('admin'); ?>

<section class="content-header">
    <h1>
        <?php echo $task->name;?>
        <small><?php echo lang('comments');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/tasks')?>"><?php echo lang('tasks');?> </a></li>
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
                                    <h3 class="box-title"><?php echo lang('comments');?> </h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                            <?php if(empty($messages)) {?>
                             <div class="item text-color-FF6633 pl-20" ><strong>No Comments..</strong></div>
                            <?php } ?>
                            <?php if(isset($messages)) :?>        
                                <?php $i=1;foreach ($messages as $new){?>        
                                    <div class="item">
                                    <?php 
                                    if(empty($new->image)) {
                                        ?>
                                        <img src="<?php echo base_url('assets/default/user.jpg')?>" alt="user image" class="online" style="margin-bottom: 10px;"/>
                                    <?php }else{ 

                                        ?>
                                     <img src="<?php echo base_url('assets/default/user.jpg')?>" alt="user image" class="online" style="margin-bottom: 10px;"/>
                                    <?php }?>    
                                        <p class="message pt-12">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo date_time_convert($new->date_time) ?></small>
                                        <?php if($new->comment_by== $admin['id']) {
                                        
                                            ?>     
                                            
                                        <span class="text-white-ff">     <?php echo $new->from_user ?></span> 
                                    
                                        <?php }else    { echo $new->from_user ;
                                        }?>     
                                            </a>
                                    <?php echo $new->comment?> 
                                        </p>
                                    </div><!-- /.item -->
                                    <?php $i++;
                                }?>
                            <?php endif;?> 
                                     
                                </div><!-- /.chat -->
                               
                            </div><!-- /.box (chat box) -->
    <!-- form start -->
            

                <h3 class="text-white-ff" ><?php echo validation_errors(); ?></h3>
                <?php echo form_open_multipart('admin/tasks/comments/'.$id.'?'.$my_tasks); ?>
                    <div class="box-body">
                        <div class="box-body">
                        
                        
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="name" ><?php echo lang('comment');?></label>
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