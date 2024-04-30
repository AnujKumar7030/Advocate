<section class="content-header">
    <h1><?php echo lang('general_settings')?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
      
        <li class="active"><?php echo lang('general_settings')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php 
        if(validation_errors()) 
        { ?>
            <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
            </div>
            <?php   
        } ?>  
           
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">  </div><!-- /.box-header -->
                <!-- form start -->
            
                <form method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/settings/')?>">
                    <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
                    
                    <div class="box-body">
                        


                        <div class="tabbable">
                                
                        

                            <ul class="nav nav-tabs active" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail_tab" role="tab" aria-controls="detail_tab" aria-selected="true"><?php echo lang('details');?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="hr-tab" data-toggle="tab" href="#hr_tab" role="tab" aria-controls="hr_tab" aria-selected="true"><?php echo lang('hr_settings');?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="smtp-tab" data-toggle="tab" href="#smtp_tab" role="tab" aria-controls="smtp_tab" aria-selected="true"><?php echo lang('smtp_settings');?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="general-tab" data-toggle="tab" href="#general_tab" role="tab" aria-controls="general_tab" aria-selected="true"><?php echo lang('general_settings');?></a>
                                </li>
                                    
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade  active in" id="detail_tab" role="tabpanel" aria-labelledby="detail-tab">
                                    <div class="form-group pt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('company_name')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="name" value="<?php echo @$settings->name;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('logo')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="file" name="img" value="" class="form-control">
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <?php 
                                                if($settings->image) 
                                                {  ?>
                                                    <img src="<?php echo base_url('assets/uploads/images/'.@$settings->image); ?>" width="140" height="100" />  <?php
                                                }  ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group  pt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('header_logo_height')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="header_logo_height" value="<?php echo @$settings->header_logo_height;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Favicon</b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="file" name="favicon" value="" class="form-control">
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-9">
                                                <?php 
                                                if($settings->favicon) 
                                                { ?>
                                                    <img src="<?php echo base_url('assets/uploads/images/'.@$settings->favicon); ?>" width="16" height="16" /> <?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('header_logo_image')?></b>
                                            </div>

                                            <div class="col-md-9">
                                                
                                                <input type="radio" name="header_setting" value="0" <?php echo ($settings->header_setting==0)?'checked="checked"':'';?>  /> &nbsp; &nbsp;<?php echo lang('company_name')?>
                                                <input type="radio" name="header_setting" value="1" <?php echo ($settings->header_setting==1)?'checked="checked"':'';?>/> &nbsp;&nbsp; <?php echo lang('logo')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('address')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <textarea name="address" class="form-control"><?php echo @$settings->address;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('phone')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="contact" value="<?php echo @$settings->contact;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('email')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="email" value="<?php echo @$settings->email;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="contact" ><?php echo lang('default_date_format')?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="date_format" class="form-control chzn" >
                                                    <option value=""><?php echo lang('select')?> <?php echo lang('default_date_format')?></option>
                                                    <option value="Y-m-d" <?php echo (@$settings->date_format=="Y-m-d")?'selected="selected"':'';?>>YYYY-mm-dd</option>
                                                    <option value="d/m/y" <?php echo (@$settings->date_format=="d/m/y")?'selected="selected"':'';?>>dd/mm/yy</option>
                                                    <option value="m/d/yy" <?php echo (@$settings->date_format=="m/d/y")?'selected="selected"':'';?>>mm/dd/yy</option>
                                                    <option value="m/d/y" <?php echo (@$settings->date_format=="m/d/y")?'selected="selected"':'';?>>dd/mm/YYYY</option>
                                                    <option value="m/d/Y" <?php echo (@$settings->date_format=="m/d/Y")?'selected="selected"':'';?>>mm/dd/YYYY</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $tz = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="contact" ><?php echo lang('timezone')?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="timezone" class="form-control chzn" >
                                                    <option value=""><?php echo lang('select')?> <?php echo lang('timezone')?></option>
                                                    <?php 
                                                    foreach($tz as $new){
                                                        $sel="";
                                                        if($new==@$settings->timezone) { $sel ='selected="selected"';
                                                        }
                                                        echo "<option value='".$new."' ".$sel.">".$new."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('invoice_start')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="invoice_no" value="<?php echo @$settings->invoice_no;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                                
                                <div class="tab-pane fade " id="hr_tab" role="tabpanel" aria-labelledby="hr-tab">
                                   
                                    <div class="form-group pt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('mark_out_time')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="time" name="mark_out_time" value="<?php echo @$settings->mark_out_time;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('employee_id_start_from')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="employee_id" value="<?php echo @$settings->employee_id;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <legend><?php echo lang('working_days')?></legend>

                                    <?php foreach($days as $new){?>        
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <b><?php echo $new->name?></b>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="days[<?php echo @$new->id;?>]" value="0" />
                                                        <input type="checkbox" name="days[<?php echo @$new->id;?>]" value="1" <?php echo ($new->working_day==1)?'checked="checked"':'';?> >
                                                        
                                                    </div>
                                                </div>
                                            </div>        
                                    <?php } ?>   
                                
                                </div>
                                
                                <div class="tab-pane fade" id="smtp_tab" role="tabpanel" aria-labelledby="smtp-tab">
                                            
                                    <div class="form-group pt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('smtp_host')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="smtp_host" value="<?php echo @$settings->smtp_host;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('smtp_username')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="smtp_user" value="<?php echo @$settings->smtp_user;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('smtp_password')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="smtp_pass" value="<?php echo @$settings->smtp_pass;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('smtp_port')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="smtp_port" value="<?php echo @$settings->smtp_port;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>        
                    
                                </div>    
                                        
                                <div class="tab-pane fade" id="general_tab" role="tabpanel" aria-labelledby="general-tab">
                                            
                                    <div class="form-group  pt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_update_token')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_update_token" value="<?php echo @$settings->site_update_token;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
       

                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_first_slide')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="file" name="home_first_slide" value="" class="form-control">
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-9">
                                                <?php 
                                                if($settings->home_first_slide)
                                                { ?>
                                                    <img src="<?php echo base_url('assets/uploads/images/'.@$settings->home_first_slide); ?>" width="140" height="100" /> <?php
                                                }  ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_first_slide_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_first_slide_text" value="<?php echo @$settings->home_first_slide_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_first_slide_button_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_first_slide_button_text" value="<?php echo @$settings->home_first_slide_button_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_first_slide_button_link')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_first_slide_button_link" value="<?php echo @$settings->home_first_slide_button_link;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group  ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_slide_second')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="file" name="home_slide_second" value="" class="form-control">
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <?php 
                                                if($settings->home_slide_second)
                                                { ?>
                                                    <img src="<?php echo base_url('assets/uploads/images/'.@$settings->home_slide_second); ?>" width="140" height="100" /> <?php
                                                }  ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_second_slide_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_second_slide_text" value="<?php echo @$settings->home_second_slide_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_second_slide_button_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_second_slide_button_text" value="<?php echo @$settings->home_second_slide_button_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_second_slide_button_link')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_second_slide_button_link" value="<?php echo @$settings->home_second_slide_button_link;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_third_slide')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="file" name="home_third_slide" value="" class="form-control">
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-9">
                                                <?php 
                                                if($settings->home_third_slide)
                                                { ?>
                                                    <img src="<?php echo base_url('assets/uploads/images/'.@$settings->home_third_slide); ?>" width="140" height="100" /> <?php
                                                }  ?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_third_slide_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_third_slide_text" value="<?php echo @$settings->home_third_slide_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_third_slide_button_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_third_slide_button_text" value="<?php echo @$settings->home_third_slide_button_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('home_third_slide_button_link')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="home_third_slide_button_link" value="<?php echo @$settings->home_third_slide_button_link;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('footer_text_heading')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="footer_text_heading" value="<?php echo @$settings->footer_text_heading;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_footer_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="site_footer_text" class="form-control editor redactor"><?php echo @$settings->site_footer_text;?></textarea>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_facebook_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_facebook_url" value="<?php echo @$settings->site_facebook_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_twitter_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_twitter_url" value="<?php echo @$settings->site_twitter_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_google_plus_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_google_plus_url" value="<?php echo @$settings->site_google_plus_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_linkedin_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_linkedin_url" value="<?php echo @$settings->site_linkedin_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_pininterest_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_pininterest_url" value="<?php echo @$settings->site_pininterest_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('site_instagram_url')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="site_instagram_url" value="<?php echo @$settings->site_instagram_url;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
       
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('disable_right_click')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="disable_right_click" id="disable_right_click">
                                                    <option <?php echo $settings->disable_right_click == "NO" ? "selected" : ""; ?> value="NO">NO</option>
                                                    <option <?php echo $settings->disable_right_click == "YES" ? "selected" : ""; ?> value="YES">YES</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('disable_print_screen')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="disable_print_screen" id="disable_print_screen">
                                                    <option <?php echo $settings->disable_print_screen == "NO" ? "selected" : ""; ?> value="NO">NO</option>
                                                    <option <?php echo $settings->disable_print_screen == "YES" ? "selected" : ""; ?> value="YES">YES</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
       
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('disable_copy_paste_click')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="disable_copy_paste_click" id="disable_copy_paste_click">
                                                    <option <?php echo $settings->disable_copy_paste_click == "NO" ? "selected" : ""; ?> value="NO">NO</option>
                                                    <option <?php echo $settings->disable_copy_paste_click == "YES" ? "selected" : ""; ?> value="YES">YES</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
       



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('custom_css')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="custom_css" class="form-control "><?php echo @$settings->custom_css;?></textarea>
                                            </div>
                                        </div>
                                    </div>


   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('header_javascript')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="header_javascript" class="form-control r"><?php echo @$settings->header_javascript;?></textarea>
                                            </div>
                                        </div>
                                    </div>


   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('footer_javascript')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="footer_javascript" class="form-control "><?php echo @$settings->footer_javascript;?></textarea>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('cookies_content_display')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="cookies_content_display" id="cookies_content_display">
                                                    <option <?php echo $settings->cookies_content_display == "NO" ? "selected" : ""; ?> value="NO">NO</option>
                                                    <option <?php echo $settings->cookies_content_display == "YES" ? "selected" : ""; ?> value="YES">YES</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('cookies_content')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="cookies_content" value="<?php echo @$settings->cookies_content;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('cookies_content_btn_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="cookies_content_btn_text" value="<?php echo @$settings->cookies_content_btn_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('footer_last_row_left_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="footer_last_row_left_text" value="<?php echo @$settings->footer_last_row_left_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('footer_last_row_right_text')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                
                                                <input type="text" name="footer_last_row_right_text" value="<?php echo @$settings->footer_last_row_right_text;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b><?php echo lang('display_content_on_home_page')?></b>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="display_content_on_home_page" class="form-control editor redactor"><?php echo @$settings->display_content_on_home_page;?></textarea>
                                            </div>
                                        </div>
                                    </div>


       
                    
                                </div>    
                                        
                            </div>
                        
                        </div>

                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
                        <button  type="submit" class="btn btn-primary"><?php echo lang('save')?></button>
                    </div>
                </form>

            </div><!-- /.box -->
        </div>
     </div>
</section>  