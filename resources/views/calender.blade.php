@extends('apppage')
@section('content')
 <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet" />
  <style>
  .ui-dialog-title {background-repeat:no-repeat;padding-left:25px;}
  .ui-dialog-titlebar-close {background-image:url({{ asset('apppage/dist/img/No-128.png') }});}
  </style>
  
<section class="content-header">
      <h1>
        Calendar
       
      </h1>
      <ol class="breadcrumb" style="padding-right:150px">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calendar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 <div id="eventContent" title="Event Details" style="display:none;">
    Start: <span id="startTime"></span><br>
    End: <span id="endTime"></span><br><br>
    <p id="eventInfo"></p>
  
</div>
	<!--<div class="container">
	 <a data-toggle="popover" title="Popover Header" data-content="Some content inside the popover"></a>
	 </div>-->
      <div class="row" >
        
        <!-- /.col -->
        <div class="col-md-9" >
          <div class="box box-primary" >
            <div class="box-body no-padding ">
              <!-- THE CALENDAR -->
			 
              <div id="calendar" ></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <!-- Page specific script -->
<script>

  $(function () {
  /* initialize the calendar
     -----------------------------------------------------------------*/
   
    $('#calendar').fullCalendar({
	events: JSON.parse({!! json_encode($content) !!}),
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
	  	eventRender: function (event, element) {
		        element.popover({
		            title: event.title,
		            placement:'right',
		            html:true,
		            trigger : 'click',
		            animation : 'true',
		            content: event.description,
                    container:'body'
                });
		        $('body').on('click', function (e) {
                	if (!element.is(e.target) && element.has(e.target).length === 0 && $('.popover').has(e.target).length === 0)
                        element.popover('hide');
                });
              },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
	  editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
     drop: function (date, allDay) { // this function is called when something is dropped

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

   
  });
</script>
@endsection

