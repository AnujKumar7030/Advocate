<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('content');?> <?php echo lang('pages');?></li>
        </ol>
</section>

<section class="content">
  	  	 <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
				  <?php if(check_user_role(56)==1){?>	
                    <a class="btn btn-default" href="<?php echo site_url('admin/pages/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                	<?php } ?>	
				</div>
            </div>    
        </div>	
        
  	
    <div class="row">
        <div class="col-xl-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('content');?> <?php echo lang('pages');?></h3>
                </div>   
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
								<th><?php echo lang('name');?></th>
                                <th><?php echo lang('slug');?> </th>
								<th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($page_data)):?>
                        <tbody>
                            <?php $i=1;foreach ($page_data as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->title; ?></td>
                                    <td><?php echo @$new->slug; ?></td>
									
                                    <td>
                                        <div class="btn-group">
                                            <?php 
                                            if(check_user_role(57)==1)
                                            { ?>	
    									       <a class="mr-25 btn btn-success" data-toggle="tooltip" data-placement="top" title="<?php echo lang('edit'); ?>" href="<?php echo site_url('admin/pages/update/'.$new->id); ?>"><i class="fa fa-edit"></i>
                                                </a> <?php 
                                            } 
                                            if(check_user_role(58)==1)
                                            { ?>	
                                                <a class="mr-25 btn btn-danger" data-toggle="tooltip" data-placement="top" title="<?php echo lang('delete'); ?>" href="<?php echo site_url('admin/pages/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> 
                                                </a> <?php 
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
