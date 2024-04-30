<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
         
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('attendance');?></li>
        </ol>
</section>

<section class="content">
            <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('attendance');?></h3>                                    
                </div><!-- /.box-header -->
                
                <div class="box-body table-responsive mt-5">
                    <form method="post">
                        <input type="hidden"  name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" name="date1" autocomplete="off" value="<?php echo (isset($_POST['date1']))?$_POST['date1']:'';?>" class="form-control datepicker" placeholder="<?php echo lang('date_from')?>">
                                </div>
                                 <div class="col-md-2">
                                    <input type="text" name="date2" autocomplete="off" value="<?php echo (isset($_POST['date2']))?$_POST['date2']:'';?>" class="form-control datepicker" placeholder="<?php echo lang('date_to')?>">
                                </div>
                                 <div class="col-md-3">
                                    <select name="employee_id" class="form-control">
                                        <option value="">-- Select Employee --</option>
                                    <?php foreach($employees as $new){?>
                                        <option value="<?php echo $new->id?>" <?php if(isset($_POST['employee_id'])) { echo ($_POST['employee_id']==$new->id)?'selected="selected"':''; 
                                                       }?>> <?php echo $new->name?> </option>
                                    <?php } ?>    
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" name="ok" value="<?php echo lang('submit')?>" class="btn btn-primary" />
                                </div>
                            </div>
                        </div>
                    </form>
            <?php if(!empty($_POST)) {?>        
            <div>
                      <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="6%"><?php echo lang('serial_number');?></th>
                                <th><?php echo lang('name');?></th>
                                <?php if(isset($dates)) {?>
                                    <?php foreach($dates as $date_new){
                                        echo '<th>'.$date_new.'</th>';    
                                    }?>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                        
                <?php $i=1;foreach($employees as $new){?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $new->name ?></td>
                    
                            </tr>
                        <?php $i++;
                }?>
                        </tbody>
                    </table>        
                </div>    
            <?php } ?>    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>