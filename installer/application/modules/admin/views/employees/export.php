<?php

header('Content-Type: "text/csv"');
header('Content-Disposition: attachment; filename="'.lang('employees').'.csv"');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Transfer-Encoding: binary");
header('Pragma: public');

?>
<?php echo lang('serial_number')?>,<?php echo lang('name')?>,<?php echo lang('user_role')?>,<?php echo lang('gender')?>,<?php echo lang('date_of_birth')?>,<?php echo lang('email')?>,<?php echo lang('phone')?>,<?php echo lang('address')?>,
                            <?php $i=1;
                                
                            foreach ($employees as $new)
                            {
                                ?>
                                <?php echo $i .","?>
                                <?php echo $new->name .","?>
                                <?php echo $new->role .","?>
                                <?php echo $new->gender .","?>
                                <?php echo $new->dob .","?>
                                <?php echo $new->email .","?>
                                <?php echo $new->contact .","?>
                                <?php echo $new->address .","?>
                                <?php echo ",\n";?>
                                <?php $i++;
                            }?>
