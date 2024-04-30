<section class="content-header">
        <h1>
            <?php echo $case_study->title; ?>
            <small><?php echo lang('attachments');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li><a href="<?php echo site_url('admin/case_study')?>"> <?php echo lang('case_study');?></a></li>
            <li class="active"><?php echo lang('attachments');?></li>
        </ol>
</section>

<section class="content">
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?> <?php echo lang('attachments');?></h3>                                    
                </div><!-- /.box-header -->
                 <div class="box-body">
                
                
                
               <div class="col-xs-12">
                  <form method="post" enctype="multipart/form-data">
                      <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    <div class="form-group input_fields_wrap">
                            <div class="row  ">
                                <div class="col-md-2">
                                    <label for="name" > Attachment</label>
                                    
                                </div>
                                <div class="col-md-4" >
                                        <input type="text" name="title[]" value="" class="form-control" placeholder="Title" />
                                        
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="doc[]" value="" class="form-control" />
                                    
                                </div>
                                
                                        <div class="col-md-3">
                                                <button class="add_field_button btn btn-success">Add More </button>
                                        </div>
                                    
                                
                            </div>
                        </div>
                <?php if(check_user_role(122)==1) {?>        
                
                    <div class="row ">
                        <div class="col-xs-12 p-20" >
                            <input type="submit" name="ok" value="Save" class="btn btn-primary" />
                        </div>
                    </div>
                <?php } ?>    

                    </form>    
                </div>
                
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('name');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($documents)) :?>
                        <tbody>
                            <?php $i=1;foreach ($documents as $new){?>
                                <tr class="gc_row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $new->title?></td>
                                     <td class="col-md-3">
                                        <div class="btn-group">
                                         <a class="btn btn-default ml-2"  href="<?php echo site_url('admin/case_study/download/'.$new->id); ?>" ><i class="fa fa-download"></i> <?php echo lang('download');?></a>
                                         
                                <?php if(check_user_role(153)==1) {?>     
                                         <a class="btn btn-danger ml-2"  href="<?php echo site_url('admin/case_study/delete_document/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
                                <?php } ?>
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