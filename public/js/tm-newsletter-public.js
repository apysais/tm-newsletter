(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $(window).load(function(){

		 function remove_nav_active() {
			 var _nav_a = $('.category-news-filter .nav li a.active');
			 _nav_a.removeClass('active');
		 }

		 function getQueryParam(url, key) {
		  var queryStartPos = url.indexOf('?');
		  if (queryStartPos === -1) {
		    return;
		  }
		  var params = url.substring(queryStartPos + 1).split('&');
		  for (var i = 0; i < params.length; i++) {
		    var pairs = params[i].split('=');
		    if (decodeURIComponent(pairs.shift()) == key) {
		      return decodeURIComponent(pairs.join('='));
		    }
		  }
		}

		function wp_pagenavi_first() {
			$(document).on('click', '.post-type-archive-news .wp-pagenavi .first', function(e){
				e.preventDefault();
				var _this = $(this);
				var paged = 1;
				var cat_id = $('.cat_id').val();
				var cat_slug = $('.cat_slug').val();
				var _over_lay = $('#overlay');

				_over_lay.show();

				ajax_get_cat_news(paged, cat_id, cat_slug);

			});
		}
		wp_pagenavi_first();

		function wp_pagenavi_last() {
			$(document).on('click', '.post-type-archive-news .wp-pagenavi .last', function(e){
				e.preventDefault();
				var _this = $(this);
				var _this = $(this);
				var _href = _this.attr('href');
				var _paged = 1;

				var _get_paged = getQueryParam(_href, 'paged');
				var _get_page = _href.split('/');

				var _news_container = $('.news-container');
				var _over_lay = $('#overlay');

				_over_lay.show();

				if( typeof _get_paged === 'undefined' ) {
					_paged = _get_page[_get_page.length - 2];
				} else {
					_paged = _get_paged;
				}

				var cat_id = $('.cat_id').val();
				var cat_slug = $('.cat_slug').val();

				ajax_get_cat_news(_paged, cat_id, cat_slug);

			});
		}
		wp_pagenavi_last();


		function wp_pagenavi_previous() {
			$(document).on('click', '.post-type-archive-news .wp-pagenavi .previouspostslink', function(e){
				e.preventDefault();
				var _this = $(this);
				var paged = $('.paged').val();
				var cat_id = $('.cat_id').val();
				var cat_slug = $('.cat_slug').val();
				var previous = (paged - 1);

				ajax_get_cat_news(previous, cat_id, cat_slug);

			});
		}
		wp_pagenavi_previous();

		function wp_pagenavi_next() {
			 $(document).on('click', '.post-type-archive-news .wp-pagenavi .nextpostslink', function(e){
				 e.preventDefault();
				 var _this = $(this);
				 var _href = _this.attr('href');
				 var _paged = 1;

				 var _get_paged = getQueryParam(_href, 'paged');
				 var _get_page = _href.split('/');

				 var _news_container = $('.news-container');
				 var _over_lay = $('#overlay');

				 _over_lay.show();

				 if( typeof _get_paged === 'undefined' ) {
					 _paged = _get_page[_get_page.length - 2];
				 } else {
					 _paged = _get_paged;
				 }

				 var cat_id = $('.cat_id').val();
				 var cat_slug = $('.cat_slug').val();

				 ajax_get_cat_news(_paged, cat_id, cat_slug);

			 });
		 }
		 wp_pagenavi_next();

		 function wp_pagenavi_ajax() {
			 $(document).on('click', '.post-type-archive-news .wp-pagenavi .page', function(e){
				 e.preventDefault();
				 var _news_container = $('.news-container');
				 var _over_lay = $('#overlay');

				 _over_lay.show();

				 var _this = $(this);
				 var _link_text = _this.text();
				 var _paged = $('.paged').val();
				 var cat_id = $('.cat_id').val();
				 var cat_slug = $('.cat_slug').val();

				 ajax_get_cat_news(_link_text, cat_id, cat_slug);

			 });
		 }
		 wp_pagenavi_ajax();

		 function ajax_get_cat_news( paged, cat_id, cat_slug) {
			 var _news_container = $('.news-container');
			 var _over_lay = $('#overlay');

			 var _data = {
				 action : 'tnl_get_category',
				 paged: paged,
				 cat_id : cat_id,
				 cat_slug : cat_slug,
			 };

			 var request = $.ajax({
				 url: tnl.ajax_url,
				 method: "POST",
				 data: _data,
				 dataType: "html"
			 });

			 request.done(function( msg ) {
				 _news_container.html(msg);
				 _over_lay.hide();
			 });

		 }

		 function get_news_category() {
			 var _news_cat = $('.get-news-category');

			 _news_cat.on('click', function(e){
				e.preventDefault();
				var _this = $(this);
				var _paged = 1;
				var _data_cat_id = _this.data('cat-id');
				var _data_cat_slug = _this.data('cat-slug');
				var _news_container = $('.news-container');
				var _over_lay = $('#overlay');

				var _hash = window.location.hash.substr(1);
				console.log(_hash);
				if ( _hash == '' ) {
					window.location.hash = '#';
				} else {
					window.location.hash = _data_cat_slug;
				}


				_over_lay.show();
				remove_nav_active();
				_this.addClass('active');

				ajax_get_cat_news(_paged, _data_cat_id, _data_cat_slug);

			 });
		 }

		 function get_news_category_dropdown() {
			 var _news_cat = $('.category-news');

			 _news_cat.on('change', function(e){
				e.preventDefault();
				var _this = $(this);
				var _data_cat_slug = _this.val();
				var _data_cat_id = _this.find(':selected').data('cat-id');
				var _news_container = $('.news-container');
				var _over_lay = $('#overlay');

				_over_lay.show();

				if ( typeof _data_cat_id == 'undefined' ) {
					_data_cat_id = 0;
				}

				var _data = {
					action : 'tnl_get_category',
					cat_id : _data_cat_id,
					cat_slug : _data_cat_slug,
				};

				var request = $.ajax({
					url: tnl.ajax_url,
					method: "POST",
					data: _data,
					dataType: "html"
				});

				request.done(function( msg ) {
				  //$( "#log" ).html( msg );
					///console.log(msg);
					_news_container.html(msg);
					_over_lay.hide();
				});

			 });
		 }

		 function trigger_url_news_cat() {
			var _hash = window.location.hash.substr(1);

			if ( _hash !== '' && _hash !== '' ) {
				console.log(_hash);

				var _over_lay = $('#overlay');

				_over_lay.show();
				remove_nav_active();
				$('.category-news-filter ul li').find('.' + _hash).addClass('active');

				ajax_get_cat_news( 1, 0, _hash);
			} else {

			}

		 }

		 get_news_category_dropdown();
		 get_news_category();
		 trigger_url_news_cat();
	 });

})( jQuery );
