<section class="content-header">
    <h1>
       <?php echo lang('receipt')?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/cases')?>"><?php echo lang('cases')?></a></li>
        <li class="active"><?php echo lang('receipt')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
            <?php 
            if(validation_errors()) {
                ?>
            <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                    <b><?php echo lang('alert')?>!</b><?php echo validation_errors(); ?>
                                                </div>

            <?php  } ?>
              
                    <div class="box-body">
                        
                        <table width="100%" border="0"  class="content invoice">
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="center">
                                                <h2><?php echo $setting->name?></h2>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td width="30%">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="right">
                                                <img src="<?php echo base_url('assets/uploads/images/'.@$setting->image); ?>" width="150" height="85" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left ml-5" >
                                    <table width="100%">
                                    
                                        <tr>
                                <td >
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left" >
                                                <strong><?php echo lang('address')?> :</strong><?php echo $setting->address?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left">
                                                <strong><?php echo lang('phone')?> :</strong><?php echo $setting->contact?></h2>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left">
                                                <strong><?php echo lang('email')?> :</strong><?php echo $setting->email?></h2>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left">
                                                <strong><?php echo lang('website')?> :</strong><?php echo base_url()?></h2>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                                    </table>
                                
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="center">
                                                <h2>Cash Receipt</h2>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left" ><b><?php echo lang('receipt_no')?> #: </b><?php echo $receipt->id?></td>
                                            <td class="" align="right" ><b><?php echo lang('date')?></b>: <?php echo date_convert($receipt->date)?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2 pt-5" >
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class=""  >
                                            <table width="100%" border="0">
                                            <tr>
                                                <td class="" align="left" width="20%" ><b><?php echo lang('cash_received_from')?> </b> </td>
                                                <td class="" width="30%" ><?php echo $receipt->user?> </td>
                                                <td class="" width="5%" ><b><?php echo lang('of')?></b></td>
                                                <td class="" ><?php echo $receipt->amount?></td>
                                            </tr>
                                        </table>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="" align="left" ><b><?php echo lang('for')?> : </b> <?php echo $receipt->title?></td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <table width="100%" border="0" >
                                        <tr>
                                            <td  width="65%">
                                                    
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td class="" ><b><?php echo lang('payment_received_in')?> : </b></td>
                                                        
                                                    </tr>
                                                    <?php if(isset($payment_modes)) {
                                                        foreach($payment_modes as $new){?>
                                                    <tr>
                                                        <td class="" ><b><?php echo $new->name?> </b><?php echo ($new->id==$receipt->payment_mode_id)?' <i class="fa fa-check"></i>':''?></td>
                                                        
                                                    </tr>
                                                        <?php } 
                                                    } ?>
                                                </table>
                                                        
                                                    
                                            </td>
                                            <?php $total_rec = $this->db->query("select sum(amount)  as tot_rec from receipt where case_id = '".$receipt->case_id."'")->row();?>
                                            <td >
                                                <table border="0" class="border-1-f4f4f4 w-100">
                                                    <tr>
                                                        <td class="" align="left" ><b><?php echo lang('total_amount')?>  </b> </td>
                                                        <td><?php echo $receipt->fees ?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="" align="left" ><b><?php echo lang('amount_received')?>  </b> </td>
                                                        <td><?php echo $receipt->amount ?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="" align="left" ><b><?php echo lang('balance_due')?> </b> </td>
                                                        <td><?php $due =$receipt->fees-$total_rec->tot_rec; echo number_format((float)$due, 2, '.', ''); ?></td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2" align="right" class="pt-40">
                                    <table width="30%" border="0" >
                                        <tr>
                                            <th class="" align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ________________________________  </td>
                                            
                                        </tr>
                                        <tr>
                                            <td class="" align="center" ><b><?php echo lang('signed_by')?></td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
    
                   <div class="box-footer">
                        <a href="<?php echo site_url('admin/cases/print_receipt/'.$receipt->id) ?>" target="_blank" class="btn btn-default"><?php echo lang('print')?></a>
                         <a href="<?php echo site_url('admin/cases/pdf/'.$receipt->id) ?>" class="btn btn-primary"> PDF</a>
                         
                         <a href="<?php echo site_url('admin/cases/mail/'.$receipt->id) ?>" class="btn btn-info"> <?php echo lang('mail_to_client')?></a>
                    </div>
                    
            </div><!-- /.box -->
        </div>
     </div>
</section>  
