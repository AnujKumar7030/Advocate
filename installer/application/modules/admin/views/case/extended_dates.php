<section class="content-header">
    <h1>
        <?php echo lang('extended_dates_of_case_no')?> : <?php echo $case->case_no?>
        <small><?php echo $case->title?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('cases')?></a></li>
        <li class="active"><?php echo lang('extended_dates')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               
                <!-- form start -->
                <?php if(validation_errors()) { ?>        
                <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                    </div>
                <?php } ?>    
                <form method="post" action="<?php echo site_url('admin/cases/dates/'.$id)?>" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('next')?> <?php echo lang('date')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="date" value="" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('last')?> <?php echo lang('date')?></b>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" name="date2" value="" class="form-control datepicker">
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes')?></b>
                                </div>
                                <div class="col-md-4">
                                   <textarea name="notes" class="form-control"/></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('attachment')?> <?php echo lang('document')?></b>
                                </div>
                                <div class="col-md-4">
                                   <input type="file" name="img" value="" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        
                  </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
                    
                    <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo lang('serial_number')?></th>
                                <th><?php echo lang('next')?> <?php echo lang('date')?></th>
                                <th><?php echo lang('last')?> <?php echo lang('date')?></th>
                                <th><?php echo lang('notes')?></th>
                                <th><?php echo lang('attachment')?></th>
                                <th width="20%"><?php echo lang('action')?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($cases)) :?>
                        <tbody>
                            <?php $i=1;foreach ($cases as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo date_convert($new->next_date)?></td>
                                    <td><?php echo date_convert($new->last_date)?></td>
                                    <td><?php echo  substr($new->note, 0, 50)?></td>
                                    <td><?php if(!empty($new->document)) {?>
                                          <a class="btn btn-default" href="<?php echo base_url('assets/uploads/files/'.$new->document); ?>" target="_blank"><i class="fa fa-download"></i> Attachment</a>                    
                                   <?php }else {?>
                                            <?php echo lang('no')?> <?php echo lang('attachment')?>
                                   <?php } ?>  
                                    </td>
                                    
                                    <td width="20%">
                                <?php if(check_user_role(170)==1) {?>        
                                     <a class="btn btn-primary"  href="<?php echo site_url('admin/cases/dates_detail/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
                                <?php } ?>
                                <?php if(check_user_role(171)==1) {?>             
                                         <a class="btn btn-danger ml-5" href="<?php echo site_url('admin/cases/delete_history/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
                                <?php } ?>      
                                    </td>
                                </tr>
                                <?php $i++;
                            }?>
                        </tbody>
                        <?php endif;?>
                    </table>
                </div><!-- /.box-body -->
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section> 