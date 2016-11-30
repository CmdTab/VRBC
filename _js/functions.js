function thirdsHeight() {
	var contHeight = jQuery('.home-thirds-content').height();
	jQuery('.home-thirds-content .third-section').css('height', contHeight);
}
function dropDown() {
	jQuery('.menu-item-has-children > a').click(function() {
		if(jQuery(this).hasClass('expand')) {
			jQuery(this).removeClass('expand');
			jQuery(this).next('.sub-menu').slideUp();
		} else {
			jQuery('.sub-menu').slideUp();
			jQuery('.menu-item-has-children > a').removeClass('expand');
			jQuery(this).addClass('expand');
			jQuery(this).next('.sub-menu').slideToggle();
		}
		return false;
	});
}
function contentHeight() {
	var sh = jQuery('.sidebar').outerHeight();
	var ph = jQuery('.primary').outerHeight();
	if(sh > ph) {
		jQuery('.primary').css('height',sh);
	}
}
function toggleNav() {
	jQuery('.toggle-nav').click(function() {
		jQuery('body').toggleClass('show-nav');
		if(jQuery('body').hasClass('show-nav')) {
			jQuery('.toggle-nav').html('Close');
		} else {
			jQuery('.toggle-nav').html('Menu');
		}
		return false;
	});
}

function toggleSearch() {
	jQuery( '#search-icon' ).click(function() {
		jQuery( '.search-box' ).css( 'display', 'block' );
		jQuery( '#search-icon' ).css( 'display', 'none' );
		jQuery( '.search-box' ).slideDown( 'slow' );
		jQuery( '.search-field').focus();
	});
}

function videoToggle () {
	jQuery( '.watch-trigger' ).click(function() {
		jQuery( this ).parent().siblings( '.watch' ).slideDown( 'slow' );
		return false;
	});
}

function audioToggle () {
	jQuery( '.listen-trigger' ).click(function() {
		jQuery( this ).parent().siblings( '.listen' ).slideDown( 'slow' );
		return false;
	});
}

function worshipToggle () {
	jQuery( '.worship-trigger' ).click(function() {
		jQuery( this ).parent().siblings( '.worship' ).slideDown( 'slow' );
		return false;
	});
}

function matchHeight () {
	jQuery('.event-list li').matchHeight();
}

function serviceToggle () {
	jQuery( '.service-cat .btn' ).click(function() {
		jQuery(this).parent('.service-cat').toggleClass('show');
		return false;
	});
}

function serviceContact () {
	jQuery( '.contact-form-trigger' ).click(function() {
		jQuery('.contact-form-container').toggleClass('show');
		return false;
	});
	jQuery( '.serve-contact-form .icon-close' ).click(function() {
		jQuery('.contact-form-container').removeClass('show');
		return false;
	});
}

jQuery(document).ready(function() {
	jQuery('.carousel').carousel();
	dropDown();
	toggleNav();
	toggleSearch();
	audioToggle();
	videoToggle();
	worshipToggle();
	matchHeight();
	serviceToggle();
	serviceContact();
	jQuery(".sermon-video").fitVids();
});

jQuery(window).load(function() {
	var vw = jQuery(window).width();
	if (vw > 800) {
		thirdsHeight();
		contentHeight();
	}
});

jQuery(window).resize(function() {
});