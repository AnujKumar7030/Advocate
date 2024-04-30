

<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                  <?php if(check_user_role(56)==1){?>   
                    <a class="btn btn-default" href="<?php echo site_url('admin/banking/add_transfer/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                    <?php } ?>  
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('date');?></th>
                                <th><?php echo lang('from_account');?></th>
                                <th><?php echo lang('to_account');?></th>
                                <th><?php echo lang('amount');?></th>
                                <th><?php echo lang('reference');?></th>
                                <th><?php echo lang('description');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($transfer_list)):?>
                        <tbody>
                            <?php $i=1;foreach ($transfer_list as $new){
                               
                                ?>
                                <tr class="gc_row">
                                    <td><?php echo date('M d, Y',strtotime($new->transfer_date)); ?></td>
                                    <td><?php echo ($new->from_name) ? $new->from_name : 'cash' ; ?></td>
                                    <td><?php echo ($new->to_name) ? $new->to_name : 'cash'; ?></td>
                                    <td><?php echo $new->amount; ?></td>
                                    <td><?php echo $new->reference_no; ?></td>
                                    <td><?php echo $new->description; ?></td>
                                    
                                    <td>
                                        <div class="btn-group">
                                            <?php if(check_user_role(57)==1){?> 
                                          <a class="btn btn-primary"  href="<?php echo site_url('admin/banking/edit_transfer/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                                          <?php } ?>    
                                          <?php if(check_user_role(59)==1){?>   
                                         <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/banking/delete_transfer/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
                                         <?php } ?> 
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;}?>
                        </tbody>
                        <?php endif;?>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>