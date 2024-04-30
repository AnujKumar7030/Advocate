<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('my_leaves');?></li>
        </ol>
</section>

<section class="content">
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('my_leaves');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('date');?></th>
                                <th><?php echo lang('leave_type');?></th>
                                <th><?php echo lang('reason');?></th>
                                <th><?php echo lang('status');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($my_leaves)) :?>
                        <tbody>
                            <?php $i=1;foreach ($my_leaves as $new){
                                if($new->status==0) {
                                    $status = '<small class="badge bg-red">Pending</small>';
                                }else{
                                    $status = '<small class="badge bg-green">Approved</small>';
                                }
                                ?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo date_convert($new->date)?></td>
                                     <td><?php echo $new->leave_type?></td>
                                     <td><?php echo $new->reason?></td>
                                     <td><?php echo $status?></td>
                                    
                                    <td>
                                        <div class="btn-group">
                                <?php if($new->status==0) {?>        
                                         <a class="btn btn-danger ml-5" href="<?php echo site_url('admin/attendance/delete_my_leave/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
                                         
                                <?php } ?>         
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                        <?php endif;?>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>