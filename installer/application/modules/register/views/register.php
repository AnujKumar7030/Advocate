<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo lang('register')?> | <?php echo lang('site_title_simple')?></title>
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
    <?php echo lang('site_title')?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
    <?php if(validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo validation_errors(); ?>
    </div>
    <?php endif; ?>
    
    <p class="login-box-msg"><?php echo lang('register_new_admin')?></p>
    <div id="login-box">
        <form action="<?php echo site_url('register')?>" method="post" id="register_form">
          <input type="hidden" name="<?php echo $this->csrf_tokens['name']; ?>" value="<?php echo $this->csrf_tokens['hash']; ?>" />
          <div class="form-group has-feedback">
            <input type="text" name="name" class="form-control" placeholder="<?php echo lang('name')?>"/>
            <span class="fa fa-list form-control-feedback"></span>
          </div>  
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="<?php echo lang('username')?>"/>
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password')?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="conf" class="form-control" placeholder="<?php echo lang('confirm_password')?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="<?php echo lang('email')?>"/>
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat pull-right"><?php echo lang('register field submit')?></button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>

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
  
  function check_table()
  {
     $.ajax({
        url: '<?php echo site_url('register/register/check_table') ?>',
        type:'POST',
        success:function(result){
        
            if(result=='error'){
                check_table();
            }else{    
                $('#login-box').html(result);
              }
          
         }
      });
  }
</script>
</body>
</html>
