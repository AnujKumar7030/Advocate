<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
</section>

<section class="content">
    <div class="row mb-5" >
        <div class="col-md-12 text-right mb-15" >
            <a class="btn btn-primary"  href="#"><?php echo lang('resend_invoice'); ?></a>
            <a class="btn btn-primary print-btn"  href="" target="_blank"> <?php echo lang('print'); ?></a>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="print-area">
                        <div class="row">
                            <div class="col-md-6"><h3><?php echo lang('invoice'); ?></h3></div>
                            <div class="col-md-6 text-right" ><h3><?php echo $invoice->invoice; ?></h3></div>
                            <hr class="w-100">
                            <div class="col-md-12 mb-15">
                                <div class="py-3 px-0">Name: <?php echo $invoice->name; ?></div>
                                <div class="py-3 px-0">Address: <?php echo $invoice->address;?></div>
                                <div class="py-3 px-0" >Dob: <?php echo date("d-m-Y", strtotime($invoice->dob));?></div>
                                <div class="py-3 px-0">Gender: <?php echo $invoice->gender;?></div>
                                <div class="py-3 px-0">Contact: <?php echo $invoice->contact;?></div>
                                <div class="py-3 px-0">Email: <?php echo $invoice->email;?></div>
                            </div>
                            <div class="col-md-4">
                                <label for="name" ><?php echo lang('status');?> : </label><br/>
                                <?php 
                                    $badge_class = ($invoice->status == 'paid' ? 'btn-success' : ($invoice->status == 'unpaid' ? 'btn-danger' : ($invoice->status == 'partially paid' ? 'btn-info' : '')));
                                ?>
                                <div class="<?php echo $badge_class; ?> py-2 px-5 display-inline border-radius-15"><?php echo $invoice->status; ?></div>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="name" ><?php echo lang('issue_date');?> : </label><br/>
                                <div><?php echo date('d M, Y', strtotime($invoice->issue_date)); ?></div>
                            </div>
                            <div class="col-md-4 text-right" >
                                <label for="name" ><?php echo lang('due_date');?> : </label><br/>
                                <div><?php echo date('d M, Y', strtotime($invoice->due_date)); ?></div>
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="mt-30 mb-5"><?php echo lang('product_summary');?>  </label><br/>
                            </div>
                            <div class="box-body table-responsive" >
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
                                    <?php if(isset($invoice)) { ?>
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
                            </div>
                            <hr class="w-100">
                            <div class="col-md-6 mb-15">
                                <label for="name ml-105"><?php echo lang('total');?>  </label>
                                <label for="name" class="margin-left-193"><?php echo $quantity_sum;?>  </label>
                            </div>
                            <div class="col-md-6 mb-15">
                                <label for="name" class="ml-44"><?php echo $sum_price;?>  </label>
                                <label for="name" class="margin-left-145"><?php echo $sum_tax;?>  </label>
                            </div>
                            <hr class="w-100">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 mb-15" >
                                <label for="name" class="width-170"><?php echo lang('sub_total');?></label>
                                <label for="name" ><?php echo $sum_amount;?>  </label>
                            </div>
                            <hr class="w-100">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 mb-15" >
                                <label for="name" class="width-170"><?php echo lang('tax');?><?php echo '( '.$invoice->tax_name.' )';?></label>
                                <label for="name" ><?php echo $sum_tax;?>  </label>
                            </div>
                            <hr class="w-100">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 mb-15" >
                                <label for="name" class="width-170 color-0f5ef7"><?php echo lang('total');?></label>
                                <?php $gross_total = ($sum_tax + $sum_amount); ?>
                                <label for="name" class="color-0f5ef7"><?php echo $gross_total;?>  </label>
                            </div>
                            <hr class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>