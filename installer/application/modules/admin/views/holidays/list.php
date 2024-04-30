<?php $CI = &get_instance(); ?>



  <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list');?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
            <li class="active"><?php echo lang('holidays');?></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
        <?php if(check_user_role(144)==1){?>
                    <a class="btn btn-default" href="<?php echo site_url('admin/holidays/add/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                <?php } ?>  
        </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border m-b-20">
                    <h3 class="box-title"> <?php echo lang('holidays');?> Of <?php echo  date("Y");?></h3>                                    
                </div><!-- /.box-header -->
        
          <div class="row">
                    <div class="col-md-12 m-b-20">
            <div class="col-md-3">
              <ul class="nav nav-tabs month-tabs">
             <?php $i=1; foreach($months as $new){ ?>
                            <li class="col-md-12 <?php echo (date("m")==$new->id)?'active':''?>">
                                    <a data-toggle="tab" href="#<?php echo $i;?>" aria-expanded="false">
                                    <i class="fa fa-calendar"></i> <?php echo $new->name?> </a>
                                    <span class="after"></span>
                             </li>
            <?php $i++; } ?>   
                
              </ul>
            </div>
            <div class="col-md-9">
              <div class="tab-content">
               <?php $y=1; foreach($months as $new){
                
                ?>   
               <div id="<?php echo $y;?>" class="tab-pane <?php echo (date("m")==$new->id)?'active':''?>">
                <div class="box box-black">
                                        <div class="box-header with-border">
                                          <h3 class="box-title"> <i class="fa fa-calendar"></i> <?php echo $new->name?></h3>
                            

                                        </div>
                    <?php   
                        $months_holidays = get_holidays($new->id);
                        //p($months_holidays);
                          //$months_holidays = '';        
                      //echo '<pre>';print_r($months_holidays);
                      //echo '/<pre>'
                    ?>      <div class="box-body">
                                          <div class="table-scrollable">
                                            <table class="table table-hover">
                                            <thead>
                                <tr>
                                  <th> # </th>
                                  <th> Date </th>
                                  <th> Day </th>
                                  <th> Ocation </th>
                                  <th> Action </th>
                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                              <?php if(isset($months_holidays) && $months_holidays):?>  
                                               <?php $i=1;foreach ($months_holidays as $sub_new){
                                                //if($sub_new['DayOfMonth']<=31 AND !empty($sub_new['DayOfMonth'])){
                                             ?>
                                                <tr>
                                                  <td> <?php echo $i;?> </td>
                                                  <td> <?php echo date('d-m-Y',strtotime($sub_new->date)); ?></td>
                                                  <td> 
                                                    <?php 
                                                      //$date = date("Y-".$new->id."-".$sub_new->date."");
                                                      echo date('D', strtotime($sub_new->date));
                                                    ?>
                                                  </td>
                                                  <td><?php echo $sub_new->name; ?></td> 
                                                  <td>
                                                    <?php if(check_user_role(145)==1){?>    
                                                      <?php if(isset($sub_new->id)){?>
                                                          <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/holidays/delete/'.$sub_new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> </a>
                                                      <?php } ?>  
                                                    <?php } ?>    
                                                  </td>
                                                </tr>
                                              <?php $i++; } ?>                                         
                                            </tbody>
                              <?php endif;?>
                                            </table>
                                          </div>
                                        </div>
                              </div>
                </div>
        <?php $y++;} ?>   
              </div>
            </div>
                    </div>
          </div>
          <!-- END PAGE CONTENT-->

          
          <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title"><strong>Holidays</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="portlet-body form">

                                                                        <!-- BEGIN FORM-->
                                <form method="POST" action="http://froiden.cloudapp.net/hrm_demo/admin/holidays" accept-charset="UTF-8" class="form-horizontal "><input name="_token" type="hidden" value="Hc0WfGdaSPQn4GnW7gpyKWfrPJQYh9AbuAMDo2Oo">
                                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />


                                    <div class="form-body">

                                        <div class="form-group">
                                             <div class="col-md-6">
                                                <input class="form-control form-control-inline input-medium date-picker" name="date[0]" type="text" value="" placeholder="Date">

                                             </div>
                                            <div class="col-md-6">
                                                    <input class="form-control form-control-inline" type="text" name="occasion[0]" placeholder="Occasion">
                                            </div>
                                        </div>
                                         <div id="insertBefore"></div>
                                        <button type="button" id="plusButton" class="btn btn-sm green form-control-inline">
                                                        Add More <i class="fa fa-plus"></i>
                                        </button>

                                 </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" data-loading-text="Submitting..." class="demo-loading-btn btn green"><i class="fa fa-check"></i> Submit</button>

                                        </div>
                                    </div>
                                </div>
                                    </form>
                                 <!-- END FORM-->
                             </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>
                </div>
          
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>