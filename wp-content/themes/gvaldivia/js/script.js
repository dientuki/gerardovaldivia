/* Author: 

*/

$(document).ready(function(){
	
	$('.thumbnail a').hover(
  	      function () { //mouseenter
  	    	  $(this).find('div').slideDown();
  	      }, 
  	      function () { //mouseleave
  	    	$(this).find('div').slideUp();
  	      }
  	    );	
	
	$('.thumbnail a').fancybox({
		'titleShow': false,
		'showCloseButton': true,
		'enableEscapeButton':true,
		'hideOnOverlayClick':false,
		'transitionIn':'elastic',
		'transitionOut':'elastic',
		'onStart': function() {
			$('.thumbnail a div').slideUp();
		}
	});
	
	$('#galleryview').galleryView({
		panel_width: 889,
		panel_height: 500,
		frame_width: 89,
		frame_height: 50,
		pause_on_hover: true
	});

	$('#galleryview div.panel').hover(
	  	      function () { //mouseenter
	  	    	  $(this).find('span').slideDown();
	  	      }, 
	  	      function () { //mouseleave
	  	    	$(this).find('span').slideUp();
	  	      }
	  	    );	
	
	
	$('html').addClass('js-finished');
});





















