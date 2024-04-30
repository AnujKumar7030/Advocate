<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('to_do_list');?></li>
        </ol>
</section>

<section class="content">
             <div class="row mb-5">
             
        </div>    
        
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('view_all');?> <?php echo lang('to_do');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('date');?></th>
                                <th><?php echo lang('title');?></th>
                                <th><?php echo lang('description');?></th>
                                
                            </tr>
                        </thead>
                        
                        <?php if(isset($lists)) :?>
                        <tbody>
                            <?php $i=1;foreach ($lists as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo date_convert($new->date)?></td>
                                    <td><?php echo $new->title?></td>
                                    <td><?php echo $new->description?></td>
                                    
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