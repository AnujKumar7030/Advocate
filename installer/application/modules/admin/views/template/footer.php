     
      <footer class="main-footer">
          <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo site_url('/'); ?>"></a>.</strong> All rights
                reserved.
      </footer>
    
</div>
        <!-- ./wrapper -->
        <!-- jQuery UI 1.10.3 --> 
       
        
       <?php // Javascript files ?>
        <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
           <?php if ( ! is_null($js)) : ?>
              <?php $separator = (strstr($js, '?')) ? '&' : '?'; ?>
              <?php echo "\n"; ?><script type="text/javascript" src="<?php echo xss_clean($js); ?>"></script><?php echo "\n"; ?>
           <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
           <?php if ( ! is_null($js)) : ?>
              <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
           <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>

         <script src="<?php echo base_url('assets/js/jquery.pickmeup.min.js')?>" type="text/javascript"></script>
        
        
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap/dist/js/dropdown-bootstrap-extended.js')?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
        <script src="<?php echo base_url('assets/js/feather.min.js')?>" type="text/javascript"></script>

        <!-- iCheck -->
        <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/js/app.js')?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery-toast-plugin/dist/jquery.toast.min.js')?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/init.js')?>" type="text/javascript"></script>
        <script src="<?php //echo base_url('assets/js/dashboard-data.js')?>" type="text/javascript"></script>

        
    </body>
</html>