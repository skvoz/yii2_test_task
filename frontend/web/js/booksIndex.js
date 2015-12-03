$(function(){
//toggle search
    $( ".search" ).click(function() {
        $( "#search" ).toggle('slow');
    });

//modal edit books
    $('.edit-btn').on('click', function() {
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });
});
