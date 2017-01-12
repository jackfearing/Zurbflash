// Custom hamburger menu for off-canvas menu
var $hamburger = $(".hamburger, .js-off-canvas-exit");
$hamburger.on("click", function(e) {
	$hamburger.toggleClass("is-active");
	// Do something else, like open/close menu
});



// ACCORDION (Foundation 6)
/* Applies a class to any elements within the selector (i.e. 'toogle-nav a') */
$(document).ready(function(){
//$('ul.accordion li:first-of-type').addClass('is-active'); // Add class to all first panels
//$('ul.accordion:first-of-type li:first-of-type').addClass('is-active'); // Adds class to first panel in each section repeater
$('.content-wrapper .row:first-of-type > .columns ul.accordion:first-of-type li:first-of-type').addClass('is-active'); // Adds class only to first panel (no childern)
$('.is-active .accordion-content').css('display','block');
});



// Fluidbox trigger
// *** CAUSES ISSUES WHEN USING LIGHTGALLERY DO TO THE URL / EXT TRIGGER ***
jQuery(document).ready(function(){
    //jQuery('a[rel^="lightbox"]').fluidbox();
	$('a[href$=".jpeg"], a[href$=".jpg"], a[href$=".png"], a[href$=".jpeg"]').fluidbox();
});



// Animation On Scroll Global Settings
// https://github.com/michalsnik/aos
AOS.init({
	offset: 100,
	//duration: 600,
	easing: 'ease-in-sine',
	delay: 300,
});



// Flexslider and Interchange
$(document).ready(function() {
  $('.slides').on('replace', 'img', function(e, new_path, original_path) {
    $('.slides').foundation('flexslider').resize();
  });

});



// Remove p tags from images and/or iframes
jQuery(document).ready(function($) {
    // Unwrap images
    //$('p img').unwrap();
    $('p > img').unwrap();

     // Unwrap images and iframes
    //$('p img, p .fluid-width-video-wrapper').unwrap();

});



// Show/hide menu on scroll up-down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
//var navbarHeight = $('.show-for-medium-up').outerHeight();
var navbarHeight = $('.top-bar').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
       //$('.top-bar').removeClass('nav-down').addClass('nav-up'); // issues with safari after MENU button pressed
        $('.top-bar').css({ top: '-200px' , position: 'fixed' }); //Update code
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            // $('.top-bar').removeClass('nav-up').addClass('nav-down'); // issues with safari after MENU button pressed
            $('.top-bar').css({ top: '0px', position: 'fixed' });
        }
    }

    lastScrollTop = st;
}
















// Lightgalley plugin setting for custom transitions
// Change the transition by selecting a new one from the link below
// http://sachinchoolur.github.io/lightGallery/demos/transitions.html
// http://sachinchoolur.github.io/lightGallery/demos/

$(document).ready(function(){
    $('.custom-transitions').lightGallery({
		mode: 'lg-zoom-in',
		//mode: 'lg-slide-skew-ver',
		//mode: 'lg-tube',
	    thumbnail:true,
		toogleThumb: true,
		//showThumbByDefault: false,
		//thumbWidth: 300,
		//thumbContHeight: 300,
		cssEasing: 'cubic-bezier(0.680, -0.550, 0.265, 1.550)',
	});
});


$('.video-thumbnails').lightGallery({
    loadYoutubeThumbnail: true,
    youtubeThumbSize: 'default',
    loadVimeoThumbnail: true,
    vimeoThumbSize: 'thumbnail_medium',
});

$('.video-gallery').lightGallery();
$('.responsive-images').lightGallery();


$('#lightGallery').lightGallery();
$('#launchGallery').click(function(){
    $('#firstImage').trigger('click');

});



// Custom off-canvas menu
$('#toggle').click(function() {
	$(this).toggleClass('active-menu');
	$('#overlay').toggleClass('open');
});

$(document).ready(function() {
    $('.button_container').click(function() {
		$('body').toggleClass('overlay-scroll');
    });
});



$('#html5-videos').lightGallery();



// Used to detect IE and add class which support the object-fit css property
jQuery(document).ready(function($) {
	if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv 11/)) || $.browser.msie == 1){
		$('.post-image-container').each(function () {
			var $container = $(this),
			    imgUrl = $container.find('img').prop('src');
			if (imgUrl) {
			  $container
			    .css('backgroundImage', 'url(' + imgUrl + ')')
			    .addClass('compat-object-fit');
			}
		});
	}
});




// Used to animate the WOW.js script and animate css lib

// *****
//Seems to be an issue with IE9 and Royal Slider Plugin and the Responsive Menus
// Uncomment WOW.JS if using in IE9
// *****

/*
jQuery(document).ready(function($) {
	new WOW().init();
});
*/


// Used to animate the WOW.js script and animate css lib
jQuery(document).ready(function($) {
	if (navigator.userAgent.match(/msie/i) ){ // IE lt IE 10
		//alert('I am an old fashioned Internet Explorer');
	} else if (navigator.userAgent.match(/msie|trident/i)) { // gt IE 10+
		new WOW().init();

	} else {
		new WOW().init();
	}
});



/*
jQuery(document).ready(function($) {
var wow = new WOW({
  boxClass: 'wow',
  animateClass: 'is-animating'
});

wow.init();
});
*/




// ScrollTrigger
// https://github.com/terwanerik/ScrollTrigger

/*
document.addEventListener('DOMContentLoaded', function(){
    var trigger = new ScrollTrigger({
      toggle: {
        visible: 'visibleClass',
        hidden: 'hiddenClass'
      },
      offet: {
        x: 0,
        y: 20
      },
      addHeight: true,
      once: false
    }, document.body, window);
});

window.counter = function() {
	// this refers to the html element with the data-scroll-showCallback tag
	var span = this.querySelector('span');
	var current = parseInt(span.textContent);

	span.textContent = current + 1;
};
*/

// Contents of functions.js
/*
;(function ($) {
    $('#smoothBody').smoothState();
})(jQuery);


$(function(){
		  'use strict';
		  var options = {
		    prefetch: true,
		    blacklist: '.no-smoothState', //links with this class are ignored, like my open menu button
		    scroll: true,
		    cacheLength: 2,
		    onStart: {
		      duration: 500, // Duration of our animation, if animations are longer than this, it causes problems
		      render: function ($container) {

		        // Add your CSS animation reversing class

		        $container.addClass('is-exiting');


		        // Restart your animation.
		        //If you looked at the authors demo, it uses .toggleAnimationClass(), which is outdated now
		        //The Smoothstate demo on the authors site is outdated, but his Github is up to date and uses this method now.
		        smoothState.restartCSSAnimations();
		      }
		    },
		    onReady: {
		      duration: 0,
		      render: function ($container, $newContent) {
		        // Remove your CSS animation reversing class

		        $container.removeClass('is-exiting');


		        // Inject the new content
		        $container.html($newContent);

		      }
		    }
		  },
		  smoothState = $('#smoothBody').smoothState(options).data('smoothState');
		});
*/





