


<section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
        </ol>
</section>

<section class="content">
         <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
                <div class="btn-group pull-right">
                  <?php if(check_user_role(56)==1){?>   
                    <a class="btn btn-default" href="<?php echo site_url('admin/banking/add_account/'); ?>"><i class="fa fa-plus"></i> <?php echo lang('add_new');?></a>
                    <?php } ?>  
                </div>
            </div>    
        </div>  
        
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive" >
                    <table id="datable_1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('name');?></th>
                                <th><?php echo lang('bank');?></th>
                                <th><?php echo lang('account_number');?></th>
                                <th><?php echo lang('current_balance');?></th>
                                <th><?php echo lang('contact_number');?></th>
                                <th><?php echo lang('brank_branch');?></th>
                                <th width="20%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                        
                        <?php if(isset($account_list)):?>
                        <tbody>
                            <?php $i=1;foreach ($account_list as $new){
                                
                                $get_from_data = $this->db->select_sum('amount')->where('from_id',$new->id)->get('account_transfer')->row();
                                $get_to_data = $this->db->select_sum('amount')->where('to_id',$new->id)->get('account_transfer')->row();
                                if(isset($get_from_data->amount) && $get_from_data->amount)
                                {
                                    $current_balance = ($new->opening_balance - $get_from_data->amount);
                                }
                                else if(isset($get_to_data->amount) && $get_to_data->amount)
                                {
                                    $current_balance = ($new->opening_balance  + $get_to_data->amount);
                                }
                                else
                                {
                                    $current_balance = $new->opening_balance;   
                                }
                                ?>
                                <tr class="gc_row">
                                    <td><?php echo $new->bank_holder_name; ?></td>
                                    <td><?php echo $new->bank_name; ?></td>
                                    <td><?php echo $new->account_number; ?></td>
                                    <td><?php echo $current_balance; ?></td>
                                    <td><?php echo $new->contact_number; ?></td>
                                    <td><?php echo $new->bank_address; ?></td>
                                    
                                    <td>
                                        <div class="btn-group">
                                            <?php if(check_user_role(57)==1){?> 
                                          <a class="btn btn-primary"  href="<?php echo site_url('admin/banking/edit_account/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit');?></a>
                                          <?php } ?>    
                                          <?php if(check_user_role(59)==1){?>   
                                         <a class="btn btn-danger" style="margin-left:20px;" href="<?php echo site_url('admin/banking/delete_account/'.$new->id); ?>" onclick="return areyousure()"><i class="fa fa-trash"></i> <?php echo lang('delete');?></a>
                                         <?php } ?> 
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;}?>
                        </tbody>
                        <?php endif;?>
                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>