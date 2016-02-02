function verifyPrivacy() {
	jQuery('#rcp_privacy').change(function() {
		if(jQuery(this).is(':checked')) {
			jQuery('#rcp_submit').prop('disabled', false);
		} else {
			jQuery('#rcp_submit').prop('disabled', true);
		}
	});
}

function navToggle() {
	jQuery('.nav-toggle').click(function () {
		jQuery('body').toggleClass('show-nav');
		var secureNavHeight = jQuery('.main-navigation').outerHeight() + jQuery('.user-info').outerHeight();
		jQuery('.secure-side').css('top',secureNavHeight);
		return false;
	});
}
function videoOverlay() {
	var videoCode = '<iframe src="//player.vimeo.com/video/62298065?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" width="650" height="366" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	jQuery('#watch').click(function () {
		jQuery('.overlay .video').html(videoCode);
		jQuery(".video").fitVids();
		jQuery('.overlay').addClass('show-overlay');
		return false;
	});
	jQuery('#close').click(function () {
		jQuery('.overlay .video').html('');
		jQuery('.overlay').removeClass('show-overlay');
		return false;
	});
	jQuery('.overlay').click(function() {
		jQuery('.overlay .video').html('');
		jQuery('.overlay').removeClass('show-overlay');
	});
	jQuery('.overlay-container').click(function() {
		event.stopPropagation();
	});
}
function playMedia() {
	jQuery('.action-required').click(function() {
		var mediaType = jQuery(this).data('type');
		if(mediaType !== undefined){
			if(mediaType === "audio") {
				var audioURL = jQuery(this).data('code');
				var audioEmbed = '<audio src="' + audioURL + '" type="audio/mp3" controls="controls" autoplay>';
				if (jQuery(this).hasClass('btn')) {
					jQuery(this).parent('.content-action').nextAll('.content-player').slideDown();
					jQuery(this).parent('.content-action').nextAll('.content-player').html(audioEmbed);
				}
				jQuery('audio').mediaelementplayer();
			} else if(mediaType === "video") {
				var videoURL = jQuery(this).data('code');
				var videoEmbed = '<iframe src="//player.vimeo.com/video/' + videoURL + '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" width="650" height="366" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				jQuery('.overlay .video').html(videoEmbed);
				jQuery(".video").fitVids();
				jQuery('.overlay').addClass('show-overlay');
			}
		}
		return false;
	});
}
function btnCount() {
	jQuery('.content-action').each(function() {
		var count = jQuery(this).find('.btn').length;
		if (count == 2) {
			jQuery(this).addClass('two');
		}
		if (count == 3) {
			jQuery(this).addClass('three');
		}
	});
}
function subnavToggle() {
	jQuery('.subnav-toggle').click(function() {
		if(jQuery('.sub-navigation').hasClass('show')) {
			jQuery('.sub-navigation').slideUp();
			jQuery('.subnav-toggle').html('Pages in this Section');
			jQuery('.sub-navigation').removeClass('show');
		} else {
			jQuery('.sub-navigation').slideDown();
			jQuery('.subnav-toggle').html('Hide Pages');
			jQuery('.sub-navigation').addClass('show');
		}

		return false;
	});
}
function passwordToggle() {
	jQuery('.password-toggle').click(function() {
		if(jQuery(this).hasClass('show')) {
			jQuery(this).prev().attr('type','text');
			jQuery(this).removeClass('show');
			jQuery(this).html('Hide');
		} else {
			jQuery(this).prev().attr('type','password');
			jQuery(this).addClass('show');
			jQuery(this).html('Show');
		}
		return false;
	});

	jQuery('#rcp_user_pass').blur(function() {
		jQuery(this).attr('type','password');
		jQuery('.password-toggle').addClass('show');
		jQuery('.password-toggle').html('Show');
	});
}
function sidebarHeight() {
	var containerHeight = jQuery('.secure-page').outerHeight();
	jQuery('.secure-side').css('height',containerHeight);
}
function contentBlockHeight() {
	jQuery('.odd').each(function( index ) {
		var evenHeight = jQuery(this).next('.even').outerHeight();
		var oddHeight = jQuery(this).outerHeight();
		if (evenHeight > oddHeight) {
			jQuery(this).css('height',evenHeight);
			jQuery(this).next('.even').css('height',evenHeight);
		} else {
			jQuery(this).css('height',oddHeight);
			jQuery(this).next('.even').css('height',oddHeight);
		}
	});
}

jQuery(document).ready(function() {
	var vw = $(window).width();
	navToggle();
	jQuery(".video, .video-box").fitVids();
	videoOverlay();
	playMedia();
	jQuery('video, audio').mediaelementplayer({

	});
	btnCount();
	subnavToggle();
	passwordToggle();
	verifyPrivacy();
	if (vw > 800) {
		contentBlockHeight();
	}
});
jQuery(window).load(function() {
	var vw = $(window).width();
	if (vw >700) {
		sidebarHeight();
	}
});