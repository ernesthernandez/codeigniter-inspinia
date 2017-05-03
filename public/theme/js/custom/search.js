jQuery(function ($) {

	$('#top-search').keypress(function (e)
	{
	  if (e.which == 13)
	  {
	  	var element = $(this).val();
	  	$(this).val('');
	  	search(element);
	    return false;    //<---- Add this line
	  }
	});

function search(val) 
{
	     $('#app-search').ajaxSubmit({
            url: 'search',
            dataType: 'json',
            cache: 'false',
            success: function(data)
            {
            	console.log(data);
            	//alert(1);
            },
            error: function(data)
            {
            	console.log(data);
            	//alert(2);
            }
        });
}
}); //END
