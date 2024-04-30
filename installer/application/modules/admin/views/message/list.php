<?php
$CI = get_instance();
$CI->load->model('message_model');
?>    


<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('message');?></li>
        </ol>
</section>

<section class="content">
         
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('select_client_to_send_message'); ?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                     <?php 
                        if(isset($clients) && $clients) { ?>
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('email');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                       
                        <tbody>
                        
                            <?php $i=1;foreach ($clients as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->name?>
                                    <?php
                                    $admin = $this->session->userdata('admin');
                                    $result = $CI->db->query("SELECT `M`.*, `U1`.`name` from_user, `U2`.`name` to_user, `U1`.`image` FROM (`message` M) LEFT JOIN `users` U2 ON `U2`.`id` = `M`.`to_id` LEFT JOIN `users` U1 ON `U1`.`id` = `M`.`from_id` WHERE `M`.`to_id` = '".$admin['id']."' AND `M`.`from_id` = '".$new->id."' AND `M`.`is_view_to` = 1 ")->result();
                                    if(!$result!=0){
                                    echo "";
                                    }else{
                                    ?>  
                                         <small class="badge pull-right bg-red"><?php echo count($result) ?></small>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $new->email; ?></td>
                                    
                                    <td>
                                        <div class="btn-group">
                                        
                                          <a class="btn btn-primary"  href="<?php echo site_url('admin/message/send/'.$new->id); ?>"><i class="fa fa-eye"></i> View Message Board</a>

                                          <a class="btn btn-danger"  href="<?php echo site_url('admin/message/delete/'.$new->id); ?>"><i class="fa fa-eye"></i> Delete</a>                                       
                                         
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;}?>
                        </tbody>
                        
                            
                                           
                    </table>
                    <?php } else{ ?>
                            <div>No record found</div>
                        <?php } ?>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>