<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" /> 
        <title>Print Receipt</title>
            <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
            <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
            <!-- font Awesome -->
            <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
            <!-- Ionicons -->
            <link href="<?php echo base_url('assets/css/ionicons.min.css')?>" rel="stylesheet" type="text/css" />
            <!-- Morris chart -->
            
            <!-- Theme style -->
            <link href="<?php echo base_url('assets/css/AdminLTE.css')?>" rel="stylesheet" type="text/css" />
            
            <!-- jQuery 2.0.2 -->
            <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
 
    
    </head>
<body onLoad="window.print()">
 <!-- Content Header (Page header) -->

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
                                <td align="left" style="padding-left:10%;">
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
                                <td colspan="2" style="padding-top:12px;">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class=""  >
                                            <table width="100%" border="0">
                                            <tr>
                                                <td class="" align="left" width="20%" ><b><?php echo lang('cash_received_from')?> </b> </td>
                                                <td class="" width="30%" ><?php echo $receipt->user?> </td>
                                                <td class="" width="5%" ><b><?php echo lang('of')?></b></td>
                                                <td class="" <?php echo $receipt->amount?></td>
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
                                                <table width="100%" border="0" style="border:1px solid #f4f4f4;">
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
                                <td colspan="2" align="right" style="padding-top:40px;">
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
    
                  
                    
            </div><!-- /.box -->
        </div>
     </div>
</section>  
</body>
</html>
