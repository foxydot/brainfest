jQuery(document).ready(function($) {    
    $('*:first-child').addClass('first-child');
    $('*:last-child').addClass('last-child');
    $('*:nth-child(even)').addClass('even');
    $('*:nth-child(odd)').addClass('odd');
    
    $('.pre-header .nav-secondary .genesis-nav-menu .menu-item').click(function(){
        $(this).children('a')[0].click();
    });
    var numwidgets = $('.footer-widgets-2 .widget').length;
    $('.footer-widgets-2').addClass(function(){
        var css_class;
        if ( numwidgets == 1 ) {
            css_class = ' widget-full';
        } else if ( numwidgets == 8 ) {
            css_class = ' widget-thirds';
        } else if ( numwidgets % 3 == 1 ) {
            css_class = ' widget-thirds';
        } else if ( numwidgets % 4 == 1 ) {
            css_class = ' widget-fourths';
        } else if ( numwidgets % 2 == 0 ) {
            css_class = ' widget-halves uneven';
        } else {    
            css_class = ' widget-halves';
        }
        return(css_class);
    }).addClass('flexible-widgets');
});