jQuery( document ).ready(function() {
	/*if (jQuery('#postClinicSection .article-post ').length) { //#postClinic-container
		infohub_county('all');
		display_btncounty('all');
	}
	if (jQuery('#postClinicSection .article-post #post-found').length) {
		infohub_countcounty('all');
	}
	if (jQuery('#postClinicSection #filter_tre').length) {
		infohub_leftbar('all');
	}
	*/	
});

var pageNumber = 1;
var ppp = 6;
var number_click = 0;

function infohub_send(category){
	var category_value = category;
	infohub_county(category_value);
	display_btncounty(category_value);
	infohub_countcounty(category_value);
	infohub_leftbar(category_value,'all');
}

function infohub_sendTre(treatment , category ){
	var treatment_value = treatment;
	var category_value  = category;
	infohub_tre(treatment_value, category_value);
	display_btntre(treatment_value, category_value);
	infohub_countTre(treatment_value, category_value)
}

function infohub_county(category) {
	var category_value = category;
	var ajax_url = ajax_infohub_params.ajax_url;
	var start_pageNumber = 0
	
	if(number_click > 0) {
		pageNumber = 1
	}
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'infohub_county',
			articles_cate: category_value,
			ppp: 6,
			pageNumber: start_pageNumber
		},
		beforeSend: function ()
		{	
		},
		success: function(data)
		{
			jQuery("#loadPage").show(0).delay(500).hide(0);
			jQuery('#postClinicSection .article-post #postClinic-container').html(data).hide(0).delay(500).show(0);
			number_click++ ;
			if (jQuery('#no_more_infohub').length){
				jQuery("#more_articles").hide(); 
			} else {
				jQuery("#more_articles").show();
			}

		},
		error: function()
		{
			jQuery('#postClinicSection .article-post  .row').html('<p>There has been an error</p>');
		}
	});		
}

function more_infohubcounty(category) {
	pageNumber = pageNumber+1;;
	var category_value = category;
	var ajax_url = ajax_infohub_params.ajax_url;
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'more_infohubcounty',
			articles_cate: category_value,
			ppp: ppp,
			pageNumber: pageNumber
		},
		beforeSend: function ()
		{
		},
		success: function(data)
		{
			jQuery('#postClinicSection .article-post #postClinic-container').append(data);

			if (jQuery('#no_more_infohub').length){
				jQuery("#more_articles").hide(); 
			} else {
				jQuery("#more_articles").show();
			}
		},
		error: function()
		{
			jQuery('#postClinicSection .article-post .row').html('<p>There has been an error</p>');
		}
	});		
}

function display_btncounty(category){
	var category_value = category;
	var ajax_url = ajax_infohub_params.ajax_url;
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'display_btncounty',
			articles_cate: category_value,
		},
		success: function(data)
		{
			jQuery('#postClinicSection .article-post #postClinic-moreBtn').html(data).hide(0).delay(500).show(0);
		}
	});	
}

function infohub_countcounty(category){
	var category_value = category;
	var ajax_url = ajax_infohub_params.ajax_url;
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'infohub_countcounty',
			articles_cate: category_value,
		},
		beforeSend: function ()
		{
		},
		success: function(data)
		{
			jQuery("#post-found").addClass("post-found");
			jQuery('#postClinicSection .article-post #post-found').html(data).hide(0).delay(500).show(0);
		},
		error: function()
		{
		}
	});	
}

function infohub_leftbar(category,varcheck){
	var category_value = category;
	var varcheck_var = varcheck;
	var ajax_url = ajax_infohub_params.ajax_url;
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'infohub_leftbar',
			varcheck: varcheck_var,
			articles_cate: category_value
		},
		beforeSend: function ()
		{
		},
		success: function(data)
		{
			jQuery('#postClinicSection #filter_tre').html(data);
		},
		error: function()
		{
		}
	});	
}


function infohub_tre( treatment , category ){
	var category_value  = category;
	var treatment_value = treatment;
	var ajax_url = ajax_infohub_params.ajax_url;
	var start_pageNumber = 0;
	
	if(number_click > 0) {
		pageNumber = 1;
	}
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'infohub_tre',
			articles_cate: category_value,
			treatment_cate: treatment_value,
			ppp: 6,
			pageNumber: start_pageNumber
		},
		success: function(data)
		{

			jQuery("#loadPage").show(0).delay(500).hide(0);
			jQuery('#postClinicSection .article-post #postClinic-container').html(data).hide(0).delay(500).show(0);
			jQuery('#more_articles').hide();
    		jQuery(".valaud").hide();
			number_click++ ;
			if (jQuery('#no_more_infohubTre').length){
				jQuery("#more_articlesTre").hide(); 
			} else {
				jQuery("#more_articlesTre").show();
			}
		},
		error: function()
		{
			jQuery('#postClinicSection .article-post .row').html('<h4>There has been an error</h4>');
		}
	});	
}

function more_infohubTre(treatment , category ){
	pageNumber = pageNumber+1;;
	var treatment_value = treatment;
	var category_value = category;
	var ajax_url = ajax_infohub_params.ajax_url;
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'more_infohubTre',
			articles_cate: category_value,
			treatment_cate: treatment_value,
			ppp: ppp,
			pageNumber: pageNumber
		},
		beforeSend: function ()
		{
		},
		success: function(data)
		{
			jQuery('#postClinicSection .article-post #postClinic-container').append(data);
			jQuery(".valaud").hide();

			if (jQuery('#no_more_infohubTre').length){
				jQuery("#more_articlesTre").hide(); 
			} else {
				jQuery("#more_articlesTre").show();
			}
		},
		error: function()
		{
			jQuery('#postClinicSection .article-post .row').html('<p>There has been an error</p>');
		}
	});		
}

function display_btntre(treatment , category){
	var category_value = category;
	var treatment_value = treatment;
	var ajax_url = ajax_infohub_params.ajax_url;
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'display_btntre',
			articles_cate: category_value,
			treatment_cate: treatment_value,
		},
		success: function(data)
		{
			jQuery('#postClinicSection .article-post #postClinic-moreBtn').html(data).hide(0).delay(500).show(0);
		}
	});	
}

function infohub_countTre(treatment , category){
	var category_value = category;
	var treatment_value = treatment;
	var ajax_url = ajax_infohub_params.ajax_url;
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'infohub_countTre',
			articles_cate: category_value,
			treatment_cate: treatment_value,
		},
		success: function(data)
		{
			jQuery("#post-found").addClass("post-found");
			jQuery('#postClinicSection .article-post #post-found').html(data).hide(0).delay(500).show(0);
		}
	});	
}