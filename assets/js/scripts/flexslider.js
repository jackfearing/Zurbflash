//init Flexslider 2
$(window).load(function() {

	$('.flexslider').each(function(index, value) {
		if(this.id){
			var id = this.id;
			var controlId = id.replace("flexslides", "flexcontrol");

		  $('#'+id).flexslider({
			  animation: "fade", 			//slide or fade
			  //direction: "horizontal", //vertical or horizontal
			  smoothHeight: true,
			  slideshow: false,
			  slideshowSpeed: 5000,
			  //animationSpeed: 10000,
			  pauseOnHover: true,
			  randomize: false,
			  controlNav: true,
			  touch: true,
			  manualControls: '.custom-controls#'+controlId+' li a', // Turn on when using fade and smooth height
			  controlsContainer: '.flex-container', // Turn on when using fade and smooth height
			  prevText: "",    	  //String: Set the text for the "previous" directionNav item
			  nextText: "",        //String: Set the text for the "next" directionNav item
			  start: function(slider) {
				  $('body').removeClass('loading');
			  }
		  });
		};

	});

	/*
	$('.flexslider').flexslider ({
		animation: "fade", 			//slide or fade
		//direction: "horizontal", //vertical or horizontal
		smoothHeight: true,
		slideshow: true,
		slideshowSpeed: 5000,
		//animationSpeed: 10000,
		pauseOnHover: true,
		randomize: false,
		controlNav: true,
		touch: true,
		manualControls: '.custom-controls li a', // Turn on when using fade and smooth height
		controlsContainer: '.flex-container', // Turn on when using fade and smooth height
		prevText: "",    	  //String: Set the text for the "previous" directionNav item
		nextText: "",        //String: Set the text for the "next" directionNav item
		start: function(slider) {
			$('body').removeClass('loading');
		}
	});

	*/

	// Fixes issues when resizing flexslider for responsive layouts
	$(function() {
	    var resizeEnd;
	    $(window).on('resize', function() {
	        clearTimeout(resizeEnd);
	        resizeEnd = setTimeout(function() {
	            flexsliderResize();
	        }, 250);
	    });
	});

	function flexsliderResize(){
	    if ($('.flexslider#flexslides-a').length > 0) {
	        $('.flexslider#flexslides-a').data('flexslider').resize();
	    }
	}

}); // end flexslider