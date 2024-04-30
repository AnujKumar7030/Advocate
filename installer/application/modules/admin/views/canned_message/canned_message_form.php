<section class="content-header">
    <h1>
        <?php echo lang('canned_message_form');?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/settings/canned_messages')?>"><?php echo lang('canned_messages');?></a></li>
        <li class="active"><?php echo lang('canned_message_form');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <div class="box-body">

                    <?php echo form_open('admin/settings/canned_message_form/'.$id); ?>

                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                <label for="name"><?php echo lang('name');?> </label>
                                <?php
                                $name_array = array('name' =>'name', 'class'=>'form-control', 'value'=>set_value('name', $name));

                                if(!$deletable) {
                                    $name_array['class']    = "form-control disabled";
                                    $name_array['readonly']    = "readonly";
                                }
                                 echo form_input($name_array);?>
                            </div>
                         </div>
                    </div>        
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">

                            <label for="subject"><?php echo lang('subject');?> </label>
                            <?php echo form_input(array('name'=>'subject', 'class'=>'form-control', 'value'=>set_value('subject', $subject)));?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">            
                                    <label for="description"><?php echo lang('message') ?></label>
                                    <?php
                                    $data    = array('id'=>'description', 'name'=>'content', 'class'=>'form-control redactor', 'value'=>set_value('content', $content));
                                    echo form_textarea($data);
                                    ?>
                            </div>
                        </div>
                    </div> 

                    <div class="form-actions">
                        <input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
                    </div>
                    
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>