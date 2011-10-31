$(document).ready(function() {
		
	$(".initialValue").each(function() {
		$val = $(this).attr('alt');
		$(this).watermark($val, {useNative: false});
	});

});