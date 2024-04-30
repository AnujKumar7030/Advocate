

<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo lang('to_do_list');?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                  <?php if(check_user_role(17)==1){?>   
                    <a class="btn btn-default" href="<?php echo site_url('admin/to_do_list/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                <?php } ?>      
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('to_do_list');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('date');?></th>
                                <th><?php echo lang('title');?></th>
                                <th><?php echo lang('description');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($lists)):?>
                        <tbody>
                            <?php $i=1;foreach ($lists as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo date_convert($new->date)?></td>
                                    <td><?php echo $new->title?></td>
                                    <td><?php echo $new->description?></td>
                                    
                                    <td width="27%">
                                        <div class="btn-group">
                                        <?php if(check_user_role(19)==1){?> 
                                          <a class="btn btn-default"  href="<?php echo site_url('admin/to_do_list/view_to_do/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view');?></a>
                                         <?php } ?>  
                                  <?php if(check_user_role(18)==1){?>             
                                          <a class="btn btn-primary" style="margin-left:12px;"  href="<?php echo site_url('admin/to_do_list/edit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                                    <?php } ?>        
                                           <?php if(check_user_role(20)==1){?>   
                                         <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/to_do_list/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
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