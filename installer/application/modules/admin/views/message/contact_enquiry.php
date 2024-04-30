<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('contact_enquiry');?></li>
        </ol>
</section>

<section class="content">
             
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th> <?php echo lang('Enquiry_date');?></th>
                                <th><?php echo lang('name');?></th>
                                <th> <?php echo lang('email');?></th>
                                <th> <?php echo lang('phone_number');?></th>
                                <th> <?php echo lang('Message');?></th>
                                <th> <?php echo lang('View');?></th>
                                
                            </tr>
                        </thead>
                        
                       
                        <tbody>
                        
                             <?php 
                            if ($messages) 
                            {
                                $i = 0;
                                foreach ($messages as $message) 
                                {
                                    $i++;
                                    ?>
                                     <tr>
                                        <td>
                                           <?php echo xss_clean($message['id']); ?>
                                        </td>
                                        <td>
                                           <?php echo xss_clean($message['name']); ?>
                                        </td>
                                        <td>
                                           <?php echo xss_clean($message['email']); ?>
                                        </td>
                                        <td>
                                           <?php echo xss_clean($message['phone_number']); ?>
                                        </td>
                                        <td>
                                           <?php echo xss_clean($message['created']); ?>
                                        </td>
                                        <td>
                                           <?php 
                                           $small = substr($message['message'], 0, 15);
                                           echo xss_clean($small); ?>
                                        </td>
                                        <td>
                                           <?php 
                                              $message_id = $message['id']; 

                                           ?>
                                           <a href="javascript:void(0)" class="view_message_modal btn btn-info" data-toggle="modal" data-target="#modal-<?php echo xss_clean($message_id); ?>"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                 <?php 
                                }
                            }?>

                        </tbody>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>



<?php // messages modal ?>
<?php if ($messages) : 
   $i = 0;
   ?>
   <?php foreach ($messages as $message) : 
      $i++;
      ?>
      <div class="modal fade" id="modal-<?php echo xss_clean($message['id']); ?>" data-id="<?php echo xss_clean($message['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo xss_clean($message['id']); ?>" aria-hidden="true">

         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 id="modal-label-<?php echo xss_clean($message['id']); ?>"><?php echo xss_clean($message['name']); ?></h4>
               </div>
               
               <div class="modal-body">
                  <p><?php echo xss_clean($message['message']); ?></p>
               </div>
             
               <div class="modal-footer">
                  <button type="button" class="btn btn-inverse" data-dismiss="modal"><?php echo lang('close'); ?></button>
               </div>
            </div>
         </div>
      </div>
   <?php endforeach; ?>
<?php endif; ?>
