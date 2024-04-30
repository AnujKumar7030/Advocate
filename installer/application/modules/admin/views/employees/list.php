<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list')?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('employees')?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                <?php if(check_user_role(38)==1){?> 
                    <a class="btn btn-default" href="<?php echo site_url('admin/employees/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add')?> <?php echo lang('new')?></a>
                    <?php } ?>  
                    <a class="btn btn-danger" style="margin-left:12px;" href="<?php echo site_url('admin/employees/export/'); ?>"><i class="fa fa-download"></i> <?php echo lang('export')?></a>
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('employees')?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('name')?></th>
                                <th><?php echo lang('user_role')?></th>
                                <th><?php echo lang('status')?></th>
                                <th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($employees)):?>
                        <tbody>
                            <?php $i=1;foreach ($employees as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo ucwords($new->name)?></td>
                                    <td><?php echo $new->role ?></td>
                                    <td><?php echo ($new->status==1)?lang('active'):lang('inactive');?>  </td>
                                    
                                    <td width="50%">
                                        <div class="btn-group">
                                    <?php if(check_user_role(41)==1){?>     
                                          <a class="btn btn-default"  href="<?php echo site_url('admin/employees/view/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
                                    <?php } ?>          
                                          <?php if(check_user_role(39)==1){?>   
                                          <a class="btn btn-primary"  style="margin-left:12px;" href="<?php echo site_url('admin/employees/edit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
                                          <?php } ?>    
                                         <?php if(check_user_role(40)==1){?>     
                                         <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/employees/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                        <?php if(check_user_role(123)==1){?>     
                                         <a class="btn btn-info"  style="margin-left:12px;" href="<?php echo site_url('admin/employees/bank_details/'.$new->id); ?>"><i class="fa fa-bank"></i> <?php echo lang('bank_details')?></a>
                                          <?php } ?>    
                                         <?php if(check_user_role(126)==1){?>   
                                         <a class="btn btn-success"  style="margin-left:12px;" href="<?php echo site_url('admin/employees/documents/'.$new->id); ?>"><i class="fa fa-file"></i> <?php echo lang('documents')?></a>
                                          <?php } ?>    
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

