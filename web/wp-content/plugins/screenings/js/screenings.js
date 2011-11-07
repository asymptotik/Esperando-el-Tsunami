var lc_screenings = 
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
			jQuery("#screening_form").submit();
		}
	},
	submit_form: function(form)
	{
		jQuery("#" + form).submit();
		return false;
	}
};

(function($) {
	$(document).ready(function() {
	

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
			}, "Please specify time in the correct format (ex 18:00).");
		
		lc_screenings.lc_validate = $("#screening_form").validate({ 
			errorPlacement: function(error, element) {
				var id = element.attr('id');
			    error.appendTo( element.closest("tr").find("label[for=" + id + "]").append(" ") );
			}
		});
	});
})(jQuery);
