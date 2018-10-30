<html>
    <head>
    <title>Calendar</title>
        <meta charset='utf-8' />
        <link href="<?php echo base_url();?>libraries/css/bootstrap.min.css" rel="stylesheet">
        <link href='<?php echo base_url();?>libraries/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
        <link href="<?php echo base_url();?>libraries/css/bootstrapValidator.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>libraries/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>libraries/css/bootstrap-datetimepicker.css" rel="stylesheet" />

        <!-- Custom css  -->
        <link href="<?php echo base_url();?>libraries/css/custom.css" rel="stylesheet" />

        <script src='<?php echo base_url();?>libraries/js/moment.min.js'></script>
        <script src="<?php echo base_url();?>libraries/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>libraries/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>libraries/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url();?>libraries/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src='<?php echo base_url();?>libraries/js/bootstrap-colorpicker.min.js'></script>
        <script src='<?php echo base_url();?>libraries/js/bootstrap-datetimepicker.js'></script>
        <script src='<?php echo base_url();?>libraries/js/main_c.js'></script>
    <style>

    </style>
    </head>
    <body>
<div class="">
        <!-- Notification -->
        <div class="alert"></div>
        <div class="row clearfix">
             <p class="col-md-12">
                 <a href="<?php echo base_url();?>home" class="btn btn-default" >Kembali Ke Menu</a>
            </p>
            <div id='calendar'></div>
        </div>
        <br>
</div>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="error"></div>
                    <form class="form-horizontal" id="crud-form">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="title">Title</label>
                            <div class="col-md-4">
                                <input id="title" name="title" type="text" class="form-control input-md" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="description">Description</label>
                            <div class="col-md-4">
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="color">Color</label>
                            <div class="col-md-4">
                                <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                                <span class="help-block">Click to pick a color</span>
                            </div>
                        </div>
                        <input type="hidden" id="start">
                        <input type="hidden" id="end">
                        <!-- <div class="form-group">
                             <label class="col-md-4 control-label" for="title">Start</label>
                            <div class='input-group date col-md-4' id='datetimepicker1'>
                                <input type='text' id="start" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                             <label class="col-md-4 control-label" for="title">End</label>
                            <div class='input-group date col-md-4' id='datetimepicker2'>
                                <input type='text' id="end" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(function () {
        $('#calendar').fullCalendar({
        header: {
            left: 'prev, next, today',
            center: 'title',
             right: 'month, basicWeek, basicDay'
        },
        // Get all events stored in database
        eventLimit: true, // allow "more" link when too many events
        events: base_url+'calendar/getEvents',
        selectable: true,
        selectHelper: true,
        editable: <?= hasPermission('calendar','updateEvent')?"true":"false" ?>, // Make the event resizable true
            select: function(start, end) {
                // console.log(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                 // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-success', // Buttons class
                        label: 'Add' // Buttons label
                    }
                },
                title: 'Add Event' // Modal title
            });
            },

         eventDrop: function(event, delta, revertFunc,start,end) {
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }

           $.post(base_url+'calendar/dragUpdateEvent',{
                id:event.id,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                hide_notify();


            });



          },
          eventResize: function(event,dayDelta,minuteDelta,revertFunc) {

                start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }

               $.post(base_url+'calendar/dragUpdateEvent',{
                id:event.id,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                hide_notify();

            });
            },

        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view){

            var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;
            // Open modal to edit or delete event
            modal({
                // Available buttons when editing
                buttons: {
                    delete: {
                        id: 'delete-event',
                        css: 'btn-danger',
                        label: 'Delete',
                        dom:'<?= hasPermission("calendar","deleteEvent")?"":"disabled" ?>'
                    },
                    update: {
                        id: 'update-event',
                        css: 'btn-success',
                        label: 'Update',
                        dom:'<?= hasPermission("calendar","updateEvent")?"":"disabled" ?>'
                    }
                },
                title: 'Edit Event "' + calEvent.title + '"',
                event: calEvent
            });
        }

    });

        // $('#datetimepicker1').datetimepicker({
        //     format:'YYYY-MM-DD HH:mm:ss'
        // });
        // $('#datetimepicker2').datetimepicker({
        //     format:'YYYY-MM-DD HH:mm:ss'
        // });
    });
</script>
    </body>
</html>