jQuery(document).ready(function($) {    
    $('*:first-child').addClass('first-child');
    $('*:last-child').addClass('last-child');
    $('*:nth-child(even)').addClass('even');
    $('*:nth-child(odd)').addClass('odd');
    
    $('.pre-header .nav-secondary .genesis-nav-menu .menu-item').click(function(){
        $(this).children('a')[0].click();
    });
});