var pageNumber = 1;
var num = 3;
var number_click = 0;

function show_review(name_clinic) {
	var name_clinic_var = name_clinic;
	var ajax_url = ajax_review_params.ajax_url;
	var start_pageNumber = 0;
	 
	if(number_click > 0) {
		pageNumber = 1;
	}
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'show_review',
			num: 3,
			pageNumber: start_pageNumber,
			name_clinic: name_clinic_var
		},
		beforeSend: function ()
		{	
		},
		success: function(data)
		{
			jQuery('.single-posttype #showReview').html(data);
			number_click++ ;
			if (jQuery('#no_more_review').length){
				jQuery("#more_review").hide(); 
			} else {
				jQuery("#more_review").show();
			}
		},
		error: function()
		{
			jQuery('.single-posttype #showReview').html('<li>There has been an error</li>');
		}
	});		
}

function more_review(name_clinic){
	pageNumber = pageNumber+1;
	var name_clinic_var = name_clinic;
	var ajax_url = ajax_review_params.ajax_url;

	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'more_showreview',
			name_clinic: name_clinic_var,
			num: num,
			pageNumber: pageNumber
		},
		beforeSend: function ()
		{
		},
		success: function(data)
		{
			jQuery('.single-posttype #showReview').append(data);

			if (jQuery('#no_more_review').length){
				jQuery("#more_review").hide(); 
			} else {
				jQuery("#more_review").show();
			}
		},
		error: function()
		{
			jQuery('.single-posttype #showReview').html('<li>There has been an error</li>');
		}
	});		

}