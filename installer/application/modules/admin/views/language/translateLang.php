<section class="content-header">
    <h1><?php echo lang('language')?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/languages')?>"> <?php echo lang('language')?></a></li>
      
        <li class="active"><?php echo lang('translate')?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
            
                    <div class="box-body">
                        <?php echo form_open('admin/translator/index/'.$language->id, 'id="langForm"', $hidden);?>
                        <input type="hidden" name="slaveLang" value="<?php echo strtolower($language->name);?>" />
                        <input type="hidden" name="langModule" value="admin_lang.php" />    
                         <table id="example1" class="table table-bordered table-striped">
                        
                        <?php
                        
                        echo '<thead><tr>';
                        echo '<th >SR NO</th>';
                        echo '<th class="translator_table_header">' . 'Key' . '</th>';
                        echo '<th class="translator_table_header">' . ucwords($masterLang) . '</th>';
                        echo '<th class="translator_table_header">' . ucwords($slaveLang) . '</th>';
                        echo '</tr></thead>';
                        echo '<tbody>';
                        $i=1;
                        foreach ( $moduleData as $key => $line ) {
                            echo '<tr valign="top">';
                            echo '<td >' . $i . '</td>';
                            echo '<td>' . $key . '</td>';
                            echo '<td>' . htmlspecialchars($line[ 'master' ]) . '</td>';
                            
                            if (mb_strlen($line[ 'slave' ]) > $textarea_line_break ) {
                                echo '<td>' . form_textarea(
                                    array( 'name' => $postUniquifier . $key,
                                                                    'value' => $line[ 'slave' ],
                                                                    'rows' => $textarea_rows
                                                                    )
                                );
                            } else {
                                echo '<td>' . form_input($postUniquifier . $key, $line[ 'slave' ], 'class="form-control"');
                            }
                        
                            if (strlen($line[ 'error' ]) > 0 ) {
                                echo '<br /><span class="translator_error">' . $line[ 'error' ] . '</span>';
                            }
                        
                            if (strlen($line[ 'note' ]) > 0 ) {
                                echo '<br /><span class="translator_note">' . $line[ 'note' ] . '</span>';
                            }
                        
                            echo '</td>';
                            echo '</tr>';
                            $i++;
                        }
                        echo '</tbody>';
                        ?>
                        
                        </table>
                        <input type="submit" name="SaveLang" value="<?php echo lang('save')?>" class="btn btn-primary">
                        <?php
                        echo form_close();
                            
                        ?>
            
                    </div>            
            </div><!-- /.box -->
        </div>
    </div>
</section>