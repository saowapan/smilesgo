<?php
 
function bookcon() {
	// show html 
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
    echo '<div class="wrap submit-bookcon-page" role="document"><div class="content"><main class="main">';
    echo '<section class="container-fluid header-posttype"><div class="container"><div class="col-xs-12"><div class="row sub-menu">';
	echo '<span><a href="'.esc_url(home_url('/')).'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span class="text-capitalize"><a href="'.esc_url(home_url('/clinics/')).'"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span class="text-capitalize"><a href="'.esc_url(home_url('/clinic/'.strtolower(str_replace(" ","-",$_POST['name_clinic'])).'')).'"> '.$_POST['name_clinic'].'</a> <i class="fa fa-angle-right"></i> </span>';
	echo '<span>Book Consultation </span></div><h3 class="row">Book Consultation</h3></div></div></section>';
	echo '<div class="container" style=" padding-bottom: 40px;text-align: center;"><h1 style="font-weight: bold;">Thank You For Book Consultation</h1>';
	echo '<h1 style="font-weight: bold;">'.$_POST['name_clinic'].'</h1></div>';
    echo '</main></div></div>';
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
  	echo '</body></html>';

  	// create post type auto
	if (isset($_POST['submitbook'])){	
		
		$bookcon = [];

		if (isset($_POST['name_clinic']))
			$bookcon['name_clinic'] = $_POST['name_clinic'];
			
		if (isset($_POST['name']))
			$bookcon['name'] = $_POST['name'];

		if (isset($_POST['email']))
			$bookcon['email'] = $_POST['email'];

		if (isset($_POST['phone']))
			$bookcon['phone'] = $_POST['phone'];

		if (isset($_POST['bookdate']))
			$bookcon['bookdate'] = $_POST['bookdate'];

		if (isset($_POST['booktime']))
			$bookcon['booktime'] = $_POST['booktime'];

		if (isset($_POST['treatment']))
			$bookcon['treatment'] = $_POST['treatment'];

		if ( isset($_POST['promotion'])) {
			$bookcon['promotion'] = $_POST['promotion'];
		}
		if (isset($_POST['message'])) {
			$bookcon_content = $_POST['message'];
		} else {
			$bookcon_content = '';
		}
	}
	$bookcon_post = [
		'post_title' 	=> $bookcon['name_clinic'] . ' - ' .$bookcon['name'],
		'post_content' 	=> $bookcon_content,
		'meta_input' 	=> $bookcon,
		'post_type' 	=> 'bookconsultation',
		'post_status' 	=> 'publish'
	];

	$bookcon_id = wp_insert_post($bookcon_post);

	// send to email 
	if (isset($_POST['submitbook'])){
		$email_from = $_POST['email'];
		$to 	= 'new@saowapan.com';
		$email_subject = 'Book Consultation from SMILESGO';
		$email_body = 'You have message from :'.$_POST['name'].'.<br>Email address : '.$_POST['email'].'<br>Telephone Number : '.$_POST['phone'].'<br>Treatment : '.$_POST['treatment'].'<br>Booking Date : '.$_POST['bookdate'].'<br>Booking Time : '.$_POST['booktime'].'<br>Special Instructions : '.$_POST['message'].'<br>';
		$email_header = 'From : '.$email_from;
		mail($to, $email_subject, $email_body, $email_header);
	}

}
add_action( 'admin_post_bookcon', 'bookcon' );
add_action( 'admin_post_nopriv_bookcon', 'bookcon' ); ?>