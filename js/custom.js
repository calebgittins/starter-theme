(function($) {
// Selectric
	function initSelectric() {
		$('.gform_wrapper select, .product select, .woocommerce-ordering select').selectric({
			disableOnMobile: false,
			nativeOnMobile: false,
			responsive: true,
			maxHeight: 264
		});
	}
	initSelectric();
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
		$(this).prev('.default-spinner').fadeOut().remove();
	});
// Toggle offscreen menu
	$('.js-nav-toggle').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('is-active');
		$('.offscreen').toggleClass('offscreen--active');
		$('body').toggleClass('body--offscreen-active');
	});
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
		tLoading: '<div class="default-spinner"></div>',
	});
// Equal Heights
	$('.js-match-height').matchHeight();
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
			$(element).prev('.default-spinner').fadeOut().remove();
		}
	});
// Gravity Forms
	$(document).bind('gform_post_render', function() {
		selectricGforms();
	});
// WooCommerce
	function customWooFields() {
		$('.woocommerce-shipping-methods label, .wc_payment_methods label, .woocommerce-terms-and-conditions-wrapper label, .custom-checkbox label').append('<span class="custom-input"></span>');	
	}

	customWooFields();

	$('body').on('updated_shipping_method country_to_state_changed updated_wc_div init_checkout updated_checkout', function(){
	    customWooFields();
	});
})( jQuery );