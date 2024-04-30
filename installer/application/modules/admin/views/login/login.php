<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo lang('login')?> | <?php echo lang('site_title_simple')?></title>
 <?php 
    $path    =    base_url('assets/uploads/images/'.$setting->favicon);
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    ?>
    <link rel="shortcut icon" type="image/<?php echo $ext?>" href="<?php echo $path?>"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
  <!-- Font Awesome -->
  <link href="<?php echo base_url('assets/plugins/font-awesome/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="<?php echo base_url('assets/css/ionicons.min.css')?>" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css')?>">
    
  <!-- Custom Theme Style -->
  <link href="<?php echo base_url('assets/css/AdminLTE.css')?>" rel="stylesheet">            
  <link href="<?php echo base_url('assets/css/redactor.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet" type="text/css" />
    
  <!-- jQuery 2.0.2 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js')?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js')?>" type="text/javascript"></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?php //echo lang('site_title'); ?>

    <?php 
      $logo = (isset($setting->image) && $setting->image  ? base_url('assets/uploads/images/'.$setting->image) : base_url('assets/uploads/images/Screenshot_2021-08-03_at_3.36_.17_PM_.png'));
    ?>
    <div class="text-center">
      <img src="<?php echo $logo; ?>" style="width: 220px;">
    </div>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php 
            
    if($this->session->flashdata('message')) {
          $message = $this->session->flashdata('message');
    }
    if($this->session->flashdata('error')) {
        $error  = $this->session->flashdata('error');
    }
        
        
    if(!empty($error) || !empty($message)) { 
        ?>
    
            
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
            
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info alert-dismissable">
                <i class="fa fa-info"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <?php echo $message; ?>
            </div>
        <?php endif; ?>
            
   
    <?php }?>
    <p class="login-box-msg"><?php echo lang('sign_in')?></p>
    <div id="login-box">
        <form action="<?php echo site_url('admin/login')?>" method="post">
          <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />

          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="<?php echo lang('username')?>"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password')?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember_me"/> <?php echo lang('login field remember_me')?>
                  <input type="hidden" value="admin/admin" name="redirect">
                  <input type="hidden" value="submitted" name="submitted">
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('sign_in')?></button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>

    <a href="<?php echo site_url('forgot/forgot_password')?>"><?php echo lang('login field forgot_password')?></a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
     
