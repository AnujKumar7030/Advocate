<?php
$CI = get_instance();
$CI->load->model('forgot_model');
$code = $this->uri->segment(4);

    $data['email']    = $this->forgot_model->get_admin_by_code($code);
    
    
      $email=($data['email'][0]->email);
?>    
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo lang('reset_password')?> | <?php echo lang('site_title_simple')?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
  <!-- Font Awesome -->
  <link href="<?php echo base_url('assets/plugins/font-awesome/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="<?php echo base_url('assets/css/ionicons.min.css')?>" rel="stylesheet" type="text/css" />
    
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
    <?php echo lang('site_title')?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   <span><?php echo validation_errors(); ?><span>
    <p class="login-box-msg"><?php echo lang('change_password')?></p>
    <div id="login-box">
        <form action="<?php echo site_url('forgot/forgot_password/reset_password'); ?>" method="post">
          <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
          <div class="form-group has-feedback">
            <input type="password" name="password" placeholder="<?php echo lang('password')?>" class="form-control" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="confirm" placeholder="<?php echo lang('confirm_password')?>" class="form-control" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
         
          <div class="row">
            <div class="col-xs-8">
              <a href="<?php echo site_url('admin/login/'); ?>"><?php echo lang('back_to_login')?></a>
            </div>
            <div class="col-xs-4">
              <input type="hidden" value="submitted" name="submitted"/>
              <input type="hidden" name="email" value="<?php echo  $email;?>" />
              <input type="submit" value="<?php echo lang('change_password')?>" name="submit" class="btn btn-primary btn-block btn-flat"/>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
