(function($) {
// Selectric
	function selectricGforms() {
		$('.gform_wrapper select').selectric({
			disableOnMobile: false,
			nativeOnMobile: false,
			responsive: true,
			maxHeight: 264
		});
	}
	selectricGforms();
// Slick - Global settings
	var slick_previous = '<button class="slick-arrow--previous"><i class="fa fa-angle-left" aria-hidden="true"></i><span class="screen-reader-text">Previous</span></button>';
	var slick_next     = '<button class="slick-arrow--next"><i class="fa fa-angle-right" aria-hidden="true"></i><span class="screen-reader-text">Next</span></button>';
// Slick - Single Slide
	$('.js-slick-single').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		arrows: true,
		prevArrow: slick_previous,
		nextArrow: slick_next,
		dots: false,
		speed: 600,
		cssEase: 'ease-in-out',
		lazyLoad: 'ondemand'
	});
	$('.js-slick-single img').load(function() {
		$(this).addClass('slick-loaded');
		$(this).prev('.spinner').fadeOut().remove();
	});
// Toggle offscreen menu
	$('.js-nav-toggle').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('hamburger--active');
		$('.offscreen').toggleClass('offscreen--active');
		$('body').toggleClass('body--offscreen-active');
	});
// Superfish dropdown
	$('.nav--primary').superfish();
// Close nav on anchor click
	$('.offscreen a[href^="#"]').click(function (event) {
		$('.js-nav-toggle').trigger( "click" );
	});
// Smooth scroll for anchor links
	$('.js-link-anchor, .js-link-anchor a').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});
// Magnific Popup - Standard
	$('.js-magnific-popup').magnificPopup({
		type:'inline',
		closeBtnInside: true,
		closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
		midClick: true
	});
// Magnific Popup - Video
	$('.js-magnific-video').magnificPopup({
		type: 'inline',
		midClick: true,
		callbacks: {
			open: function() {
				// Play video on open
				$(this.content).find('video')[0].play();
				var p = $(this.content).find('video')[0].player;
				p.setPlayerSize();
				p.setControlsSize();
			},
			close: function() {
				// Reset video on close
				$(this.content).find('video')[0].load();
			}
		}
	});
// Magnific Popup - Ajax
	$('.js-magnific-ajax').magnificPopup({
		type: 'ajax',
		closeBtnInside: true,
		closeOnContentClick: false,
		closeOnBgClick: false,
		// removalDelay: 800, // Delay removal for animation
		tLoading: '<div class="spinner"></div>',
	});
// Infinite Scroll
	// Infinite Scroll - Settings
		$container = $('.js-infinite-parent');
		$container.infiniteScroll({
			path: '.nav--pagination a',
			append: '.js-infinite-item',
			history: false,
			checkLastPage: true,
			scrollThreshold: 200
		});
	// Infinite Scroll - Loaded
		$container.on( 'append.infiniteScroll', function( event, response, path, items ) {
			$('.js-match-height').matchHeight();
		});
	// Infinite Scroll - Last Page
		$container.on( 'last.infiniteScroll', function( event, response, path ) {
			$('.nav-pagination').fadeOut().remove();
		});
// Equal Heights
	$('.js-match-height').matchHeight();

	$('.gfield').matchHeight({
		property: 'min-height'
	});
// Sticky header
	var headerHeight = $('.header').outerHeight();
	if ($(window).scrollTop() >= headerHeight) {
		$('.header').addClass('header--sticky');
	}
	$(window).scroll(function() {
		var sticky = $('.header'),
			scroll = $(window).scrollTop();
		if (scroll >= headerHeight) sticky.addClass('header--sticky');
		else sticky.removeClass('header--sticky');
	});
// Accordion
	$('.accordion__item__content').hide(); // Close all accordions
	$('.js-accordion-toggle').click(function(e) {
		e.preventDefault();
		var accordion_id = $(this).data('target');
		if ($(this).parent().hasClass('accordion__item--active')) { // If the accordion is already open
			$('.accordion__item').removeClass('accordion__item--active');
			$('.accordion__item__content').slideUp();
			$(this).parent().removeClass('accordion__item--active');
			$('#' + accordion_id).slideUp();
		} else { // Else if the accordion is not open
			$('.accordion__item').removeClass('accordion__item--active');
			$('.accordion__item__content').slideUp();
			$(this).parent().addClass('accordion__item--active');
			$('#' + accordion_id).slideDown();
		}
	});
// Responsive videos
	$('.js-fitvids').fitVids();
// Lazy Loading images
	var bLazy = new Blazy({
		selector: '.b-lazy',
		loadInvisible: true,
		offset: 200,
		success: function(element){
			$(element).prev('.spinner').fadeOut().remove();
		}
	});
// Gravity Forms
	$(document).bind('gform_post_render', function() {
		selectricGforms();
	});
})( jQuery );