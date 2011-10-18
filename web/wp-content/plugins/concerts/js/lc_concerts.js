/**
 * 
 */

(function($) {
	
	$.lc_select_region = function(region, reset)
	{
		$('.country-select').hide();
		if(region == 0)
		{
			$('#concert_country').hide().val('');
		}
		else if($('#country-select-' + region).length > 0)
		{
			if(reset)
				$('#country-select-' + region).show().val('0');
			else
				$('#country-select-' + region).show();
			$('#concert_country').hide().val('');
		}
		else
		{
			$('#concert_country').show();
		}
	};
	
	$(document).ready( function() {
		var val = $('#concert-region-id option:selected').val();
	    if(undefined != val)
	    {
	    	$.lc_select_region(val, false);
	    }

	    $('#concert-region-id').change(function() {
	    	var val = $('#concert-region-id option:selected').val();
	    	$.lc_select_region(val, true);
	    });
	});
})(jQuery);




