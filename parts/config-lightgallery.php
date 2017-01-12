<script>

	$(document).ready(function() {


		function PauseAllVideosForModal(){
			for (i = 0; i < players.length; ++i) {
				console.log(players[i]);
				players[i].pauseVideo();
				}

		};
		function PlayAllVideosForModal(){
			for (i = 0; i < players.length; ++i) {
				console.log(players[i]);
				players[i].playVideo();
				}

		};



		$(".html5gallery").lightGallery({
			controls:true,
			autoplayControls: false,
			zoom: false,
			download: false
		});

		$(".imageGallery").lightGallery();

		$(".vimeo-video-gallery-private").lightGallery({
			loadVimeoThumbnail: false,
			vimeoPlayerParams: {
				/* title : 1, */
				byline : 0,
				portrait : 0
				/* color : 'A90707', */
			}
		});


		$(".vimeo-video-gallery-public").lightGallery({
			controls: true,
			autoplayControls: false,
			zoom: false,
			download: false,
			loadYoutubeThumbnail: true,
			youtubeThumbSize: 'default',
			loadVimeoThumbnail: true,
			exThumbImage: 'data-exthumbimage',
			vimeoThumbSize: 'thumbnail_medium',
		    youtubePlayerParams: {
		        //modestbranding: 1,
		        //showinfo: 0,
		        rel: 0,
		    },
			vimeoPlayerParams: {
				/* title : 1, */
				byline : 0,
				portrait : 0
				/* color : 'A90707', */
			}
		});



<?php /*
		$(".vimeo-youtube-video-gallerys").lightGallery({
			fullScreen: false,
			controls: true,
			autoplayControls: false,
			zoom: false,
			download: false,
			loadYoutubeThumbnail: true,
			youtubeThumbSize: 'default',
			loadVimeoThumbnail: true,
			exThumbImage: 'src',
			vimeoThumbSize: 'thumbnail_medium',
			vimeoPlayerParams: {
				// title : 1,
				byline : 0,
				portrait : 0
				// color : 'A90707'
			}
		});
*/

?>
		$(".vimeo-youtube-video-gallery").lightGallery({
			fullScreen: false,
			controls: true,
			autoplayControls: false,
			zoom: false,
			download: false,
			loadYoutubeThumbnail: false,
			loadVimeoThumbnail: false,
			vimeoPlayerParams: {
				/* title : 1, */
				byline : 0,
				portrait : 0
				/* color : 'A90707', */
			}
		});

		$(".vimeo-youtube-video-gallery, .vimeo-video-gallery-public, .vimeo-video-gallery-private, .imageGallery, .html5gallery").on('onBeforeOpen.lg',function(event){
    		//alert('onBeforeOpen');
    		PauseAllVideosForModal();
		});
		$(".vimeo-youtube-video-gallery, .vimeo-video-gallery-public, .vimeo-video-gallery-private, .imageGallery, .html5gallery").on('onCloseAfter.lg',function(event){
    		//alert('onBeforeOpen');
    		PlayAllVideosForModal();
		});


		$('.VIexImage').each(function(){
			var $this  = this;
			$.getJSON('https://www.vimeo.com/api/v2/video/' + $this.id + '.json?callback=?', {format: "json"}, function(data) {
				//$('#'+$this.id + ' > img').attr('src', data[0].thumbnail_large);
				$('#'+$this.id + '.VIexImage').each(function() { $(this).find('img').attr('src', data[0].thumbnail_large) });
				//$('#'+$this.id + '.VIexImage').each(function() { $(this).find('div.yt-thumb').css('background-image', 'url('+data[0].thumbnail_large+')'); });
			});

		});

		<?php echo $galleryJSCode; ?>

		// Used to fixe foundations Equalizer columns in lightbox reveal modal
		$("[data-open]").click(function(e){
			var myID = $(this).attr("data-open");
			if(typeof myID !== 'undefined'){
				$(window).on(
					'open.zf.reveal', function () {
						new Foundation.Equalizer($("#"+myID+" .resize-do-to-reveal")).applyHeight();
						PauseAllVideosForModal();
					}
				);
				$(window).on(
					'closed.zf.reveal', function () {
						new Foundation.Equalizer($("#"+myID+" .resize-do-to-reveal")).destroy();
						PlayAllVideosForModal();
					}
				);
			};
		});

	});

</script>
