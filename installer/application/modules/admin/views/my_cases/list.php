<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list')?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('my_cases')?></li>
        </ol>
</section>

<section class="content">
             <div class="row" class="mb-5">
            
        </div>    
        
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                                                
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('case_number')?></th>
                                
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($cases)) :?>
                        <tbody>
                            <?php $i=1;foreach ($cases as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->case_no?></td>
                                    <td>
                                        <div class="btn-group">
                                          <a class="btn btn-primary"  href="<?php echo site_url('admin/my_cases/details/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
                                    
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