jQuery(document).ready(function($) {   
    $('.widget.featured-content article>a').removeAttr('href');
    $('.widget.featured-content .entry-title a').contents().unwrap()
});

var controller = new ScrollMagic.Controller();
// build scene
var scene = new ScrollMagic.Scene({triggerElement: ".site-inner",triggerHook: 0, duration: 150})
    // animate color and top border in relation to scroll position
    .setTween(".site-header .title-area .site-title a", {className: '+=smaller'}) // the tween durtion can be omitted and defaults to 1
    .addTo(controller);