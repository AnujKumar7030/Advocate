

<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list')?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('tasks')?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                <?php if(check_user_role(113)==1){?>    
                    <a class="btn btn-default" href="<?php echo site_url('admin/tasks/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add')?> <?php echo lang('new')?></a>
                    <?php } ?>  
                    
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('tasks')?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('name')?></th>
                                <th width="12px;"><?php echo lang('priority')?></th>
                                <th><?php echo lang('due_date')?></th>
                                 <th><?php echo lang('created_by')?></th>
                                <th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($tasks)):?>
                        <tbody>
                            <?php $i=1;foreach ($tasks as $new){
                            $pr = "";
                            if($new->priority==1){
                                $pr = "<small class='label pull-right bg-blue'>Low</small>";
                            }
                            if($new->priority==2){
                                $pr = "<small class='label pull-right bg-green'>Medium</small>";
                            }
                            
                            if($new->priority==3){
                                $pr = "<small class='label pull-right bg-red'>High</small>";
                            }
                            
                            ?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo ucwords($new->task)?></td>
                                    <td><?php echo $pr ?></td>
                                    <td><?php echo $new->due_date ?> <?php if($new->due_date<date("Y-m-d") && $new->progress!=100 ){?> <small class='label pull-right bg-red'>Over Due</small> <?php }?></td>
                                    <td><?php echo $new->name ?> <small class='label pull-right bg-blue'><?php echo $new->role?></small></td>
                                    
                                    <td width="38%">
                                        <div class="btn-group">
                                    <?php if(check_user_role(115)==1){?>        
                                          <a class="btn btn-default"  href="<?php echo site_url('admin/tasks/view/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
                                    <?php } ?>  
                                    <?php if(check_user_role(114)==1){?>                
                                          <a class="btn btn-primary"  style="margin-left:12px;" href="<?php echo site_url('admin/tasks/edit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a><?php } ?>
                                          <?php if(check_user_role(116)==1){?>      
                                         <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/tasks/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                        <?php } ?>
                                        <?php if(check_user_role(117)==1){?>         
                                          <a class="btn btn-warning" style="margin-left:20px;" href="<?php echo site_url('admin/tasks/comments/'.$new->id); ?>" ><i class="fa fa-comments"></i> <?php echo lang('comments')?></a>
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