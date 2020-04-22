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

		 function get_news_category() {
			 var _news_cat = $('.get-news-category');

			 _news_cat.on('click', function(e){
				e.preventDefault();
				var _this = $(this);
				var _data_cat_id = _this.data('cat-id');
				var _data_cat_slug = _this.data('cat-slug');
				var _news_container = $('.news-container');
				var _over_lay = $('#overlay');

				_over_lay.show();
				remove_nav_active();
				_this.addClass('active');

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
					//console.log(msg);
					_news_container.html(msg);
					_over_lay.hide();
				});

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
				console.log(_data);
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
		 get_news_category_dropdown();
		 get_news_category();
	 });

})( jQuery );
