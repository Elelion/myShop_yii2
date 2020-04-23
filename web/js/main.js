/*price range*/

 $('#sl2').slider();

 /*
	* NOTE:
	* turning on the accordion
	* where a ('.catalog') is a class in ./views/site/index.php
	* <ul class="catalog">
	* */
 $('.catalog').dcAccordion({
	 speed: 300
 });

/* step-14_basket-part1 - BEGIN */
// $('.add-to-cart').on('click', function (e) {
	// NOTE: canceling the default event
// 	e.preventDefault();
//
// 	var id = $(this).data('id');
// 	$.ajax({
// 		url: '/cart/add',
// 		data: {id: id},
// 		type: 'GET',
// 		success: function (res) {
// 			console.log(res);
// 		},
// 		error: function () {
// 			alert('Error');
// 		}
// 	})
// });
/* step-14_basket-part1 - END */

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
