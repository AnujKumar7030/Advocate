<section class="content-header">
    <h1>
        <?php echo lang('bank_details')?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/employees')?>"><?php echo lang('employees')?></a></li>
        <li class="active"><?php echo lang('bank_details')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php 
    if(validation_errors()) {
        ?>
    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
    </div>

    <?php  } ?>
        <!-- left column -->
        <div class="col-md-12">
        
        <div class="row mb-5" >
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                    <a class="btn btn-default" href="<?php echo site_url('admin/employees/add_bank_details/'.$id); ?>"><i class="fa fa-plus"></i> <?php echo lang('add')?> <?php echo lang('new')?></a>
                </div>
            </div>    
        </div>    
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('bank_details')?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
        
                    
                         <div class="box-body table-responsive" >
                     <?php if(!empty($details)) :?>
                      
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('account_holder_name')?></th>
                                <th><?php echo lang('account_number')?></th>
                                <th><?php echo lang('bank_name')?></th>
                                <th><?php echo lang('ifsc_code')?></th>
                                <th><?php echo lang('pan_number')?></th>
                                <th><?php echo lang('branch')?></th>
                                <th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php $i=1;foreach ($details as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->account_holder_name ?></td>
                                    <td><?php echo $new->account_number ?></td>
                                    <td><?php echo $new->bank_name ?></td>
                                    <td><?php echo $new->ifsc?></td>
                                    <td><?php echo $new->pan ?></td>
                                    <td><?php echo $new->branch ?></td>
                                    
                                    <td class="col-md-1">
                                <?php if(check_user_role(125)==1) {?>    
                                        <div class="btn-group">
                                         <a class="btn btn-danger ml-20" href="<?php echo site_url('admin/employees/delete_bank_details/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                        </div>
                                <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                       
                    </table>
                     <?php endif;?>
                </div>
                    

                    </div><!-- /.box-body -->
    
                  
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  