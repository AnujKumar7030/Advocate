<section class="content-header">
    <h1>
        <?php echo lang('case_study');?>
        <small><?php echo lang('view');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        <li><a href="<?php echo site_url('admin/case_study')?>"><?php echo lang('case_study');?></a></li>
        <li class="active"><?php echo lang('view');?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('view');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                    <div class="box-body">
                       <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" > <?php echo lang('title');?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php echo $case_study->title?>
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <div class="row">
                                <!-- <div class="col-md-3">
                                    <b><?php echo lang('case')?>  <?php echo lang('category')?></b>
                                </div> -->
                                <!-- <div class="col-md-4">
                                      <?php foreach($case_categories as $new) {
                                        $case_c = (isset($case_study->case_categories) && $case_study->case_categories) ? json_decode($case_study->case_categories) : '';
                                        
                                            $sel = "";
                                            $sel = (in_array($new->id, $case_c)) ?$new->name : '';
                                            echo $sel .",";
                                      }
                                        
                                        ?>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('notes')?> </b>
                                </div>
                                <div class="col-md-8">
                                   <?php echo $case_study->notes?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <b><?php echo lang('result')?> </b>
                                </div>
                                <div class="col-md-8">
                                   <?php echo $case_study->result?>
                                </div>
                            </div>
                        </div>
                      
                      
                           
                         
                    </div><!-- /.box-body -->
    
                   
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>