/*************************************
@@File: Job Stock  Template Custom Js

All custom js files contents are below
**************************************
* 00. Loader
* 01. Company Brand Carousel
* 02. Client Story testimonial
* 03. Bootstrap wysihtml5 editor
* 04 Grid Slider
* 05 Grid Slider 2
* 06. Tab Js
* 07. Add field Script
* 08 Add Field
* 09 Background Image
* 10 City Select
* 11 Styles
**************************************/

(function($){
"use strict";


	
	/*---Tab Js --*/
	$("#simple-design-tab a").on('click', function(e){
		e.preventDefault();
		$(this).tab('show');
	});
	

	/*--- Client Story testimonial --*/
	$("#client-testimonial-slider").owlCarousel({
		items:3,
		itemsDesktop:[1180,3],
		itemsDesktopSmall:[979,2],
		itemsTablet:[768,1],
		pagination: false,
		navigation:true,
		navigationText:["",""],
		autoPlay:true
	});


})(jQuery);