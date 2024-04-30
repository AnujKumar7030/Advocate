

<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('documents');?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                <?php if(check_user_role(119)==1){?>    
                    <a class="btn btn-default" href="<?php echo site_url('admin/documents/types/add'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                <?php } ?>      
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('documents');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('Color');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php 
                        if(isset($object) && $object)
                        { ?>
                            <tbody>
                                <?php 

                                $i=1;

                                foreach ($object as $obj)
                                { ?>

                                    <tr class="gc_row">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $obj->name; ?></td>
                                        <td style="color:<?php echo $obj->color; ?>"><?php echo $obj->color; ?></td>
                                        <td class="col-md-3">
                                            <div class="btn-group">
                                                <?php 
                                                
                                                if(check_user_role(120)==1)
                                                { ?>          
                                                      <a class="btn btn-primary" style="margin-left:2px;"   href="<?php echo site_url('admin/documents/types/update/'.$obj->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                                                <?php 
                                                } 

                                                if(check_user_role(120)==1)
                                                { ?>            
                                                     <a class="btn btn-danger" style="margin-left:2px;" href="<?php echo site_url('admin/documents/types/delete/'.$obj->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
                                                    <?php 
                                                } ?>               
                                            </div>
                                        </td>
                                    </tr> <?php 
                                    $i++;
                                } ?>
                            </tbody>
                                <?php 
                            } ?>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>