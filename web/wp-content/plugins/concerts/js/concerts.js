var lc_concerts = 
{
	lc_validate:null,
	submit_host_form: function()
	{
		jQuery.watermark.hideAll();
		if(!this.lc_validate.form())
		{
			jQuery.watermark.showAll();
			alert("Please fix the invalid fields in red.");
		}
		else
		{
			jQuery("#concert_form").submit();
		}
	},
	submit_form: function(form)
	{
		jQuery("#" + form).submit();
		return false;
	},
	lc_select_region: function(region, reset)
	{
		$('.concert_venue_country_select').hide();
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
	},
	lc_select_schedule: function(schedule, reset)
	{
		if(schedule == -1)
		{
			$('#concert_date_wrapper').show();
		}
		else
		{
			$('#concert_date_wrapper').hide().val('');
		}
	}
};

(function($) {
	$(document).ready(function() 
	{
		$(".initialValue").each(function() {
			$val = $(this).attr('alt');
			$(this).watermark($val, {useNative: false});
		});
		
		$('.event-more').click(function(){
			var item = $(this).attr('id');
			item = '#' + item.substring(1);
			$(this).closest('li').find(item).toggle(300);
		});
	
		$.validator.addMethod("time", function(value, element) { 
			  return this.optional(element) || /^([0-9]|[0-1][0-9]|2[0-3])[:][0-5][0-9]$/.test(value); 
			}, "Please specify a correct time.");
		
		lc_concerts.lc_validate = $("#concert_form").validate({ 
			errorPlacement: function(error, element) {
				var id = element.attr('id');
			    error.appendTo( element.closest("tr").find("label[for=" + id + "]").append(" ") );
			}
		});
		
		var val = $('#concert_venue_region_id option:selected').val();
	    if(undefined != val)
	    {
	    	lc_concerts.lc_select_region(val, false);
	    }
	
	    $('#concert_venue_region_id').change(function() {
	    	var val = $('#concert_venue_region_id option:selected').val();
	    	lc_concerts.lc_select_region(val, true);
	    });
	    
	    $('#concert_region_schedule_id').change(function() {
	    	var val = $('#concert_region_schedule_id option:selected').val();
	    	lc_concerts.lc_select_schedule(val, true);
	    });
	});
})(jQuery);




