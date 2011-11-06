/**
 * 
 */

(function($) {
	
	$.lc_select_region = function(region, reset)
	{
		$('.concert_venue_country_select').hide();
		$('.concert_region_schedule_select').hide();
		
		if(region == 0)
		{
			$('#concert_venue_country').hide().val('');
		}
		else if($('#concert_venue_country_' + region).length > 0)
		{
			if(reset)
				$('#concert_venue_country_' + region).show().val('0');
			else
				$('#concert_venue_country_' + region).show();
			$('#concert_venue_country').hide().val('');
		}
		else
		{
			$('#concert_venue_country').show();
		}
		
		if(reset)
			$('#concert_region_schedule_' + region).show().val('0');
		else
			$('#concert_region_schedule_' + region).show();
	};
	
	$(document).ready( function() {
		var val = $('#concert_venue_region_id option:selected').val();
	    if(undefined != val)
	    {
	    	$.lc_select_region(val, false);
	    }

	    $('#concert_venue_region_id').change(function() {
	    	var val = $('#concert_venue_region_id option:selected').val();
	    	$.lc_select_region(val, true);
	    });
	});
})(jQuery);




