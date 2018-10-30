
var re = new RegExp(/^.*\//);
    // alert();
    // var base_url='http://web/kalender/'; // Here i define the base_url
var base_url=re.exec(window.location.href);
var currentDate; // Holds the day clicked when adding a new event
var currentEvent; // Holds the event object when editing an event
function modal(data) {
    // Set modal title
    $('.modal-title').html(data.title);
    // Clear buttons except Cancel
    $('.modal-footer button:not(".btn-default")').remove();
    // Set input values
    $('#title').val(data.event ? data.event.title : '');
    $('#description').val(data.event ? data.event.description : '');
    $('#color').val(data.event ? data.event.color : '#3a87ad');
    // $("#start").val(data.event ? data.event.start:'');
    // $("#end").val(data.event ? data.event.end:'');
    // console.log(data.event.start);
    // Create Butttons
    $.each(data.buttons, function(index, button){
        $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '" '+button.dom+'>' + button.label + '</button>')
    })
    //Show Modal
    $('.modal').modal('show');
}
 function hide_notify()
{
    setTimeout(function() {
                $('.alert').removeClass('alert-success').text('');
            }, 2000);
}


// Dead Basic Validation For Inputs
function validator(elements) {
    var errors = 0;
    $.each(elements, function(index, element){
        if($.trim($('#' + element).val()) == '') errors++;
    });
    if(errors) {
        $('.error').html('Please insert title and description');
        return false;
    }
    return true;
}
$(function(){


    $('#color').colorpicker();

    // Fullcalendar

    // Prepares the modal window according to data passed


    // Handle Click on Add Button
    $('.modal').on('click', '#add-event',  function(e){
        if(validator(['title', 'description'])) {
            $.post(base_url+'calendar/addEvent', {
                title: $('#title').val(),
                description: $('#description').val(),
                color: $('#color').val(),
                start: $('#start').val(),
                end: $('#end').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('Event added successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
        }
    });


    // Handle click on Update Button
    $('.modal').on('click', '#update-event',  function(e){
        if(validator(['title', 'description'])) {
            $.post(base_url+'calendar/updateEvent', {
                id: currentEvent._id,
                title: $('#title').val(),
                description: $('#description').val(),
                color: $('#color').val(),
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();

            });
        }
    });



    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
        $.get(base_url+'calendar/deleteEvent?id=' + currentEvent._id, function(result){
            $('.alert').addClass('alert-success').text('Event deleted successfully !');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();
        });
    });


});