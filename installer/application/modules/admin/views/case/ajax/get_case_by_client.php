<?php $base_url =  base_url(); ?>
<table id="example1" class="table table-bordered table-striped table-mailbox">
    <thead>
        <tr>
            <th width="5%"><?php echo lang('serial_number'); ?></th>
			<th width="8%"><?php echo lang('star'); ?></th>
			<th><?php echo lang('case').' '.lang('title'); ?></th>
			<th><?php echo lang('case').' '.lang('number'); ?></th>
			<th><?php echo lang('client'); ?></th>
			<th width="20%"><?php echo lang('action'); ?></th>
        </tr>
    </thead>
                
    <?php
    if(isset($cases)) 
    { ?>
        <tbody>
            <?php
            $i=1;
            foreach ($cases as $new)
            { ?>
                             
               <tr class="gc_row">
                    <td> <?php echo $i ?></td>
					
					<td class="small-col">
                        <?php

                        if($new->is_starred==0) 
                        { 
                            echo '<a href="" at="90" class="Privat"><span class="d-none">'.$new->id.'</span>
    									<i class="fa fa-star-o"></i></a>';
                        }
                        else
                        {
                            echo '<a href="" at="90" class="Public"><span class="d-none">'.$new->id.'</span>
    									<i class="fa fa-star"></i></a>';
                        } ?>
                                    
                        </td>
                            <td><?php echo $new->title; ?></td>
						    <td><?php echo $new->case_no; ?></td>
							<td><?php echo $new->client; ?></td>
							
                            <td width="47%">
								<a class="btn btn-default"  href="<?php echo $base_url.'admin/cases/view_case/'.$new->id; ?>">
                                    <i class="fa fa-eye"></i> <?php echo lang('view'); ?>
                                </a>

								<a class="btn btn-info"  href="<?php echo $base_url.'admin/cases/fees/'.$new->id; ?>"><i class="fa fa-inr"></i> 
                                    <?php echo lang('fees'); ?>
                                </a>

                              	<a class="btn btn-success"  href="<?php echo $base_url.'admin/cases/dates/'.$new->id; ?>"><i class="fa fa-calendar"></i> <?php echo lang('hearing_date'); ?>
                                </a>

                                <a class="btn btn-primary"  href="<?php echo $base_url.'admin/cases/edit/'.$new->id; ?>">
                                    <i class="fa fa-edit"></i> <?php echo lang('edit'); ?>
                                </a>
								
                                <a class="btn btn-warning"  href="<?php echo $base_url.'admin/cases/archived/'.$new->id; ?>">
                                    <i class="fa fa-close"></i> <?php echo lang('archived'); ?>
                                </a>
                            </td>
                        </tr> 
              <?php  $i++;                
            } ?>
        </tbody> <?php
    } ?>
            
</table>