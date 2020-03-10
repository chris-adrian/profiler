$(function() {
    
    $.customModalInit();
    navbarInit();

 });

function navbarInit() {
 	$(window).scroll(function() {
        if ($(this).scrollTop() >= 290) {
        	$('.nav-wrapper').css('height', $('.nav-wrapper').height()).addClass('stickytop');
        }
        else {
            $('.nav-wrapper').css('height', 'auto').removeClass('stickytop');
        }
    });
}

jQuery.customModalInit = function customModalInit() {
	var $currentForm;
	var $modal = $('#confirmModal');

	$('.verify-action').on('click', function(){
		$currentForm = $(this).closest('form');
    	$('body').on("click", "#confirmModal .accept", function() {
	 	 	$currentForm.submit();
	 	 	$currentForm = null;
	 	 	$modal.modal('toggle');
		});
     	$modal.find('.modal-body b').empty().append($(this).attr('action'))
    	$modal.modal('toggle');
    });
}

