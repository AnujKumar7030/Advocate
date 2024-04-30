<?php



        echo '<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
                                <th width="8%">'.lang('star').'</th>
                                <th>'.lang('case').' '.lang('title').'</th>
                                <th>'.lang('case').' '.lang('number').'</th>
                                <th>'.lang('clients').'</th>
                                <th>'.lang('case').' '.lang('stage').'</th>
                                <th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
                    if(isset($cases)) :
                        echo '  
                                    <tbody>
                                        '. $i=1;foreach ($cases as $new){
                            echo '              <tr class="gc_row">
                                                <td>'.$i.'</td>
                                                
                                                <td class="small-col">
                                        ';        
                            if($new->is_starred==0) { 
                                echo '          
                                                <a href="" at="90" class="Privat"><span class="d-none">'.$new->id.'</span>
                                                <i class="fa fa-star-o"></i></a>
                                            ';
                            }else{
                                echo '
                                                <a href="" at="90" class="Public"><span class="d-none">'.$new->id.'</span>
                                                <i class="fa fa-star"></i></a>';
                            }
                            echo '
                                                </td>
                                                <td>'.$new->title.'</td>
                                                <td>'.$new->case_no.'</td>
                                                <td>'.$new->client.'</td>
                                                <td>'.$new->stage.'</td>
                                                
                                                 <td width="20%">
                                                     <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
                                                     <a class="btn btn-danger ml-20" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                                </td>
                                            </tr>';
                            $i++;
                        }
                        echo ' </tbody>';
                    endif;
        echo ' </table>';

        
?>