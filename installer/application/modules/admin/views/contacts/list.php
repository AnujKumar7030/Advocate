

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="col-md3">
          <?php if(check_user_role(22)==1){?>
                    <a class="btn btn-default"style="margin-left:10px;" href="<?php echo site_url('admin/contacts/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
           <?php } ?> 
           <a class="btn btn-primary" style="margin-left:10px;" href="<?php echo site_url('admin/contacts/export/'); ?>"><i class="fa fa-download"></i> <?php echo lang('export');?></a>
            <?php if(check_user_role(22)==1){?>
                        <a href="#myModal" data-toggle="modal" class="btn bg-olive btn-flat margin"><i class="fa fa-caret-square-o-down"></i> <?php echo lang('import');?></a>    
           <?php } ?>       
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?></h3>                                    
                </div><!-- /.box-header -->
        
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serail_number');?></th>
                <th><?php echo lang('name');?></th>
                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($contacts)):?>
                        <tbody>
                            <?php $i=1;foreach ($contacts as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->name?></td>
                  
                                    <td  class="col-md-3">
                                        <div class="btn-group">
                                          <?php if(check_user_role(155)==1){?>  
                      <a class="btn btn-default"  href="<?php echo site_url('admin/contacts/view/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view');?></a>
                       <?php } ?>
                      <?php if(check_user_role(23)==1){?>  
                      <a class="btn btn-primary"  href="<?php echo site_url('admin/contacts/edit/'.$new->id); ?>" style="margin-left:10px;"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                       <?php } ?> 
                        <?php if(check_user_role(24)==1){?>
                                         <a class="btn btn-danger" style="margin-left:10px;" href="<?php echo site_url('admin/contacts/delete/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('import_contacts');?></h4>
      </div>
      <div class="modal-body">

            <form method="post" action="<?php echo site_url('admin/contacts/import') ?>" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                     <div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                        <b><?php echo lang('instruction');?>!</b> <?php echo lang('contacts_import_instruction');?>  
                                    </div>
                     
                     <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" ><?php echo lang('file');?></label>
                                    <input type="file" name="file" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        

                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                    </div>
             </form>
             <?php
              $download_file_path = "./assets/import-demo";
              if (!is_dir($download_file_path)) 
              {
                  mkdir($download_file_path, 0775, TRUE);
              }
             ?>
             <div class="col-12 my-2">
              <a target="_blank" href="<?php echo base_url('assets/import-demo/demo_contact.xlsx'); ?>"><?php echo lang('downlod_sample_file'); ?> </a>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close');?></button>  
      </div>
    </div>
  </div>
</div>