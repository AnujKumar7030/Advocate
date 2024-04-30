<?php
$CI = get_instance();
$CI->load->model('setting_model');
$CI->load->model('notification_model');
$CI->load->model('message_model');
$CI->load->model('employees_model');
$CI->load->model('language_model');
$CI->load->model('tasks_model');
$CI->load->model('attendance_model');

$admin = $this->session->userdata('admin');
if($this->session->userdata('direction')) {
    $direction = $this->session->userdata('direction');    
}

$access = $admin['user_role'];

$admin_users   = $CI->employees_model->get_user_by_role();

$case_alert   = $CI->setting_model->get_case_alert();
$case_alert_client   = $CI->setting_model->get_case_alert_client();
$setting   = $CI->setting_model->get_setting();
$client_setting   = $CI->setting_model->get_notification_setting_client();
$notification  = $CI->notification_model->get_setting();
$to_do_alert   = $CI->setting_model->get_to_do_alert();
$appointment_alert   = $CI->setting_model->get_appointment_alert();
$admin_messages = $this->message_model->get_message_count_by_id();
$langs = $this->language_model->get_all();
$due_tasks = $this->tasks_model->get_due_tasks();
$my_due_tasks = $this->tasks_model->get_my_due_tasks();

$leave_notification = $this->attendance_model->get_leave_notification();

$first = $this->uri->segment(1);
$second = $this->uri->segment(2);
$third = $this->uri->segment(3);
$fourth = $this->uri->segment(4);


//Navigation Conditions

$user_management = array("clients","employees","user_role","departments","permissions","holidays","notice","leave_types","attendance");
$masters = array("category","location","tax","case_category","court_category","act","court","case_stage","pages","testimonial","sponsors","payment_mode");


    $active_actions = array();
    $CI->db->order_by('A.name', 'asc');
    $CI->db->select('A.name action');
    $CI->db->join('actions A', 'A.id = RRA.action_id', 'LEFT');
    $CI->db->where('RRA.role_id', $this->session->userdata('admin')['user_role']);
    $actions = $CI->db->get('rel_role_action RRA')->result();
foreach($actions as $action) {
    $active_actions[] = $action->action;
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="<?php echo base_url('assets/img');?>/favicon.jpg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title><?php echo $setting->name;?></title>
  <?php 
    $path = base_url('assets/uploads/images/'.$setting->favicon);
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    //echo $path;die;
    $favicon = file_exists($path) ? $path : base_url('assets/uploads/images/favicon.jpg');
  ?>
    <link rel="shortcut icon" type="image/<?php echo $ext?>" href="<?php echo $favicon?>"/>
  <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/spacing_bs4.css')?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/plugins/font-awesome/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url('assets/css/ionicons.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
  <link href="<?php echo base_url('assets/plugins/morris/morris.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/pickmeup.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Custom Theme Style -->
    <?php if($this->session->userdata('direction') && $direction == 'rtl') { ?>
        <link href="<?php echo base_url('assets/css/AdminLTE-rtl.css')?>" rel="stylesheet"> 
        <link href="<?php echo base_url('assets/css/skins/_all-skins-rtl.min.css')?>" rel="stylesheet" type="text/css" />
    <?php } else { ?>
        <link href="<?php echo base_url('assets/css/AdminLTE.css')?>" rel="stylesheet"> 
        <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
    <?php } ?>
        
    <link href="<?php echo base_url('assets/css/redactor.css')?>" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet" type="text/css" />
    <?php // CSS files ?>
         <?php if (isset($css_files) && is_array($css_files)) : ?>
         <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
               <?php $separator = (strstr($css, '?')) ? '&' : '?'; ?>
               <link rel="stylesheet" href="<?php echo xss_clean($css); ?>">
               <?php echo "\n"; ?>
            <?php endif; ?>
         <?php endforeach; ?>
      <?php endif; ?>
    <!-- jQuery 2.0.2 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
    <script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js')?>" type="text/javascript"></script>


     <script type="text/javascript">
         var csrf_Name = '<?php echo $this->csrf_tokens['name']; ?>';
          var csrf_Hash = '<?php echo $this->csrf_tokens['hash']; ?>';
          var BASE_URL = '<?php echo base_url(); ?>';
          var ajax_loader_gif = '<?php echo base_url('assets/img/ajax-loader.gif')?>';
          var ajax_load = '<img class="ml-100"  src="'+ajax_loader_gif+'"/>';
          var admin_folder_wysiwyg = "<?php echo base_url().config_item('admin_folder').'wysiwyg/';?>";

            $.ajaxSetup({
              data: {
                [csrf_Name]: csrf_Hash,
              },
            });

         $(document).ready(function () 
          {
           
        });
   </script>
    
  </head>
  <body class="hold-transition skin-black sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <a href="<?php echo site_url('admin/dashboard');?>" class="logo">
        <?php  if($setting->header_setting==0){ ?>
            <span class="logo-mini"><?php echo @$setting->name; ?></span>
            <span class="logo-lg"><?php echo @$setting->name; ?></span>
        <?php }else{ 
          $logo = $setting->image ? base_url('assets/uploads/images/'.$setting->image) : base_url('assets/uploads/images/Screenshot_2021-08-03_at_3.36_.17_PM_.png');
          
        ?>
            <span class="logo-lg"><img src="<?php echo $logo; ?>" width="150" height="50" /></span>
        <?php }?>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo lang('toggle_navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-language"></i>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu header-lang" id="menu1">
                      
                      <!-- <li class="<?php echo('english' == $this->session->userdata('lang'))?'active':'';?>">
                        <a href="<?php echo site_url('admin/languages/switch_language/'); ?>/english/<?php echo $first.'/'.$second.'/'.$third.'/'.$fourth?>">
                          <div class="pull-left">
                            <img src="<?php echo base_url('assets/img/eng.png')?>"class="img-circle img-responsive" />    
                          </div>
                          <h4><?php echo lang('english');?></h4>
                        </a>
                      </li> -->
                      <?php foreach ($langs as $new){ ?> 
                      <li class="<?php echo($new->name == $this->session->userdata('lang'))?'active':'';?>">
                        <a href="<?php echo site_url('admin/languages/switch_language/'.$new->id.'/'.$first.'/'.$second.'/'.$third.'/'.$fourth); ?>">
                          <div class="pull-left">
                            <img src="<?php echo base_url('assets/uploads/images/'.$new->flag)?>"class="img-circle img-responsive" />    
                          </div>
                          <h4><?php echo ucwords($new->name)?></h4>
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
              </li>
              
              
              <?php if($access==2){ ?>
              
              
              <!--- Case Alert Client-->  
              <?php if(check_user_role(105)==1){?>
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-th"></i>
                  <?php if(!empty($case_alert_client)) { ?>
                    <span class="label label-warning"><?php echo count($case_alert_client); ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="header"><?php echo count($case_alert_client) ?> <?php echo lang('case_comming_in_next'); ?>  <?php echo $client_setting->client_case_alert;?> <?php echo lang('days'); ?>.</li>
                  <li>
                      <ul class="menu">
                          <?php foreach ($case_alert_client as $new){ ?>                  
                          <li>
                            <a href="<?php echo site_url('admin/my_cases/details/'.$new->id);?>">
                              <i class="fa fa-legal"></i> <?php echo 'Case NO - '.$new->case_no.' ON '; ?><?php echo date_convert($new->next_date); ?>
                            </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  
                  <li class="footer">
                      <a href="<?php echo site_url('admin/my_cases');?>">
                        <strong><?php echo lang('view_all');?></strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
                </ul>
              </li>
    
              
              <?php } ?>
              
              <?php } else { ?>
              
              
              <!--- Case Alert -->  
              <?php if(check_user_role(105)==1){?>
              
              
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-th"></i>
                  <?php if(!empty($case_alert)) { ?>
                    <span class="label label-warning"><?php echo count($case_alert); ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="header"><?php echo count($case_alert) ?> <?php echo lang('case_comming_in_next'); ?>  <?php echo $notification->case_alert;?> <?php echo lang('days'); ?>.</li>
                  <li>
                      <ul class="menu">
                          <?php foreach ($case_alert as $new){ ?>                  
                          <li>
                            <a href="<?php echo site_url('admin/cases/view_case/'.$new->id);?>">
                              <i class="fa fa-legal"></i> <?php echo 'Case NO - '.$new->case_no.' ON '; ?><?php echo date_convert($new->next_date); ?>
                            </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  
                  <li class="footer">
                      <a href="<?php echo site_url('admin/cases/view_all');?>">
                        <strong><?php echo lang('view_all');?></strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
                </ul>
              </li>
              
              <?php } ?>
              
              <!--- Leave Notification Alert -->  
              <?php if(check_user_role(106)==1){?>
              
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-outdent"></i>
                  <?php if(!empty($leave_notification)) { ?>
                    <span class="label label-warning"><?php echo count($leave_notification); ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="header"><?php echo count(@$leave_notification) ?> <?php echo lang('leave_request_pending'); ?>.</li>
                  <li>
                      <ul class="menu">
                          <?php foreach ($leave_notification as $new){ ?>                  
                          <li>
                            <a href="#">
                              <?php echo '<i class="fa fa-user"></i>  '.$new->user; ?> <?php echo date_convert($new->date); ?>
                            </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  
                  <li class="footer">
                      <a href="<?php echo site_url('admin/attendance/leave_notification');?>">
                        <strong><?php echo lang('view_all');?></strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
                </ul>
              </li>
              
              <?php } ?>
              
              <!--- Appointment Alert -->  
              <?php if(check_user_role(106)==1) { ?>
              
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-calendar"></i>
                  <?php if(!empty($appointment_alert)) { ?>
                    <span class="label label-warning"><?php echo count($appointment_alert); ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="header"><?php echo count(@$appointment_alert) ?> <?php echo lang('appointment_comming_in_next'); ?> <?php echo @$notification->appointment_alert;?> <?php echo lang('days')?>.</li>
                  <li>
                      <ul class="menu">
                          <?php foreach ($appointment_alert as $new){ ?>                  
                          <li>
                            <a href="<?php echo site_url('admin/appointments/view_appointment/'.$new->id);?>">
                              <?php echo '<i class="fa fa-chevron-circle-right"></i> '.$new->title.' at '; ?> <?php echo date_time_convert($new->date_time); ?>
                            </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  
                  <li class="footer">
                      <a href="<?php echo site_url('admin/appointments/view_all');?>">
                        <strong><?php echo lang('view_all');?></strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
                </ul>
              </li>
              
              <?php } ?>
              
              <!--- To Do Alert -->  
              <?php if(check_user_role(107)==1){?>
              
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-tasks"></i>
                  <?php if(!empty($to_do_alert)) { ?>
                    <span class="label label-warning"><?php echo count($to_do_alert); ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="header"><?php echo lang('you_have_today');?> <?php echo count($to_do_alert)?>  <?php echo lang('to_do'); ?>.</li>
                  <li>
                      <ul class="menu">
                          <?php foreach ($to_do_alert as $new){ ?>                  
                          <li>
                            <a href="<?php echo site_url('admin/to_do_list/view_to_do/'.$new->id);?>">
                              <?php echo '<i class="fa fa-chevron-circle-right"></i> '.$new->title.' at '; ?> <?php echo date_convert($new->date); ?>
                            </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  
                  <li class="footer">
                      <a href="<?php echo site_url('admin/to_do_list/view_all');?>">
                        <strong><?php echo lang('view_all');?></strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
                </ul>
              </li>

              <?php }} ?>
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php 
                    $user_image = file_exists(base_url('assets/uploads/images/'.$admin['image'])) ? base_url('assets/uploads/images/'.$admin['image']) : base_url('assets/uploads/images/Screenshot_2021-08-03_at_3.36_.17_PM_.png');
                  ?>
                        <img src="<?php echo $user_image;?>"class="user-image" />   
                    
                  <span class="hidden-xs"><?php echo $admin['name'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php 
                      $user_image = file_exists(base_url('assets/uploads/images/'.$admin['image'])) ? base_url('assets/uploads/images/'.$admin['image']) : base_url('assets/uploads/images/Screenshot_2021-08-03_at_3.36_.17_PM_.png');
                    ?>
                        <img src="<?php echo $user_image; ?>"class="img-circle" />    
                    
                    <p>
                      <?php echo $admin['name'] ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('admin/account'); ?>" class="btn btn-default btn-flat"><?php echo lang('profile');?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('admin/login/logout'); ?>" class="btn btn-default btn-flat"><?php echo lang('sign') ." ". lang('out');?></a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->
    
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php  
                $user_image = file_exists(base_url('assets/uploads/images/'.$admin['image'])) ? base_url('assets/uploads/images/'.$admin['image']) : base_url('assets/uploads/images/Screenshot_2021-08-03_at_3.36_.17_PM_.png');
              ?>
                <img src="<?php echo $user_image;?>"class="img-circle img-responsive" />    
                  
            </div>
            <div class="pull-left info">
              <p><?php echo $admin['name'] ? $admin['name'] : 'Advocate'; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('online');?></a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo lang('navigation');?></li>
            
            <li class="<?php echo($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/dashboard');?>">
                <i class="fa fa-dashboard"></i> <span><?php echo lang('dashboard');?></span>
              </a>
            </li>
            <?php $user_slug = get_logged_in_user_role_slug($this->session->userdata['admin']['user_role']);
                    if($user_slug['slug'] == 'client')
                { ?>
                  <li class="<?php echo($this->uri->segment(2)=='appointments' || $this->uri->segment(2)=='')?'active':'';?>">
                    <a href="<?php echo site_url('admin/appointments');?>">
                      <span class="pr-3"><i class="fa fa-thumb-tack"></i></span>
                      <span class="nav-link-text"><?php echo lang('appointments');?></span>
                      <small class="badge badge-primary badge-pill"><?php echo count($appointment_alert) ?></small>
                    </a>
                  </li>
            <?php } ?>  

            <?php if($access == 1) 
                { ?>
                  <li class="treeview <?php echo(in_array($this->uri->segment(2),$user_management)  || ($this->uri->segment(2) == 'attendance' && $this->uri->segment(3) == 'leave_notification' ))?'active':'';?>">
              <a href="#">
                <i class="fa fa-users"></i> <span><?php echo lang('user_management');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo($this->uri->segment(2)=='clients')?'active':'';?>">
                    <a href="<?php echo site_url('admin/clients');?>"><i class="fa fa-circle-o"></i> <?php echo lang('clients');?></a>
                </li>
                <!-- <li class="<?php echo($this->uri->segment(2)=='vendors')?'active':'';?>">
                    <a href="<?php echo site_url('admin/vendors');?>"><i class="fa fa-circle-o"></i> <?php echo lang('vendors');?></a>
                </li> -->
                <li class="<?php echo($this->uri->segment(2)=='employees')?'active':'';?>">
                    <a href="<?php echo site_url('admin/employees');?>"><i class="fa fa-circle-o"></i> <?php echo lang('employees');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='user_role')?'active':'';?>">
                    <a href="<?php echo site_url('admin/user_role');?>"><i class="fa fa-circle-o"></i> <?php echo lang('user_roles');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='departments')?'active':'';?>">
                    <a href="<?php echo site_url('admin/departments');?>"><i class="fa fa-circle-o"></i> <?php echo lang('departments');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='permissions')?'active':'';?>">
                    <a href="<?php echo site_url('admin/permissions');?>"><i class="fa fa-circle-o"></i> <?php echo lang('permissions');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='holidays')?'active':'';?>">
                    <a href="<?php echo site_url('admin/holidays');?>"><i class="fa fa-circle-o"></i> <?php echo lang('holidays');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='notice')?'active':'';?>">
                    <a href="<?php echo site_url('admin/notice');?>"><i class="fa fa-circle-o"></i> <?php echo lang('notice');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='leave_types')?'active':'';?>">
                    <a href="<?php echo site_url('admin/leave_types');?>"><i class="fa fa-circle-o"></i> <?php echo lang('leave_types');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='attendance' && $this->uri->segment(3)!='leave_notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/attendance');?>"><i class="fa fa-circle-o"></i> <?php echo lang('attendance');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(3)=='leave_notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/attendance/leave_notification');?>"><i class="fa fa-circle-o"></i> <?php echo lang('leave_notification');?></a>
                </li>
              </ul>
            </li>

            <li class="treeview <?php echo(($this->uri->segment(2)=='cases' && $this->uri->segment(3) !='starred_cases' && $this->uri->segment(3) != 'archived_cases') || $this->uri->segment(3)=='starred_cases'  || $this->uri->segment(3)=='archived_cases' || $this->uri->segment(2)=='documents' )?'active':'' ;?>">
              <a href="#">
                <i class="fa fa-th"></i> <span><?php echo lang('cases');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo($this->uri->segment(2)=='cases' && $this->uri->segment(3) !='starred_cases' && $this->uri->segment(3) != 'archived_cases')?'active':'' ;?>">
                    <a href="<?php echo site_url('admin/cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('all');?> <?php echo lang('cases');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(3)=='starred_cases')?'active':'';?>">
                    <a href="<?php echo site_url('admin/cases/starred_cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('starred_cases');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(3)=='archived_cases')?'active':'';?>">
                    <a href="<?php echo site_url('admin/cases/archived_cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('archived_cases');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='documents')?'active':'';?>">
                    <a href="<?php echo site_url('admin/documents');?>"><i class="fa fa-circle-o"></i> <?php echo lang('documents');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='documents' && $this->uri->segment(3)=='types')?'active':'';?>">
                    <a href="<?php echo site_url('admin/documents/types');?>"><i class="fa fa-circle-o"></i> <?php echo lang('document Types');?></a>
                </li>
              </ul>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='case_study' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/case_study');?>">
                <i class="fa fa-book"></i> <span><?php echo lang('case_study');?></span>
              </a>
            </li>

            <li class="treeview <?php echo($this->uri->segment(2)=='tasks' || $this->uri->segment(3)=='my_tasks' )?'active':'';?>">
              <a href="#">
                <i class="fa fa-tasks"></i> <span><?php echo lang('tasks');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo($this->uri->segment(2)=='tasks' && $this->uri->segment(3)!='my_tasks')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tasks');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('tasks');?></span>
                        <span class="pull-right-container">
                          <span class="label label-primary pull-right"><?php echo count($due_tasks) ?></span>
                        </span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(3)=='my_tasks')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tasks/my_tasks');?>"><i class="fa fa-circle-o"></i>
                        <span><?php echo lang('my_tasks');?></span>
                        <span class="pull-right-container">
                          <span class="label label-primary pull-right"><?php echo count($my_due_tasks) ?></span>
                        </span>
                    </a>
                </li>
              </ul>
            </li>

            <li class="treeview <?php echo($this->uri->segment(2)=='banking' || $this->uri->segment(3)=='transfer' )?'active':'';?>">
              <a href="#">
                <i class="fa fa-university"></i> <span><?php echo lang('banking');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo($this->uri->segment(2)=='banking' && $this->uri->segment(3)!='transfer')?'active':'';?>">
                    <a href="<?php echo site_url('admin/banking');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('account');?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(3)=='transfer') ?'active':'';?>">
                    <a href="<?php echo site_url('admin/banking/transfer');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('transfer');?></span>
                    </a>
                </li>
              </ul>
            </li>
            <li class="<?php echo($this->uri->segment(2)=='product_service' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/product_service');?>">
                <i class="fa fa-shopping-cart"></i> <span><?php echo lang('product_service');?></span>
              </a>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='new_invoice' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/new_invoice');?>">
                <i class="fa fa-money"></i> <span><?php echo lang('invoice');?></span>
              </a>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='expense' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/expense');?>">
                <i class="fa fa-building"></i> <span><?php echo lang('expenses'); ?></span>
              </a>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='reports' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/reports');?>">
                <i class="fa fa-line-chart"></i> <span><?php echo lang('reports');?></span>
              </a>
            </li>
            
            <li class="<?php echo($this->uri->segment(2)=='message' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/message');?>">
                <i class="fa fa-envelope"></i> <span><?php echo lang('message');?></span>
                <small class="badge pull-right bg-red"><?php echo count($admin_messages) ?></small>
              </a>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='contact-enquiry' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/contact-enquiry');?>">
                <i class="fa fa-envelope"></i><span><?php echo lang('contact enquiry');?></span>
              </a>
            </li>

            <li class="<?php echo($this->uri->segment(2)=='to_do_list' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/to_do_list');?>">
                <i class="fa fa-bars"></i> <span><?php echo lang('to_do_list');?></span>
                <small class="badge pull-right bg-red"><?php echo count($to_do_alert) ?></small>
              </a>
            </li>
            
            <li class="<?php echo($this->uri->segment(2)=='contacts' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/contacts');?>">
                <i class="fa fa-newspaper-o"></i> <span><?php echo lang('contacts');?></span>
              </a>
            </li>
            
            <li class="<?php echo($this->uri->segment(2)=='custom_fields' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/custom_fields');?>">
                <i class="fa fa-columns"></i> <span><?php echo lang('custom_fields');?></span>
              </a>
            </li>
            
            <li class="<?php echo($this->uri->segment(2)=='appointments' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/appointments');?>">
                <i class="fa fa-thumb-tack"></i> <span><?php echo lang('appointments');?></span>
                <small class="badge pull-right bg-red"><?php echo count($appointment_alert) ?></small>
              </a>
            </li>

            <li class="treeview <?php echo(in_array($this->uri->segment(2), $masters)) ? 'active' : '';?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span><?php echo lang('masters');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                <li class="<?php echo($this->uri->segment(2)=='category')?'active':'';?>">
                    <a href="<?php echo site_url('admin/category');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('category')?></span>
                    </a>
                </li>
                
                <li class="<?php echo($this->uri->segment(2)=='location')?'active':'';?>">
                    <a href="<?php echo site_url('admin/location');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('locations')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='tax')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tax');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('tax')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='case_category')?'active':'';?>">
                    <a href="<?php echo site_url('admin/case_category');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('case_category')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='court_category')?'active':'';?>">
                    <a href="<?php echo site_url('admin/court_category');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('court')?> <?php echo lang('category')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='act')?'active':'';?>">
                    <a href="<?php echo site_url('admin/act');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('act')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='court')?'active':'';?>">
                    <a href="<?php echo site_url('admin/court');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('court')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='case_stage')?'active':'';?>">
                    <a href="<?php echo site_url('admin/case_stage');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('case')?> <?php echo lang('stages')?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='pages')?'active':'';?>">
                  <a href="<?php echo site_url('admin/pages');?>"><i class="fa fa-circle-o"></i><?php echo lang('pages');?></a>
                </li>

                <li class="<?php echo($this->uri->segment(2)=='testimonial')?'active':'';?>">
                    <a href="<?php echo site_url('admin/testimonial');?>"><i class="fa fa-circle-o"></i><?php echo lang('Testimonial');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='sponsors')?'active':'';?>">
                    <a href="<?php echo site_url('admin/sponsors');?>"><i class="fa fa-circle-o"></i><?php echo lang('sponsors');?></a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='payment_mode')?'active':'';?>">
                    <a href="<?php echo site_url('admin/payment_mode');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('payment_mode')?></span>
                    </a>
                </li>
              </ul>
            </li>
            
            <li class="treeview <?php echo($this->uri->segment(2)=='settings' || $this->uri->segment(2)=='notification' || $this->uri->segment(2)=='languages')?'active':'';?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span><?php echo lang('administrative');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li class="<?php echo($this->uri->segment(2)=='settings')?'active':'';?>">
                    <a href="<?php echo site_url('admin/settings');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('general');?> <?php echo lang('settings');?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/notification');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('notification');?> <?php echo lang('settings');?></span>
                    </a>
                </li>
                <li class="<?php echo($this->uri->segment(2)=='languages')?'active':'';?>">
                    <a href="<?php echo site_url('admin/languages');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('languages')?></span>
                    </a>
                </li>
                <li class="nav-item <?php echo($this->uri->segment(2)=='updates')?'active':'';?>">
                    <a href="<?php echo site_url('admin/updates');?>"><i class="fa fa-circle-o"></i><?php echo lang('updates');?></a>
                </li>
              </ul>
              
            </li>

            <?php  }?>   
            <?php if($access==2){ ?>
            
            <li class="<?php echo($this->uri->segment(2)=='my_cases' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/my_cases');?>">
                <i class="fa fa-th"></i> <span><?php echo lang('my_cases');?></span>
              </a>
            </li>
            
            <li class="<?php echo($this->uri->segment(3)=='send_message' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/message/send_message/'.$admin_users[0]->id);?>">
                <i class="fa fa-envelope"></i> <span><?php echo lang('message');?></span>
                <small class="badge pull-right bg-red"><?php echo count($admin_messages) ?></small>
              </a>
            </li>

            
            <?php } ?>  

            <?php 
            if($active_actions){ 
            if(in_array('clients',$active_actions) || in_array('employees',$active_actions) || in_array('user_role',$active_actions) || in_array('departments',$active_actions) || in_array('permissions',$active_actions) || in_array('holidays',$active_actions) || in_array('notice',$active_actions) || in_array('leave_types',$active_actions) || in_array('attendance',$active_actions) || check_user_role(130)== 1 ){ ?>
            
            
            <li class="treeview <?php echo(in_array($this->uri->segment(2),$user_management)  || ($this->uri->segment(2) == 'attendance' && $this->uri->segment(3) == 'leave_notification' ))?'active':'';?>">
              <a href="#">
                <i class="fa fa-users"></i> <span><?php echo lang('user_management');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('clients',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='clients')?'active':'';?>">
                    <a href="<?php echo site_url('admin/clients');?>"><i class="fa fa-circle-o"></i> <?php echo lang('clients');?></a>
                </li>
                <?php }?>
                <?php if(in_array('employees',$active_actions)){?>  
                <li class="<?php echo($this->uri->segment(2)=='employees')?'active':'';?>">
                    <a href="<?php echo site_url('admin/employees');?>"><i class="fa fa-circle-o"></i> <?php echo lang('employees');?></a>
                </li>
                <?php }?>
                 <?php if(in_array('user_role',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='user_role')?'active':'';?>">
                    <a href="<?php echo site_url('admin/user_role');?>"><i class="fa fa-circle-o"></i> <?php echo lang('user_roles');?></a>
                </li>
                <?php }?>
                <?php if(in_array('departments',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='departments')?'active':'';?>">
                    <a href="<?php echo site_url('admin/departments');?>"><i class="fa fa-circle-o"></i> <?php echo lang('departments');?></a>
                </li>
                <?php }?>
                <?php if(in_array('permissions',$active_actions)){?>  
                <li class="<?php echo($this->uri->segment(2)=='permissions')?'active':'';?>">
                    <a href="<?php echo site_url('admin/permissions');?>"><i class="fa fa-circle-o"></i> <?php echo lang('permissions');?></a>
                </li>
                <?php }?>
                <?php if(in_array('holidays',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='holidays')?'active':'';?>">
                    <a href="<?php echo site_url('admin/holidays');?>"><i class="fa fa-circle-o"></i> <?php echo lang('holidays');?></a>
                </li>
                <?php }?>
                <?php if(in_array('notice',$active_actions)){?> 
                <li class="<?php echo($this->uri->segment(2)=='notice')?'active':'';?>">
                    <a href="<?php echo site_url('admin/notice');?>"><i class="fa fa-circle-o"></i> <?php echo lang('notice');?></a>
                </li>
                <?php }?>
                <?php if(in_array('leave_types',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='leave_types')?'active':'';?>">
                    <a href="<?php echo site_url('admin/leave_types');?>"><i class="fa fa-circle-o"></i> <?php echo lang('leave_types');?></a>
                </li>
                <?php }?>
                <?php if(in_array('attendance',$active_actions)){?>   
                <li class="<?php echo($this->uri->segment(2)=='attendance' && $this->uri->segment(3)!='leave_notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/attendance');?>"><i class="fa fa-circle-o"></i> <?php echo lang('attendance');?></a>
                </li>
                <?php }?>
                <?php if(check_user_role(130)==1){?>
                <li class="<?php echo($this->uri->segment(3)=='leave_notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/attendance/leave_notification');?>"><i class="fa fa-circle-o"></i> <?php echo lang('leave_notification');?></a>
                </li>
                <?php }?>
              </ul>
            </li>
            <?php } ?> 

            <?php 
            if(in_array('cases',$active_actions) || in_array('starred_cases',$active_actions) || in_array('archived_cases',$active_actions) || in_array('documents',$active_actions)){ ?>
            <li class="treeview <?php echo(($this->uri->segment(2)=='cases' && $this->uri->segment(3) !='starred_cases' && $this->uri->segment(3) != 'archived_cases') || $this->uri->segment(3)=='starred_cases'  || $this->uri->segment(3)=='archived_cases' || $this->uri->segment(2)=='documents' )?'active':'' ;?>">
              <a href="#">
                <i class="fa fa-th"></i> <span><?php echo lang('cases');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('cases',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='cases' && $this->uri->segment(3) !='starred_cases' && $this->uri->segment(3) != 'archived_cases')?'active':'' ;?>">
                    <a href="<?php echo site_url('admin/cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('all');?> <?php echo lang('cases');?></a>
                </li>
                <?php }?>
                <?php if(in_array('starred_cases',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(3)=='starred_cases')?'active':'';?>">
                    <a href="<?php echo site_url('admin/cases/starred_cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('starred_cases');?></a>
                </li>
                <?php }?>
                <?php if(in_array('archived_cases',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(3)=='archived_cases')?'active':'';?>">
                    <a href="<?php echo site_url('admin/cases/archived_cases');?>"><i class="fa fa-circle-o"></i> <?php echo lang('archived_cases');?></a>
                </li>
                <?php }?>
                <?php if(in_array('documents',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='documents')?'active':'';?>">
                    <a href="<?php echo site_url('admin/documents');?>"><i class="fa fa-circle-o"></i> <?php echo lang('documents');?></a>
                </li>
                <?php }?>
              </ul>
            </li>
            <?php } ?> 

            <?php if(in_array('case_study',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='case_study' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/case_study');?>">
                <i class="fa fa-book"></i> <span><?php echo lang('case_study');?></span>
              </a>
            </li>
            <?php }?>

            <?php if(in_array('tasks',$active_actions) || check_user_role(152)==1 ){?>
            <li class="treeview <?php echo($this->uri->segment(2)=='tasks' || $this->uri->segment(3)=='my_tasks' )?'active':'';?>">
              <a href="#">
                <i class="fa fa-tasks"></i> <span><?php echo lang('tasks');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('tasks',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='tasks'  && $this->uri->segment(3)!='my_tasks')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tasks');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('tasks');?></span>
                        <span class="pull-right-container">
                          <span class="label label-primary pull-right"><?php echo count($due_tasks) ?></span>
                        </span>
                    </a>
                </li>
                <?php }?>
                <?php if(check_user_role(152)==1){?>
                <li class="<?php echo($this->uri->segment(3)=='my_tasks')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tasks/my_tasks');?>"><i class="fa fa-circle-o"></i>
                        <span><?php echo lang('my_tasks');?></span>
                        <span class="pull-right-container">
                          <span class="label label-primary pull-right"><?php echo count($my_due_tasks) ?></span>
                        </span>
                    </a>
                </li>
                <?php }?>
              </ul>
            </li>
            <?php  } ?>

            <?php if(in_array('reports',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='reports' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/reports');?>">
                <i class="fa fa-line-chart"></i> <span><?php echo lang('reports');?></span>
              </a>
            </li>
            <?php }?>
      
            <?php if(in_array('message',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='message' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/message');?>">
                <i class="fa fa-envelope"></i> <span><?php echo lang('message');?></span>
                <small class="badge pull-right bg-red"><?php echo count($admin_messages) ?></small>
              </a>
            </li>
            <?php }?>
            
            <?php if(in_array('to_do_list',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='to_do_list' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/to_do_list');?>">
                <i class="fa fa-bars"></i> <span><?php echo lang('to_do_list');?></span>
                <small class="badge pull-right bg-red"><?php echo count($to_do_alert) ?></small>
              </a>
            </li>
            <?php }?>
            
            <?php if(in_array('contacts',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='contacts' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/contacts');?>">
                <i class="fa fa-newspaper-o"></i> <span><?php echo lang('contacts');?></span>
              </a>
            </li>
            <?php }?>
            
            <?php if(in_array('custom_fields',$active_actions)){?>
            <li class="<?php echo($this->uri->segment(2)=='custom_fields' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/custom_fields');?>">
                <i class="fa fa-columns"></i> <span><?php echo lang('custom_fields');?></span>
              </a>
            </li>
            <?php }?>
      
            <?php if(in_array('appointments',$active_actions)){?>
              <li class="<?php echo($this->uri->segment(2)=='appointments' || $this->uri->segment(2)=='')?'active':'';?>">
              <a href="<?php echo site_url('admin/appointments');?>">
                <i class="fa fa-thumb-tack"></i> <span><?php echo lang('appointments');?></span>
                <small class="badge pull-right bg-red"><?php echo count($appointment_alert) ?></small>
              </a>
            </li>
            <?php }?>

            <?php if(in_array('location',$active_actions) || in_array('tax',$active_actions) || in_array('case_category',$active_actions) || in_array('court_category',$active_actions) || in_array('act',$active_actions) || in_array('court',$active_actions) || in_array('case_stage',$active_actions) || in_array('payment_mode',$active_actions)){?>
            <li class="treeview <?php echo(in_array($this->uri->segment(2), $masters))?'active':'';?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span><?php echo lang('masters');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('location',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='location')?'active':'';?>">
                    <a href="<?php echo site_url('admin/location');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('locations')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('tax',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='tax')?'active':'';?>">
                    <a href="<?php echo site_url('admin/tax');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('tax')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('case_category',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='case_category')?'active':'';?>">
                    <a href="<?php echo site_url('admin/case_category');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('case_category')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('court_category',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='court_category')?'active':'';?>">
                    <a href="<?php echo site_url('admin/court_category');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('court')?> <?php echo lang('category')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('act',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='act')?'active':'';?>">
                    <a href="<?php echo site_url('admin/act');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('act')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('court',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='court')?'active':'';?>">
                    <a href="<?php echo site_url('admin/court');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('court')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('case_stage',$active_actions)){?> 
                <li class="<?php echo($this->uri->segment(2)=='case_stage')?'active':'';?>">
                    <a href="<?php echo site_url('admin/case_stage');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('case')?> <?php echo lang('stages')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('payment_mode',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='payment_mode')?'active':'';?>">
                    <a href="<?php echo site_url('admin/payment_mode');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('payment_mode')?></span>
                    </a>
                </li>
                <?php }?>
              </ul>
            </li>
            <?php } ?>
            <?php if(in_array('settings',$active_actions) || in_array('notification',$active_actions) || in_array('languages',$active_actions)){?>
            <li class="treeview <?php echo($this->uri->segment(2)=='settings' || $this->uri->segment(2)=='notification' || $this->uri->segment(2)=='languages')?'active':'';?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span><?php echo lang('administrative');?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('settings',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='settings')?'active':'';?>">
                    <a href="<?php echo site_url('admin/settings');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('general');?> <?php echo lang('settings');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('notification',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='notification')?'active':'';?>">
                    <a href="<?php echo site_url('admin/notification');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('notification');?> <?php echo lang('settings');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(in_array('languages',$active_actions)){?>
                <li class="<?php echo($this->uri->segment(2)=='languages')?'active':'';?>">
                    <a href="<?php echo site_url('admin/languages');?>"><i class="fa fa-circle-o"></i> 
                        <span><?php echo lang('languages')?></span>
                    </a>
                </li>
                <?php }?>
              </ul>
            </li>
            <?php } ?>
          <?php } ?>
        <!-- /Top Navbar -->
        </ul>
    </section>
        <!-- /.sidebar -->
</aside>
        
    