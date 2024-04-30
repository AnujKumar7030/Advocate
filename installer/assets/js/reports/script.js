(function ($) 
{
  "use strict";
         
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
    
    $(function() {
    
        $('.chzn').chosen();
        
    });

    $(function() {
        $('#example1').dataTable({
        });
    });

    $(function() {
        //bootstrap WYSIHTML5 - text editor
        $(".txtarea").wysihtml5();
    });

    $(function() {
        $( "#datepicker" ).pickmeup({
            format  : 'Y-m-d'
        });
    });

    $(function() {
        $('.datetimepicker').datetimepicker({
            format  : 'Y-m-d',
            timepicker:false
        });
    });

$(function() {
    
    $('.chzn').chosen();
    /* Morris.js Charts */
    // Sales chart
   
   if(json_graph_arr && json_graph_arr.length > 0)
   {
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: json_graph_arr,
            xkey: 'date',
            ykeys: ['amount'],
            labels: ['Amount'],
            lineColors: ['#efefef'],
            lineWidth: 2,
            hideHover: 'auto',
            gridTextColor: "#fff",
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ["#efefef"],
            gridLineColor: "#efefef",
            gridTextFamily: "Open Sans",
            gridTextSize: 10
        });

   }
   
    $(document).on('click','a[href=#week_tab]',function()
    {
        $('#month_tab').removeClass('show');    
        if(json_week_arr && json_week_arr.length > 0)
        {
            var month_line = new Morris.Line({
                element: 'month-chart',
                resize: true,
                data: json_week_arr,
                 xkey: 'date',
                ykeys: ['amount'],
                labels: ['Amount'],
                lineColors: ['#efefef'],
                lineWidth: 2,
                hideHover: 'auto',
                gridTextColor: "#fff",
                gridStrokeWidth: 0.4,
                pointSize: 4,
                pointStrokeColors: ["#efefef"],
                gridLineColor: "#efefef",
                gridTextFamily: "Open Sans",
                gridTextSize: 10
            });
            month_line.redraw();
        }
        
    });
    
    
    $(document).ready(function(){
        $(document).on('click','a[href=#year_tab]',function()
        {
           $('#month_tab').removeClass('show'); 
            
            if(json_year_arr && json_year_arr.length > 0)
            {
                var year_line = new Morris.Line({
                    element: 'year-chart',
                    resize: true,
                    data: json_year_arr,
                    xkey: 'date',
                    ykeys: ['amount'],
                    labels: ['Amount'],
                    lineColors: ['#efefef'],
                    lineWidth: 2,
                    hideHover: 'auto',
                    gridTextColor: "#fff",
                    gridStrokeWidth: 0.4,
                    pointSize: 4,
                    pointStrokeColors: ["#efefef"],
                    gridLineColor: "#efefef",
                    gridTextFamily: "Open Sans",
                    gridTextSize: 10
                });
                        
                year_line.redraw();
            }
        });
    });
    

    $(document).on('click','a[href=#client_tab]',function()
    {     
        $('#month_tab').removeClass('show');
        
        if(json_client_arr && json_client_arr.length > 0)
        {
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: json_client_arr,
                barColors: ['#ffffff'],
                xkey: 'name',
                ykeys: ['amount'],
                labels: ['Amount'],
                hideHover: 'auto',
                gridTextColor: "#ffffff",
            });
        }
    });

});