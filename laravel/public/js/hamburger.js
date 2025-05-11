$(function(){
    $('#hamburger').on('click', function(){
        $('#left-panel').toggleClass('collapsed');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    if(window.matchMedia('(max-width: 768px)').matches) {
        $('#hamburger').trigger('click');
    }
});


