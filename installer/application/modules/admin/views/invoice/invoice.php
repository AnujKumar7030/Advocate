<section class="content-header">
    <h1><?php echo lang('invoice'); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
      
        <li class="active"><?php echo lang('invoice');?></li>
    </ol>
</section>

<section class="content">
                <?php 
                if(validation_errors()) 
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <b><?php echo lang('alert');?>!</b><?php echo validation_errors(); ?>
                    </div>

                    <?php  
                } ?>  
                 <!-- Main content -->
                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-sm-3 ">
                            <?php if(!empty($setting->image)) { ?>
                                <img src="<?php echo base_url('assets/uploads/images/'.$setting->image)?>"  height="70" width="150" />
                            <?php } ?>    
                            </div>
                            <div class="col-sm-4 invoice-col">    
                                <h2 class="page-header">
                                     <?php echo $setting->name ?>
                                    
                                </h2>
                                
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <small class="pull-right">Date: <?php echo (isset($details->date) && $details->date ? date('d M, Y', strtotime($details->date)) : date('d M, Y', strtotime($details->added)));?></small>
                            </div>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <?php echo lang('from')?>
                            <address>
                                <strong><?php echo $setting->name ?></strong><br>
                               <?php echo $setting->address ?><br>
                                <?php echo lang('phone') ?>: <?php echo $setting->contact ?><br/>
                                <?php echo lang('email') ?>: <?php echo $setting->email ?>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <?php echo lang('to')?>
                            <address>
                                <strong><?php echo $details->client ?></strong><br>
                                <?php echo $details->address ?><br>
                                <?php echo lang('phone') ?>: <?php echo $details->contact ?><br/>
                                <?php echo lang('email') ?>: <?php echo $details->email ?>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b><?php echo lang('invoice')?> #<?php echo $details->invoice ?></b><br/>
                            <b><?php echo lang('case_number') ?>:</b> <?php echo $details->case_no ?><br/>
                            <b><?php echo lang('payment_mode') ?>:</b> <?php echo ($details->mode) ? $details->mode : "-"; ?><br/>
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" ><?php echo lang('status');?> : </label><br/>
                            <?php 
                                $badge_class = ($details->status == 'paid' ? 'btn-success' : ($details->status == 'unpaid' ? 'btn-danger' : ($details->status == 'partially paid' ? 'btn-info' : '')));
                            ?>
                            <div class="<?php echo $badge_class; ?> py-2 px-5 display-inline border-radius-15"><?php echo ($details->status) ? $details->status : "-"; ?></div>
                        </div>
                        <div class="col-md-4 text-center" >
                            <label for="name" ><?php echo lang('issue_date');?> : </label><br/>
                            <div><?php echo ($details->issue_date) ? date('d M, Y', strtotime($details->issue_date)) : "-"; ?></div>
                        </div>
                        <div class="col-md-4 text-right" >
                            <label for="name" ><?php echo lang('due_date');?> : </label><br/>
                            <div><?php echo ($details->due_date) ?  date('d M, Y', strtotime($details->due_date)) : "-"; ?></div>
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="mt-30 mb-5" ><?php echo lang('product_summary');?>  </label><br/>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('product');?></th>
                                        <th><?php echo lang('quantity');?></th>
                                        <th><?php echo lang('rate');?></th>
                                        <th><?php echo lang('tax');?></th>
                                        <th><?php echo lang('price');?></th>
                                    </tr>
                                </thead>
                                <?php if(isset($details) && isset($invoice_product) && !empty($invoice_product)) { ?>
                                    <tbody>
                                        <?php $i= $quantity_sum = $sum_price = $sum_tax = $sum_amount = 0;

                                        foreach ($invoice_product as $i_p_key => $i_p_value) 
                                            {
                                            $quantity_sum += $i_p_value->quantity;
                                            $sum_price += $i_p_value->price;
                                            $sum_tax += $i_p_value->tax_value;
                                            $sum_amount += $i_p_value->amount;
                                            $i++;
                                            ?>
                                            <tr class="gc_row">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $i_p_value->product_item; ?></td>
                                                <td><?php echo $i_p_value->quantity; ?></td>
                                                <td><?php echo $i_p_value->price; ?></td>
                                                <td><?php echo $i_p_value->tax_value; ?></td>
                                                <td><?php echo $i_p_value->amount; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } ?>    
                            </table>
                            <!-- <table class="table table-striped">
                                <thead>
                                    <tr>
                                       
                                        <th><?php echo lang('details') ?></th>
                                         <th align="right"><?php echo lang('amount') ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('payment') ?></td>
                                        <td align="right"><?php echo $details->amount ?></td>
                                        
                                    </tr>
                                     <?php if(isset($taxes)) :?>
                                            <?php $i=1;foreach ($taxes as $new){?>
                                            <tr>
                                            <td><?php echo $new->name?> <span class="pull-right"> <?php echo $new->percent?> %</span> </td>
                                            <td align="right"> <?php  $foo = $new->percent/100*$details->amount;?> <?php echo number_format((float)$foo, 2, '.', ''); ?></td>
                                            
                                        </tr>
                                    
                                                <?php $i++;
                                            }?>
                        
                                     <?php endif;?>
                                     <tr>
                                        <td><?php echo lang('total') ?></td>
                                        <td align="right"><?php echo $details->total?></td>
                                        
                                    </tr>
                                </tbody>
                            </table> -->
                        </div><!-- /.col -->
                        <hr class="w-100">
                        <div class="col-md-6 mb-15" >
                            <label for="name" class="margin-left-105" ><?php echo lang('total');?>  </label>
                            <label for="name" class="margin-left-193" ><?php echo (isset($quantity_sum) && $quantity_sum ? $quantity_sum : 1);?>  </label>
                        </div>
                        <div class="col-md-3 mb-15" >
                            <label for="name margin-left-44" ><?php echo (isset($sum_price) && $sum_price ? $sum_price : ($details->amount ? $details->amount  : "-"));?>  </label>
                        </div>
                        <div class="col-md-3 mb-15" >
                            <label for="name" class="margin-left-145" ><?php echo (isset($sum_tax) && $sum_tax ? $sum_tax : (isset($old_tax) && $old_tax ? $old_tax : 0));?></label>
                        </div>
                        <hr class="w-100">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 mb-15" >
                            <label for="name" class="width-170"><?php echo lang('sub_total');?></label>
                            <label for="name" ><?php echo (isset($sum_amount) && $sum_amount ? $sum_amount :($details->amount ? $details->amount : 0));?>  </label>
                        </div>
                        <hr class="w-100">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 mb-15">
                            <label for="name" class="width-170" ><?php ; echo lang('tax');?><?php echo (isset($details->tax_name) && $details->tax_name ? '( '.$details->tax_name.' )' : "");?></label>
                            <label for="name" ><?php echo (isset($sum_tax) && $sum_tax ? $sum_tax : (isset($old_tax) && $old_tax ? $old_tax : 0));?>  </label>
                        </div>
                        <hr class="w-100">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 mb-15">
                            <label for="name" class="width-170 color-0f5ef7" ><?php echo lang('total');?></label>
                            <?php
                                $sum_tax = (isset($sum_tax) && $sum_tax ? $sum_tax : (isset($old_tax) && $old_tax ? $old_tax : 0));
                                $sum_amount = (isset($sum_amount) && $sum_amount ? $sum_amount : ($details->amount ? $details->amount : 0));
                                $gross_total = ($sum_tax + $sum_amount); ?>
                            <label for="name" class="color-0f5ef7" ><?php echo $gross_total;?>  </label>
                        </div>
                        <hr class="w-100">
                    </div><!-- /.row -->

                    <?php $admin = $this->session->userdata('admin');
                    if($admin['user_role']==2) { ?>
                     <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onClick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print') ?></button>
                          
                            <a href="<?php echo site_url('admin/my_cases/pdf/'.$details->id)?>"class="btn btn-primary pull-right mr-3" ><i class="fa fa-download"></i> <?php echo lang('generate_pdf') ?></a>
                              <a href="<?php echo site_url('admin/my_cases/mail/'.$details->id)?>"class="btn btn-primary pull-right mr-3"><i class="fa fa-mail-forward"></i> <?php echo lang('mail_to_client') ?></a>
                        </div>
                    </div>
                    <?php }else{?>    
                
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onClick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print') ?></button>
                          <?php if(check_user_role(110)==1) {?>
                            <a href="<?php echo site_url('admin/invoice/pdf/'.$details->id)?>"class="btn btn-primary pull-right mr-3" ><i class="fa fa-download"></i> <?php echo lang('generate_pdf') ?></a>
                          <?php } ?>
                        <?php if(check_user_role(109)==1) {?>
                              <a href="<?php echo site_url('admin/invoice/mail/'.$details->id)?>"class="btn btn-primary pull-right mr-3"  ><i class="fa fa-mail-forward"></i> <?php echo lang('mail_to_client') ?></a>
                        <?php } ?>
                        </div>
                    </div>
                    <?php } ?>    
                </section><!-- /.content -->
</section>
