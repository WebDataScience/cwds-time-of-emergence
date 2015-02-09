/**
 * Share modals
 * for blog posts
 */
(function ($, window, document, undefined) {

	'use strict';

	// Plugin definition
	// =========================================================================
	$.coenvshare = function ( options, element ) {
		this.options = options;
		this.element = $(element);

		this._create( options );
	};

	$.coenvshare.settings = {};

	// Create
	// =========================================================================
	$.coenvshare.prototype._create = function ( options ) {

		// set options
		this.options = $.extend(true, {}, $.coenvshare.settings, options);

		// initialize
		this._init();

	};

	// Initialize
	// =========================================================================
	$.coenvshare.prototype._init = function () {

		this.articleID = this.element.attr('data-article-id');
		this.articleTitle = this.element.attr('data-article-title');
		this.articleShortLink = this.element.attr('data-article-shortlink');
		this.articlePermalink = this.element.attr('data-article-permalink');

		// show share button
		// must have data-article-id set
		if (
			typeof( this.articleID ) !== 'undefined' &&
			typeof( this.articleTitle ) !== 'undefined' &&
			typeof( this.articleShortLink ) !== 'undefined' &&
			typeof( this.articlePermalink ) !== 'undefined' ) {
			this.element.addClass('active');
		} else {
			return;
		}

		// build modal
		this._buildModal();

		// handle interactions
		this._interactions();
	};

	/**
	 * Build modal
	 * Building DOM elements here to keep things quick and simple, but this should really be in a template
	 */
	$.coenvshare.prototype._buildModal = function () {

		var services = [
			{
				name: 'Twitter',
				className: 'social-twitter',
				url: 'http://twitter.com/home?status=' + this.articleTitle + ' ' + this.articleShortLink + ' from @UW_CoEnv" target="_blank'
			},
			{
				name: 'Facebook',
				className: 'social-facebook',
				url: 'http://www.facebook.com/sharer/sharer.php?s=100&p[url]=' + this.articleShortLink + '&p[images][0]=&p[title]=' + this.articleTitle + ' from UW College of the Environment" target="_blank'
			},
			{
				name: 'Email',
				className: 'mail',
				url: 'mailto:?subject=' + this.articleTitle + '&body=Check%20out%20this%20article%20from%20the%20UW%20College%20of%20the%20Environment:%20' + this.articleShortLink
			}
		];

		this.$modal = $('<div class="share-modal" role="dialog" aria-labelledby="shareModal" aria-hidden="true"></div>');
		this.$modal.append('<div class="share-modal-inner"><ul class="share-modal-content"></ul></div>');

		for ( var i = 0, len = services.length; i < len; i++ ) {
			this.$modal.find('.share-modal-content').append('<a href="' + services[ i ].url + '" ><li class="social-link share-' + services[ i ].className + '"><i class="fi-' + services[ i ].className + '"></i></li></a>');
		}
	};

	/**
	 * Handle interactions
	 */
	$.coenvshare.prototype._interactions = function () {
		var _this = this;

		// clicking on link
		this.element.on( 'click', function ( ev ) {
			ev.preventDefault();
			ev.stopPropagation();
			if ( _this.modalIsActive !== true ) {
				_this._launchModal();
			} else {
				_this._hideModal();
			}
		} );

		// clicking outside of modal
		$('body').on( 'click', function ( ev ) {
			if ( _this.modalIsActive === true ) {

				if ( !$(ev.target).is('.social-link') ) {
					_this._hideModal();
				}
			}
		});

	};

	/**
	 * Launch share modal
	 */
	$.coenvshare.prototype._launchModal = function () {
		var _this = this;

		// append modal
		$('.post-' + this.articleID).prepend( this.$modal );
        
		// show modal
		this.$modal.addClass('active');

		this.modalIsActive = true;

		setTimeout( function () {
			_this.$modal.addClass('active-visible');
		}, 10 );
	};

	/**
	 * Hide modal
	 */
	$.coenvshare.prototype._hideModal = function () {
		var _this = this;

		this.$modal.removeClass('active-visible');

		//setTimeout( function () {
		_this.$modal.removeClass('active');
		_this.$modal.remove();
		_this.modalIsActive = false;
		//}, 10 );

	};

	// Plugin bridge
	// =========================================================================
	// Leverages data method to either create or return plugin constructor
	//
	// Pattern developed by desandro for Masonry
	//		https://github.com/desandro/masonry/blob/master/jquery.masonry.js
	// Based off of jQuery UI's widget factory
	//		https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
	// And a bit from jcarousel
	//		https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js

	$.coenvshare.prototype.option = function( key ){
		if ( $.isPlainObject( key ) ){
			this.options = $.extend(true, this.options, key);
		}
	};

	$.fn.coenvshare = function( options ) {
		if ( typeof options === 'string' ) {
			// call method
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
				var instance = $.data( this, 'coenvshare' );
				if ( !instance ) {
					console.log( 'error', 'cannot call methods on coenvshare prior to initialization; ' +
						'attempted to call method "' + options + '"' );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
					console.log( 'error', 'no such method "' + options + '" for coenvshare instance' );
					return;
				}

				// apply method
				instance[ options ].apply( instance, args );
			});
		} else {
			this.each(function() {
				var instance = $.data( this, 'coenvshare' );
				if ( instance ){
					// apply options & init
					instance.option( options || {} );
					instance._init();
				} else {
					// initialize new instance
					$.data( this, 'coenvshare', new $.coenvshare( options, this ) );
				}
			});
		}
		return this;
	};

})(jQuery, window, document);