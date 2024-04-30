<section class="content-header">
    <h1><?php echo lang('reports');?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard');?></a></li>
      
        <li class="active"><?php echo lang('reports');?></li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                   
                </div><!-- /.box-header -->
                <!-- form start -->
                   <div class="box-body">
                       
                      <div class="row">
                        <div class="col-md-10">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="month-tab" data-toggle="tab" href="#month_tab" role="tab" aria-controls="month_tab" aria-selected="true"><?php echo lang('by') ." ". lang('month');?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="week-tab" data-toggle="tab" href="#week_tab" role="tab" aria-controls="week_tab" aria-selected="true"><?php echo lang('by') ." ". lang('week');?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="year-tab" data-toggle="tab" href="#year_tab" role="tab" aria-controls="year_tab" aria-selected="true"><?php echo lang('by') ." ". lang('year');?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="client-tab" data-toggle="tab" href="#client_tab" role="tab" aria-controls="client_tab" aria-selected="true"><?php echo lang('by') ." ". lang('client');?></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active in" id="month_tab" role="tabpanel" aria-labelledby="month-tab">
                                        <!--graph code start  -->
                                        
                                        <!-- solid sales graph -->
                                        <div class="box box-solid bg-teal-gradient">
                                            <div class="box-header with-border">
                                                <i class="fa fa-th"></i>
                                                <h3 class="box-title">Earning Graph (Monthly)</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body border-radius-none">
                                                <div class="chart height-250" id="line-chart" ></div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->


                                        <!--graph code end -->
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane fade" id="week_tab" role="tabpanel" aria-labelledby="week-tab">
                                         <div class="box box-solid bg-teal-gradient">
                                            <div class="box-header with-border">
                                                <i class="fa fa-th"></i>
                                                <h3 class="box-title">Earning Graph (Weekly)</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body border-radius-none">
                                                <div class="chart height-250" id="month-chart" ></div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.tab-pane -->
                                    
                                     <div class="tab-pane fade" id="year_tab" role="tabpanel" aria-labelledby="year-tab">
                                       <!-- solid sales graph -->
                                        <div class="box box-solid bg-teal-gradient">
                                            <div class="box-header with-border">
                                                <i class="fa fa-th"></i>
                                                <h3 class="box-title">Earning Graph (Yearly)</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body border-radius-none">
                                                <div class="chart height-250" id="yyear_chart" ></div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.tab-pane -->
                                    
                                     <div class="tab-pane fade" id="client_tab" role="tabpanel" aria-labelledby="client-tab">
                                       <div class="box box-solid bg-teal-gradient">
                                            <div class="box-header with-border">
                                                <i class="fa fa-th"></i>
                                                <h3 class="box-title">Client Graph</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body border-radius-none">
                                                <div class="chart height-300" id="bar-chart"></div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->

                  </div>
                      
                      
                        
                    </div><!-- /.box-body -->
    
             </form>
            </div><!-- /.box -->
        </div>
     </div>
</section>  

<?php 
     
    $graph_arr = array();
    foreach($months as $ind => $month) 
    {

        if($month->issue_date)
        {
            $graph_arr[$ind]['date'] = $month->issue_date;
            $graph_arr[$ind]['amount'] = $month->new_total_amount ? round($month->new_total_amount) : 0;
        }
    }



    $week_arr = array();

    foreach($weeks as $ind => $week) 
    {
        if($week->issue_date)
        {
            $week_arr[$ind]['date'] = $week->issue_date;
            $week_arr[$ind]['amount'] = $week->new_total_amount ? round($week->new_total_amount) : 0;
        } 
    }
    
    
    $year_arr = array();
        
    foreach($years as $ind => $year) 
    {
        if($year->issue_date)
        {
            $year_arr[$ind]['date'] = $year->issue_date;
            $year_arr[$ind]['amount'] = $year->new_total_amount ? round($year->new_total_amount) : 0;
            //$year_arr[$ind]['y'] = $year->total ? round($year->total) : 0;
        }
        
    }
    
    $client_arr = array();
    foreach($clients as $ind => $client) 
    {
        $client_arr[$ind]['name'] = $client->name;
        $client_arr[$ind]['amount'] = round($client->new_total_amount);
    }
?>    

<script type="text/javascript">

    var json_graph_arr = '<?php echo json_encode($graph_arr); ?>';
    json_graph_arr = JSON.parse(json_graph_arr);
    
    var json_week_arr = '<?php echo json_encode($week_arr); ?>';
    json_week_arr = JSON.parse(json_week_arr);
    
    var json_year_arr = '<?php echo json_encode($year_arr); ?>';
    json_year_arr = JSON.parse(json_year_arr);
    
    var json_client_arr = '<?php echo json_encode($client_arr); ?>';
    json_client_arr = JSON.parse(json_client_arr);

</script>
