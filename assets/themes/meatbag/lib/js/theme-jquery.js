jQuery(document).ready(function($) {	
    $('*:first-child').addClass('first-child');
    $('*:last-child').addClass('last-child');
    $('*:nth-child(even)').addClass('even');
    $('*:nth-child(odd)').addClass('odd');
	
	var numwidgets = $('#footer-widgets div.widget').length;
	$('#footer-widgets').addClass('cols-'+numwidgets);
	
	

    var numwidgets = $('.header-widget-area section.widget').length;
    $('.header-widget-area').addClass('cols-'+numwidgets);
    var cols = 12/numwidgets;
    //$('.header-widget-area section.widget').addClass('col-sm-'+cols);
    //$('.header-widget-area section.widget').addClass('col-xs-12');
});
