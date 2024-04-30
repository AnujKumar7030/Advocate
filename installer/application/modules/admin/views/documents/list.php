

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
                    <a class="btn btn-default" href="<?php echo site_url('admin/documents/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
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
                                <th><?php echo lang('type');?></th>
                                <th><?php echo lang('case');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($documents)):?>
                        <tbody>
                            <?php $i=1;foreach ($documents as $new){
                            if(!empty($new->c_id)){
                                $link = '<a href="'.site_url('admin/cases/view_case/'.$new->c_id).'">#'.$new->case_no.' '.$new->case_title.'</a>';
                            }else{
                                $link = "-";
                            }
                            ?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->title?></td>
                                    <td><?php echo ($new->is_case==1)?lang('case'):lang('other');?></td>
                                    <td><?php echo $link?></td>
                                    <td class="col-md-3">
                                        <div class="btn-group">
                                    <?php if(check_user_role(122)==1){?>        
                                          <a class="btn btn-primary" style="margin-left:0px;"   href="<?php echo site_url('admin/documents/manage/'.$new->id); ?>"><i class="fa fa-chain"></i> <?php echo lang('manage');?></a>
                                        <?php } ?>        
                                    <?php if(check_user_role(120)==1){?>          
                                          <a class="btn btn-primary" style="margin-left:2px;"   href="<?php echo site_url('admin/documents/edit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                                    <?php } ?>            
                                <?php if(check_user_role(120)==1){?>            
                                         <a class="btn btn-danger" style="margin-left:2px;" href="<?php echo site_url('admin/documents/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
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