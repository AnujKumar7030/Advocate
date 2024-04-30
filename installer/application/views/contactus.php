<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid pt-5 body_background">
   <div class="container">
      <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary mb-5">
               <div class="card-header">
                  <h4>Contact Us</h4>
               </div>
               <div class="card-body">
                 


                        <?php echo form_open('', array('method' => 'POST', 'id' => 'contactForm', 'class' => 'contact-form form' ));?>
                           <?php if($flash_message)
                           { 
                              ?>
                           <div class="contact-form-success alert alert-success mt-4" id="contactSuccess">
                              <strong>Success!</strong> Your message has been sent to us.
                           </div>
                           <?php }?>

                           <?php if($flash_error){ ?>
                           <div class="contact-form-danger alert alert-danger  mt-4" id="contactSuccess">
                              <strong>Error!</strong> Error During Send Message !.
                           </div>
                           <?php }?>

                           <div class="contact-form-error alert alert-danger d-none mt-4" id="contactError">
                              <strong>Error!</strong> There was an error sending your message.
                              <span class="mail-error-message text-1 d-block" id="mailErrorMessage"></span>
                           </div>


                           <?php 
                                  $post_value =  $this->input->post('name') ? $this->input->post('name') : ""; 
                                  $post_value =  $post_value ? $post_value : (isset($form_data->name) ? $form_data->name : "");
                              ?>                         
                           <div class="form-row">
                              <div class="form-group text-left col  <?php echo form_error('name') ? ' has-error' : ''; ?>">
                                 <input type="text" value="<?php echo $post_value; ?>" placeholder="Your Name" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                                 <span class="small form-error"> <?php echo strip_tags(form_error('name')); ?> </span> 
                              </div>
                           </div>

                           <?php 
                                  $post_value =  $this->input->post('email') ? $this->input->post('email') : ""; 
                                  $post_value =  $post_value ? $post_value : (isset($form_data->email) ? $form_data->email : "");
                              ?>
                           <div class="form-row">
                              <div class="form-group text-left col  <?php echo form_error('email') ? ' has-error' : ''; ?>">
                                 <input  value="<?php echo $post_value; ?>" type="email" placeholder="Your E-mail" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                                 <span class="small form-error"> <?php echo strip_tags(form_error('email')); ?> </span> 
                              </div>
                           </div>

                           <?php 
                                  $post_value =  $this->input->post('phone_number') ? $this->input->post('phone_number') : ""; 
                                  $post_value =  $post_value ? $post_value : (isset($form_data->phone_number) ? $form_data->phone_number : "");
                              ?>

                           <div class="form-row">
                              <div class="form-group text-left col  <?php echo form_error('phone_number') ? ' has-error' : ''; ?>">
                                 <input  value="<?php echo $post_value; ?>" type="text" placeholder="Phone Number" value="" data-msg-required="Please enter the phone number." maxlength="100" class="form-control" name="phone_number" id="subject" required>
                                 <span class="small form-error"> <?php echo strip_tags(form_error('phone_number')); ?> </span> 
                              </div>
                           </div>


                           <?php 
                                  $post_value =  $this->input->post('message') ? $this->input->post('message') : ""; 
                                  $post_value =  $post_value ? $post_value : (isset($form_data->message) ? $form_data->message : "");
                              ?>
                           <div class="form-row">
                              <div class="form-group text-left col  <?php echo form_error('message') ? ' has-error' : ''; ?>">
                                 <textarea  value="<?php echo $post_value; ?>" maxlength="5000" placeholder="Message" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message" required><?php echo $post_value; ?></textarea>
                                 <span class="small form-error"> <?php echo strip_tags(form_error('message')); ?> </span> 
                              </div>
                           </div>

                           <div class="form-row">
                              <div class="form-group text-center col">
                                 <input type="submit" value="Send Message" class="btn btn-quaternary  btn-lg text-uppercase font-weight-semibold" data-loading-text="Loading...">
                              </div>
                           </div>
                        <?php echo form_close();?>



                  
               </div>
            </div>
          </div>
      </div>
   </div>
</div>