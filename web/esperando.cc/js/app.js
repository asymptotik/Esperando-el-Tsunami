$(document).ready(function() {

	var things = $('.best-things li');
	
	$(window).scroll(function() {		
		var offset = window.pageYOffset;

		$('.thing-one').css({
			"background-position" : "40% "+ (0 - (offset / 4))+"px"
		});
		$('.thing-two').css({
			"background-position" : "40% "+ (300 -(offset / 4))+"px"
		});
		$('.thing-three').css({
			"background-position" : "40% "+ (600 - (offset / 4))+"px"
		});
		$('.thing-four').css({
			"background-position" : "40% "+ (900 -(offset / 4))+"px"
		});
		$('.thing-five').css({
			"background-position" : "40% "+ (1200 - (offset / 4))+"px"
		});
		$('.thing-six').css({
			"background-position" : "40% "+ (1500 -(offset / 4))+"px"
		});
		$('.thing-seven').css({
			"background-position" : "40% "+ (1600 -(offset / 4))+"px"
		});
		$('.thing-eight').css({
			"background-position" : "40% "+ (1800 -(offset / 4))+"px"
		});		
	});
});


$(window).load(function() {
	$('.loading').animate({"top" : "100%"});
});


