(function ($) 
{
  "use strict";
         
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }

          // Apply Leave Popup 
          $(document).ready(function() {
            
                var max_fields      = 100; //maximum input boxes allowed
                var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row"><div class="col-xs-3"><input type="text" name="date[]" value="" placeholder="date" class="form-control datepicker" required/></div><div class="col-xs-4"><div class="form-group"><select name="leave_id[]" class="form-control select2 w-100"><option value="">-- Select Leave Type</option><?php foreach($leave_types as $new){ echo "<option value=".$new->id.">".$new->name."</option>";                                                                                                                                 }?></select></div></div><div class="col-xs-5"><input type="text" name="reason[]" value="" placeholder="Reason" class="form-control" required /></div></div><div class="row"><div class="col-xs-12"><a  href="#" class="remove_field btn btn-danger m-b-20">Remove </a></div></div>'); //add input box
                        jQuery('.datepicker').datetimepicker({
                         timepicker:false,
                         format:'Y-m-d',
                         minDate:'-1970/01/01',
                         onSelectDate:function(ct,$i){
                          $i.datetimepicker('destroy');
                         }
                        });            
            
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
                
                $('.datepicker').datetimepicker({
                 timepicker:false,
                 format:'Y-m-d',
                 minDate:'-1970/01/01',
                 onSelectDate:function(ct,$i){
                  $i.datetimepicker('destroy');
                 }
                });    
            
            });



    $(document).ready(function() 
    {
        var events_array = appointment_of_month;

        $(function() 
        {        
            var currentLangCode = 'en';
            // build the language selector's options
            $.each($.fullCalendar.langs, function(langCode) 
            {
                $('#lang-selector').append(
                    $('<option/>')
                        .attr('value', langCode)
                        .prop('selected', langCode == currentLangCode)
                        .text(langCode)
                );
            });



            // rerender the calendar when the selected option changes
            $('#lang-selector').on('change', function() 
            {
                if (this.value) 
                {
                    currentLangCode = this.value;
                    $('#calendar').fullCalendar('destroy');
                    //start cal code
                        

                    /* initialize the calendar
                     -----------------------------------------------------------------*/
                    //Date for the calendar events (dummy data)
                    var date = new Date();
                    var d = date.getDate(),
                            m = date.getMonth(),
                            y = date.getFullYear();
                    $('#calendar').fullCalendar({
                         showAgendaButton: true,
                    columnFormat: { month: 'ddd', week: 'ddd d/M', day: 'dddd d/M' },
                    timeFormat: 'H:mm',
                    axisFormat: 'H:mm',
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        lang: currentLangCode,
                        buttonText: {
                            today: 'today',
                            month: 'month',
                            week: 'week',
                            day: 'day'
                        },
                        //Random default events
                        events: events_array,
                        editable: true,
                        droppable: false, // this allows things to be dropped onto the calendar !!!
                        drop: function(date, allDay) 
                        { // this function is called when something is dropped

                            // retrieve the dropped element's stored Event Object
                            var originalEventObject = $(this).data('eventObject');

                            // we need to copy it, so that multiple events don't have a reference to the same object
                            var copiedEventObject = $.extend({}, originalEventObject);

                            // assign it the date that was reported
                            copiedEventObject.start = date;
                            copiedEventObject.allDay = allDay;
                            copiedEventObject.backgroundColor = $(this).css("background-color");
                            copiedEventObject.borderColor = $(this).css("border-color");

                            // render the event on the calendar
                            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                $(this).remove();
                            }

                        }
                    });
                    
                    
                    //end cal code
                    
                    
                }
            });

                    
                    

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();
                    var events_array_second = events_array;

            $('#calendar').fullCalendar(
            {
                showAgendaButton: true,
                columnFormat: { month: 'ddd', week: 'ddd d/M', day: 'dddd d/M' },
                timeFormat: 'H:mm',
                axisFormat: 'H:mm',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                lang: currentLangCode,
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
                events: events_array_second,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) 
                { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) 
                    {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                }
            });     
                   
        });
        
    });
     