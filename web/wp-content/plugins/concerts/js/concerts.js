$(document).ready(function() 
{		
	$("form").each(function() 
	{
		$(this).find(".initialValue").each(function() 
				{
			$val = $(this).attr('alt');
			$(this).watermark($val, {useNative: false});
		});
		
		$(this).submit(function() 
		{
			var error = false;
			
			$("input.required,select.required").each(function() 
			{
				if($(this).val()=="") 
				{
					error = true;
				}
			});
			
			if(error) 
			{
				alert("Please fill in all fields marked as required");
			}
			else
			{
				$(this).submit();
			}
			
			return false;
		});
	});
});