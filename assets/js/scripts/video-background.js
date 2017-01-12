//Playlist info
var playerInfoList = [];

//search for each possible video
$('.video-wrapper').each(function(){

			// each video .screen must have an ID to work
			var domIDforVideo = $(this).children('.tv').children('.screen').attr('id');
			var videoID  = $(this).data("video-id");
			var videoYouTubeLink = $(this).data("video-youtube-link");

			playerInfoList.push({
			  id: domIDforVideo ,
			  videoId: videoID ,
			  muteVideo: true,
			  videoStart: $(this).data("video-start") ,
			  videoEnd: $(this).data("video-end") ,
			  videoWidthAdd: $(this).data("video-width-add") ,
			  videoHeightAdd: $(this).data("video-height-add")
			  });

			if (videoYouTubeLink === 'y') {
				$(this).prepend('<a href="https://www.youtube.com/watch?v=' + videoID + '" class="video-expand" target="_blank">View on Youtube</a>');
			}
});



// This code loads the IFrame Player API code asynchronously.

var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// This function creates an <iframe> (and YouTube player) after the API code downloads.

window.players = new Array();

function onYouTubeIframeAPIReady() {
	if (typeof playerInfoList === 'undefined') return;

    for (var i = 0; i < playerInfoList.length; i++) {
        var curplayer = createPlayer(playerInfoList[i]);
        window.players[i] = curplayer;
    }
}


// lets build the players

function createPlayer(playerInfo) {
    return new YT.Player(playerInfo.id, {
        videoId: playerInfo.videoId,
        videoWidthAdd: playerInfo.videoWidthAdd,
        videoHeightAdd: playerInfo.videoHeightAdd,
		playerVars: {
		'autoplay': 0,
		'autohide': 1,
		'end': 0,
		'loop': 1,
		'modestbranding': 1,
		'rel': 0,
		'showinfo': 0,
		'controls': 0,
		'disablekb': 1,
		'enablejsapi': 0,
		'iv_load_policy': 3,
		'videoStart' : playerInfo.videoStart,
		'end' : playerInfo.videoEnd
	},
	events: {
		'onReady': onPlayerReady,
		'onStateChange': onPlayerStateChange
	}
    });
}





// 4. The API will call this function when the video player is ready.
function onPlayerReady(e) {
	vidRescale();
	// this can be recoded to handle a mute option
	e.target.mute();
	for (var i = 0; i < playerInfoList.length; i++) {
		  if (playerInfoList[i].id == e['target']['h']['id']) {
		  videoStart = playerInfoList[i].videoStart;
		  //console.log(videoStart);
		  e.target.seekTo(videoStart);
		  e.target.playVideo()
		  break;
		  }
	  }
}

// 5. The API calls this function when the player's state changes.



function onPlayerStateChange(e) {
	//console.log(e['target']);
	playerToTarget = '#'+e['target']['h']['id'];
	if (e.data === 1){
		$(playerToTarget).addClass('active');
	} else if (e.data === 0){
		//console.log('waiting');
		for (var i = 0; i < playerInfoList.length; i++) {
			if (playerInfoList[i].id == e['target']['h']['id']) {
			videoStart = playerInfoList[i].videoStart;
			//console.log(videoStart);
			e.target.seekTo(videoStart);
			e.target.playVideo()
			break;
			}
		}
	}
}

// This function scales the video to window size and uses additional values to push video beyong window size

function vidRescale(){
	//console.log('video reloaded');
	for (var i = 0; i < playerInfoList.length; i++) {
		//console.log(playerInfoList[i].id);
		playerToTarget = '#'+ playerInfoList[i].id;
		//console.log(playerInfoList[i].videoWidthAdd);
		  var w = $(window).width() + playerInfoList[i].videoWidthAdd,
			  h = $(window).height() + playerInfoList[i].videoHeightAdd;
		  if (w/h > 16/9) {
			  window.players[i].setSize(w, w/16*9);
			  //$(playerToTarget).css({'left': '0px'});
			  $(playerToTarget).css({'left': '-50%'}); // Changed to 50% for cetner align
		  } else {
			  window.players[i].setSize(h/9*16, h);
			  $(playerToTarget).css({'left': -($(playerToTarget).outerWidth()-w)/2});
		  }
	}
}

// Reloads the video on load and resize

$(window).on('resize', function(){
	vidRescale();
});





$.fn.isOnScreen = function(){

    var win = $(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};



function YTIsOnScreenPlayOrPause(){
	for (i = 0; i < window.players.length; ++i) {


		myID = '#'+ window.players[i]['h']['id'];

		 if ($(myID).isOnScreen() == true) {
		   window.players[i].playVideo();
		 }
		else {
			console.log("not playing");
		  window.players[i].pauseVideo();
		 }
	}
}

$(document).ready(function(){
YTIsOnScreenPlayOrPause();
});

$(window).scroll(function() {
	YTIsOnScreenPlayOrPause();
});

