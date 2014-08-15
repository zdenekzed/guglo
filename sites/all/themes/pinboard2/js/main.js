(function ($) { 
$(document).ready(function() {



	$(".pin_box .inbox").mouseover(function() {
		if (!$(this).hasClass("active")) {
			$(".pin_box .inbox").removeClass("active");
			$(this).addClass("active");
			$(".pin_box .inbox .action").fadeOut();
			var activeTab = $(this).find(".action");
			$(activeTab).fadeIn();
		  return false;
		}
	});
	$(".pin_box .inbox").mouseleave(function() {
		if ($(this).hasClass("active")) {
			$(".pin_box .inbox").removeClass("active");
			$(".pin_box .inbox .action").fadeOut();
		  return false;
		}
	});

});
})(jQuery);