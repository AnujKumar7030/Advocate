<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo lang('forgot_password')?> | <?php echo lang('site_title_simple')?></title>
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
   <span><?php echo validation_errors(); ?><span>
    <p class="login-box-msg"><?php echo lang('forgot_password')?></p>
    <div id="login-box">
        <form action="<?php echo site_url('forgot/forgot_password'); ?>" method="post">
          <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
          <div class="form-group has-feedback">
            <input type="text" name="email" placeholder="<?php echo lang('enter_your_account_email')?>" class="form-control"  />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
         
          <div class="row">
            <div class="col-xs-8">
              <a href="<?php echo site_url('admin/login/'); ?>"><?php echo lang('back_to_login')?></a>
            </div>
            <div class="col-xs-4">
              <input type="hidden" value="submitted" name="submitted"/>
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('reset_password')?></button>
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
