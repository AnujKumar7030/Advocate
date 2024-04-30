<?php $this->load->view('template/header'); ?>
  <div class="content-wrapper">
     <?php 
        if($this->session->flashdata('message'))
            $message = $this->session->flashdata('message');
        if($this->session->flashdata('error'))
            $error  = $this->session->flashdata('error');
    // echo $message;die;
     ?>
     <?php if(!empty($error) || !empty($message)){ ?>
     <div class="p-x-y">
        <div class="row"> 
            <div class="col-md-12 m-t-20">
            
               <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
         
                
                <?php if (!empty($message)): ?>
                    <div class="alert alert-info alert-dismissable">
                        <i class="fa fa-info"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <?php echo $message; ?>
                    </div>
                <?php endif; ?>
             
             </div>
         </div>
     </div>
     <?php }?>
     <?php $this->load->view($body); ?>
  </div>    
<?php $this->load->view('template/footer'); ?>