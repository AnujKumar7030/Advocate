<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('view_all');?> <?php echo lang('cases');?></li>
        </ol>
</section>

<section class="content">
             <div class="row mb-5" >
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                    <a class="btn btn-default" href="<?php echo site_url('admin/cases/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add');?> <?php echo lang('new');?></a>
                </div>
            </div>    
        </div>    
        
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('cases');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo lang('serial_number');?></th>
                                <th width="8%"><?php echo lang('star');?></th>
                                <th><?php echo lang('date');?></th>
                                <th><?php echo lang('case');?> <?php echo lang('number');?></th>
                                <th><?php echo lang('case');?> <?php echo lang('title');?></th>
                                <th><?php echo lang('client');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($cases)) :?>
                        <tbody>
                            <?php $i=1;foreach ($cases as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td class="small-col">
                                <?php if($new->is_starred==0) { ?>
                                    <a href="" at="90" class="Privat"><span class="d-none"><?php echo $new->id?></span>
                                    <i class="fa fa-star-o"></i></a>
                                    <?php 
                                }else{
                                    ?>
                                    <a href="" at="90" class="Public"><span class="d-none"><?php echo $new->id?></span>
                                    <i class="fa fa-star"></i></a>
                                    <?php
                                }
                                ?>
                                    </td>
                                    <td><?php echo $new->next_date?></td>
                                    <td><a href="<?php echo site_url('admin/cases/view_case/'.$new->case_id)?>"><?php echo $new->case_no?></a></td>
                                    <td><?php echo $new->title?></td>
                                    <td><?php echo $new->name?></td>
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