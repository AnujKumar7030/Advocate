<?php $CI = &get_instance(); ?>
<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list')?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('clients')?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
            <?php $ck1 = check_user_role(33);?> 
                <div class="btn-group pull-right">
                  <?php if($ck1==1){?>  
                    <a class="btn btn-default" href="<?php echo site_url('admin/clients/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add')?> <?php echo lang('new')?></a>
                <?php } ?>  
                    
                    <a class="btn btn-danger" style="margin-left:12px;" href="<?php echo site_url('admin/clients/export/'); ?>"><i class="fa fa-download"></i> <?php echo lang('export')?></a>
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('clients')?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('name')?></th>
                                <th><?php echo lang('phone')?></th>
                                <th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($clients)):?>
                        <tbody>
                            <?php $i=1;foreach ($clients as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo ucwords($new->name)?></td>
                                    <td><?php echo $new->contact ?></td>
                                    
                                    <td width="27%">
                                        <div class="btn-group">
                                            <?php 
                                            if(check_user_role(36)==1)
                                            {?> 
                                               <a class="btn btn-default"  href="<?php echo site_url('admin/clients/view_client/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
                                               <?php 
                                            } ?>                      
                                            <?php 
                                           if(check_user_role(34)==1)
                                            {?> 
                                              <a class="btn btn-primary"  style="margin-left:12px;" href="<?php echo site_url('admin/clients/edit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
                                               <?php 
                                            } ?>        
                                            <?php 
                                            if(check_user_role(35)==1)
                                            {?>                   
                                            <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/clients/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                            <?php 
                                            } ?>                             
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
