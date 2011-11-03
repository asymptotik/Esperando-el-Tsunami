var lc_screeings = 
{
	lc_validate:null,
	submit_host_form: function()
	{
		$.watermark.hideAll();
		if(!this.lc_validate.form())
		{
			$.watermark.showAll();
			alert("Please fix the invalid fields in red.");
		}
		else
		{
			$("#host_screening").submit();
		}
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
	
		
		lc_screeings.lc_validate = $("#host_screening").validate({ 
			errorPlacement: function(error, element) {
				var id = element.attr('id');
			    error.appendTo( element.parent("td").children("label[for=" + id + "]").append(" ") );
			}
		});
	});
})(jQuery);
