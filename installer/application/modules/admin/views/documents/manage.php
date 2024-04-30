<section class="content-header">
        <h1>
            <?php echo $document->title; ?>
            <small><?php echo lang('manage');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('documents');?></li>
        </ol>
</section>

<section class="content">
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('add');?> <?php echo lang('document');?></h3>                                    
                </div><!-- /.box-header -->
                 <div class="box-body">
                
                
                
                <div class="col-xs-12">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                        <div class="form-group after_add_more_section">
                            <div class="row  ">
                                <div class="col-md-12">
                                    <label for="name" > Documents</label>
                                    
                                </div>



                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="text" name="title[]" value="" class="form-control" placeholder="Title" />
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <select name="type[]" class="form-control">
                                            <option value="">Select One</option>
                                            <?php 
                                            foreach ($document_types as $obj) 
                                            {
                                                echo '<option style="color:'.$obj->color.'" value="'.$obj->id.'">'.$obj->name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <input type="file" name="doc[]" value="" class="form-control" />
                                    
                                </div>
                                
                                <div class="col-md-2" >
                                    <button class="add_field_button btn btn-success">Add More </button>
                                </div>                         
                            </div>

                        </div>
                        <?php 
                        if(check_user_role(122)==1) 
                        {?>        
                    
                            <div class="row ">
                                <div class="col-xs-12 p-20" >
                                    <input type="submit" name="ok" value="Save" class="btn btn-primary" />
                                </div>
                            </div>
                            <?php 
                        } ?>    

                    </form>    
                </div>
                
                
                <div class="box-body table-responsive" >
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('Type');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php 
                        if(isset($documents)) 
                        { ?>
                            <tbody>

                                <?php
                                $i=1;
                                foreach ($documents as $new)
                                {
                                    $link = "-";
                                    if(!empty($new->c_id)) 
                                    {
                                        $link = '<a href="'.site_url('admin/cases/view_case/'.$new->c_id).'">#'.$new->case_no.' '.$new->case_title.'</a>';
                                    } ?>
                                    <tr class="gc_row">
                                        <td><?php echo $i?></td>
                                        <td><?php echo $new->title?></td>
                                        <td style="color: <?php echo $new->documents_type_color ? $new->documents_type_color : "inherit"; ?>;">
                                            <?php echo $new->documents_type ? $new->documents_type : "-"; ?>
                                        </td>
                                        <td class="col-md-3">
                                            <div class="btn-group">
                                                <a class="btn btn-default ml-2" download href="<?php echo base_url('uploads/documents/'.$new->file_name); ?>" >
                                                    <i class="fa fa-download"></i> <?php echo lang('download');?>
                                                </a>
                                             
                                                <?php 
                                                if(check_user_role(153)==1) 
                                                { ?>     
                                                    <a class="btn btn-danger ml-2" href="<?php echo site_url('admin/documents/delete_document/'.$new->id); ?>" onclick="return areyousure()">
                                                        <i class="fa fa-trash"></i> <?php echo lang('delete');?>
                                                    </a>
                                                    <?php 
                                                } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                    $i++;
                                }?>
                            </tbody><?php 
                        }?>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>

<section class="d-none" id="document_upload_add_more">
    <div class="copied_section row pt-2 ">
        <div class="col-md-4">
            <input type="text" name="title[]" value="" class="form-control" placeholder="Title" />
        </div>

        <div class="col-md-4" >
            <div class="form-group">
                <select name="type[]" class="form-control">
                    <option value="">Select One</option>
                    <?php 
                    foreach ($document_types as $obj) 
                    {
                        echo '<option style="color:'.$obj->color.'" value="'.$obj->id.'">'.$obj->name.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="col-md-2">
            <input type="file" name="doc[]" value="" class="form-control" />
        </div>
        <div class="col-md-2" >
            <a href="#" class="remove_field btn btn-danger">Remove</a>
        </div>
    </div>
</section>

