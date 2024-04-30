<?php

echo '
        <table id="example1" class="table table-bordered table-striped table-mailbox">
            <thead>
                <tr>
                    <th width="5%">'.lang('serial_number').'</th>
                    <th width="8%">'.lang('star').'</th>
                    <th>'.lang('case').' '.lang('title').'</th>
                    <th>'.lang('case').' '.lang('number').'</th>
                    <th>'.lang('client').'</th>
                    <th width="20%">'.lang('action').'</th>
                </tr>
            </thead>
                        
                   ';
            if(isset($cases))
            {
                echo '<tbody>';
                    $i=1;
                    foreach ($cases as $new)
                    {
                             
                        echo '<tr class="gc_row">
                                    <td>'.$i.'</td>
                                    
                                    <td class="small-col">'; 
                                        if($new->is_starred==0) 
                                        { 
                                            echo '<a href="" at="90" class="Privat"><span class="d-none">'.$new->id.'</span><i class="fa fa-star-o"></i></a>';
                                        }
                                        else
                                        {
                                            echo '<a href="" at="90" class="Public"><span class="d-none">'.$new->id.'</span><i class="fa fa-star"></i></a>';
                                        }
                                    
                                    echo'   </td>
                                    <td>'.$new->title.'</td>
                                    <td>'.$new->case_no.'</td>
                                    <td>'.$new->client.'</td>
                                    
                                    <td width="47%">
                                        <a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
                                        <a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>   
                                        <a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>                          
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
                                        <a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                        </tr>';    
                        $i++;
                    }
                echo '</tbody>';
            }
                    
        echo '</table>'; ?>