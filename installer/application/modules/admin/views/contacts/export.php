<?php

header('Content-Type: "text/csv"');
header('Content-Disposition: attachment; filename="'.lang('contacts').'.csv"');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Transfer-Encoding: binary");
header('Pragma: public');

?>
<?php echo lang('serial_number');?>,<?php echo lang('name');?>,<?php echo lang('contact');?>,<?php echo lang('email');?>,<?php echo lang('address');?>,
                            <?php $i=1;
                                
                            foreach ($contacts as $new)
                            {
                                ?>
                                <?php echo $i .","?>
                                <?php echo $new->name .","?>
                                <?php echo $new->contact .","?>
                                <?php echo $new->email .","?>
                                <?php echo $new->address .","?>
                                <?php echo ",\n";?>
                                <?php $i++;
                            }?>
