// Confirmation handler
const confirmButtons = document.getElementsByClassName('confirmed');

Array.from(confirmButtons).forEach(button => {
    button.addEventListener('click', event => {
        const ok = window.confirm('Are you sure?');
        if (!ok) {
            event.preventDefault();
        }
    });
});


// Show description handler
$(document).ready(function() {
    $('.show-desc').on('click', function() {
        const $desc = $(this).next('div.description');
        $('div.description.display-over').not($desc).fadeOut(200, function() {
            $(this).removeClass('display-over').addClass('display-none');
        });
        if ($desc.hasClass('display-none')) {
            $desc.removeClass('display-none').addClass('display-over').hide().fadeIn(200);
        } else {
            $desc.fadeOut(200, function() {
                $(this).removeClass('display-over').addClass('display-none');
            });
        }
    });

    $('.description .fa-close').on('click', function() {
        const $desc = $(this).closest('div.description');
        $desc.fadeOut(200, function() {
            $(this).removeClass('display-over').addClass('display-none');
        });
    });
});

// Hamburger handler
$(function(){
    const mql = window.matchMedia('(max-width:768px)');
    $('body').addClass('no-transition');

    function ensureCollapsed() {
        if (mql.matches) {
            $('#left-panel').addClass('collapsed');
            $('#hamburger i').removeClass('fa-times').addClass('fa-bars');
        }
    }

    mql.addEventListener('change', ensureCollapsed);
    ensureCollapsed();

    requestAnimationFrame(function(){
        requestAnimationFrame(function(){
            $('body').removeClass('no-transition');
        });
    });

    $('#hamburger').on('click', function(){
        $('div.description.display-over').fadeOut(200, function(){
            $(this).removeClass('display-over').addClass('display-none');
        });
        $('#left-panel').toggleClass('collapsed');
        $('#left-panel').toggleClass('fullscreen');

        $(this).find('i').toggleClass('fa-bars fa-times');
        if (mql.matches) {
            $('body').toggleClass('no-scroll',
                $('#left-panel').hasClass('fullscreen'));
        }
    });
});




