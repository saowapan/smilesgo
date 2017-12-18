<?php 
function bookreview() {

	echo '<!doctype html>';
	echo '<html ';
	language_attributes();
	echo '>';
  	get_template_part('templates/head');
  	echo '<body ';
  	body_class();
  	echo '>';
  	do_action('get_header');
    get_template_part('templates/header');
    echo '<div class="wrap submit-review-page" role="document"><div class="content"><main class="main">';
    echo '<section class="container-fluid header-posttype"><div class="container"><div class="col-xs-12"><div class="row sub-menu">';
	echo '<span><a href="'.esc_url(home_url('/')).'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span class="text-capitalize"><a href="'.esc_url(home_url('/clinics/')).'"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span class="text-capitalize"><a href="'.esc_url(home_url('/clinic/'.strtolower(str_replace(" ","-",$_POST['name_clinic'])).'')).'"> '.$_POST['name_clinic'].'</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span>Write Review </span></div><h3 class="row">Write Review</h3></div></div></section>';
	echo '<div class="container" style=" padding-bottom: 40px;text-align: center;"><h1 style="font-weight: bold;">Thank You For Review '.$_POST['name_clinic'].'</h1>';
	echo '<h3>( Wait For Confirmation From SMILESGO )</h3></div>';
    echo '</main></div></div>';
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
  	echo '</body></html>';

	if (isset($_POST['submit'])){	

		$review = [];

		if (isset($_POST['name_clinic']))
			$review['name_clinic'] = $_POST['name_clinic'];
			
		if (isset($_POST['name']))
			$review['name'] = $_POST['name'];

		if (isset($_POST['email']))
			$review['email'] = $_POST['email'];

		if (isset($_POST['quality']))
			$review['quality'] = $_POST['quality'];

		if (isset($_POST['service']))
			$review['service'] = $_POST['service'];

		if (isset($_POST['cleanliness']))
			$review['cleanliness'] = $_POST['cleanliness'];

		if (isset($_POST['comfort']))
			$review['comfort'] = $_POST['comfort'];

		if (isset($_POST['commun']))
			$review['commun'] = $_POST['commun'];

		if (isset($_POST['values']))
			$review['values'] = $_POST['values'];

		if (isset($_POST['message'])) {
			$post_content = $_POST['message'];
		} else {
			$post_content = '';
		}

		$review['stars_point'] = $review['quality'] + $review['service'] + $review['cleanliness'] + $review['comfort'] + $review['commun'] + $review['values'];
		$review['stars_point'] = $review['stars_point'] / 6 ;
		$review['stars_point'] = number_format($review['stars_point'] );		

		if (isset($_POST['post_id']))
			$review['review_id'] = $_POST['post_id'];
	}
	$review_post = [
		'post_title' => $review['name_clinic'] . ' - ' .$review['name'],
		'post_content' => $post_content,
		'meta_input' => $review,
		'post_type' => 'writereview',
		'post_status' => 'private'
	];

	$review_id = wp_insert_post($review_post);

}
add_action( 'admin_post_bookreview', 'bookreview' );
add_action( 'admin_post_nopriv_bookreview', 'bookreview' );


