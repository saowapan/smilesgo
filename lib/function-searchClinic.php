<?php 
//Enqueue Ajax Scripts
function enqueue_infohub_ajax_scripts() {
    wp_register_script( 'infohub-ajax-js', get_bloginfo('template_url') . '/assets/scripts/postClinic.js', array( 'jquery' ), '', true );
    wp_localize_script( 'infohub-ajax-js', 'ajax_infohub_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'infohub-ajax-js' );
}
add_action('wp_enqueue_scripts', 'enqueue_infohub_ajax_scripts');

// check WP_Query
function check_WP_Query_County($ppp, $page ,$articles_term){
	if (empty($ppp)) {
		$ppp = '';
	}
	if (empty($page)) {
		$page = '';
	}
	if($articles_term != 'all') {
		$infohub_args  = array(
			'post_type' 	  => 'clinic', 
			'posts_per_page'  => $ppp, 
			'paged' 		  => $page, 
			'orderby'         => 'meta_value_num',
		    'meta_key'        => 'support_clinic',
		    'order'           => 'DESC',
			'post_status'     => 'publish',
		    'tax_query'       => array(
		        array(
		            'taxonomy'  =>  'county_types',
		            'field' 	=> 'slug',
		            'terms' 	=> $articles_term,
		        ),
		    ),
		);
	}else{
		$infohub_args = array(
			'post_type' 	 => 'clinic', 
			'posts_per_page' => $ppp, 
			'paged' 		 => $page, 
			'orderby'        => 'meta_value_num',
		    'meta_key'       => 'support_clinic',
			'order' 		 => 'DESC', 
			'post_status' 	 => 'publish'
		);
	}
	$infohub_loop = new WP_Query($infohub_args);
	return $infohub_loop;
}

//Add Ajax Actions : County Post Show
add_action('wp_ajax_infohub_county', 'ajax_infohub_county');
add_action('wp_ajax_nopriv_infohub_county', 'ajax_infohub_county');
function ajax_infohub_county()
{
	display_infohubcounty();
}
//Add Ajax Actions : More County Post Show
add_action('wp_ajax_more_infohubcounty', 'ajax_more_infohubcounty');
add_action('wp_ajax_nopriv_more_infohubcounty', 'ajax_more_infohubcounty');
function ajax_more_infohubcounty()
{
	display_infohubcounty();
}
// Show Post
function display_infohubcounty(){
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	$ppp = (isset($query_data["ppp"])) ? $query_data["ppp"] : 6;
    $page = (isset($query_data['pageNumber'])) ? $query_data['pageNumber'] : 0;

    header("Content-Type: text/html");

    wp_reset_query(); 

	$infohub_loop = check_WP_Query_County($ppp, $page ,$articles_term);

	if( $infohub_loop->have_posts() ):
		while( $infohub_loop->have_posts() ): $infohub_loop->the_post();
			get_template_part( 'templates/content-clinicShowItem', get_post_format() );
		endwhile;
	else: ?>
		<div id="no_more_infohub" class="col-xs-12"></div>
		<div class="col-xs-12 post-item"><h4 class="text-center col-xs-12" style="color: #005eb8;font-weight: bold;">Sorry, we don't have anymore clinic</h4></div>
	<?php endif;
	die();
}


//Add Ajax Actions : Show Button More Post ( County Types )
add_action('wp_ajax_display_btncounty', 'ajax_display_btncounty');
add_action('wp_ajax_nopriv_display_btncounty', 'ajax_display_btncounty');
function ajax_display_btncounty(){
	display_btncounty();
}
function display_btncounty(){ 
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';

	header("Content-Type: text/html");

	wp_reset_query();

	$infohub_loop = check_WP_Query_County('-1', '', $articles_term);
	$count 	= $infohub_loop->post_count;
	if ($count > 6 ){ ?>
		<div id="more_articles" class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-8 col-xs-12">
			<a  onClick = "more_infohubcounty('<?=$articles_term?>');" class="btn-review btn-custom">See more Clinic</a>
		</div>
	<?php } 	
	die();
}

//Add Ajax Actions : Count Post  County Types
add_action('wp_ajax_infohub_countcounty', 'ajax_infohub_countcounty');
add_action('wp_ajax_nopriv_infohub_countcounty', 'ajax_infohub_countcounty');
function ajax_infohub_countcounty()
{
	infohub_countcounty();
}
function infohub_countcounty(){
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	header("Content-Type: text/html");
	$count = '';
	wp_reset_query();

	$infohub_loop = check_WP_Query_County('', '', $articles_term);
	$count 	= $infohub_loop->post_count;
	if ($articles_term == 'all') {
		$articles_term = 'all county';
	}
	if($count == 1){
		echo '<h4><span>By All Treatment</span><span>'.$count.' Clinic Found In '.ucwords($articles_term).'</span></h4>'; 
	}else{
		echo '<h4><span>By All Treatment</span><span>'.$count.' Clinics Found In '.ucwords($articles_term).'</span></h4>'; 
	} 	
	die();
}
  
//Add Ajax Actions : Leftbar
add_action('wp_ajax_infohub_leftbar', 'ajax_infohub_leftbar');
add_action('wp_ajax_nopriv_infohub_leftbar', 'ajax_infohub_leftbar');
function ajax_infohub_leftbar()
{
	infohub_leftbar();
}
function infohub_leftbar(){
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	$varcheck = (isset($query_data['varcheck']) ) ? $query_data['varcheck'] : '';
	header("Content-Type: text/html");
		if ($varcheck == 'all') { ?>
			<li class="active">
				<a data-toggle="tab" href="#" onclick="infohub_send('<?=$articles_term?>');">All Treatment</a>
				<span class="span-tabactive"><span class="fa fa-check"></span></span>
			</li>
		<?php }else{ ?>
			<li>
				<a data-toggle="tab" href="#" onclick="infohub_send('<?=$articles_term?>');">All Treatment</a>
				<span class="span-tabactive"><span class="fa fa-check"></span></span>
			</li>
		<? } ?>
	
	<?php $treatments = WP_Query_treatment();
		foreach ($treatments as $treatment){ 
			if ($treatment['name'] == $varcheck) { ?>
				<li class="active">
					<a data-toggle="tab" href="#" onClick="infohub_sendTre('<?=$treatment['name']?>','<?=$articles_term?>');"><?=$treatment['name']?></a>
					<span class="span-tabactive"><span class="fa fa-check"></span></span>
				</li>
			<?php }else{ ?>
				<li>
					<a data-toggle="tab" href="#" onClick="infohub_sendTre('<?=$treatment['name']?>','<?=$articles_term?>');"><?=$treatment['name']?></a>
					<span class="span-tabactive"><span class="fa fa-check"></span></span>
				</li>
			<?php }
 		}
	die();
}


// Show Post Tre
add_action('wp_ajax_infohub_tre', 'ajax_infohub_tre');
add_action('wp_ajax_nopriv_infohub_tre', 'ajax_infohub_tre');
function ajax_infohub_tre()
{
	display_infohubTre();
}
//Add Ajax Actions : More County Post Show
add_action('wp_ajax_more_infohubTre', 'ajax_more_infohubTre');
add_action('wp_ajax_nopriv_more_infohubTre', 'ajax_more_infohubTre');
function ajax_more_infohubTre()
{
	display_infohubTre();
}

// Show Post Tre
function display_infohubTre(){
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	$treatment_term = (isset($query_data['treatment_cate']) ) ? $query_data['treatment_cate'] : '';
	$ppp  = (isset($query_data["ppp"])) ? $query_data["ppp"] : 6;
    $page = (isset($query_data['pageNumber'])) ? $query_data['pageNumber'] : 0;

    header("Content-Type: text/html");

	wp_reset_query();
	$infohub_loop = check_WP_Query_County($ppp, $page ,$articles_term);
	$check_treatment_clinic = 0;
	$name_img_default 	= get_bloginfo('template_url') . '/assets/images/treatments-type.jpg';
	if( $infohub_loop->have_posts() ):
		while( $infohub_loop->have_posts() ): $infohub_loop->the_post();
			$title 	= 	get_the_title();
			$link   = 	get_permalink();

			$img 	=  	get_img_src_bypostid($post->ID, 'large');
			if (!$img){ 
				$img = $name_img_default; 
			}
			$about_clinic 	= get_post_meta( get_the_ID(), 'about_clinic', true );
			$about 	   		= $about_clinic['about'];
			if(strlen($about ) > 160) { 
				$about  = iconv_substr($about , 0, 160,"UTF-8"). '...'; 
			}

			$promotion_clinic    = get_post_meta( get_the_ID(), 'promotion_clinic', true );
			$count_all_promotion = count($promotion_clinic);
			$promotion = checkHasPormotion($count_all_promotion,$promotion_clinic);

			$contact_clinic = get_post_meta( get_the_ID(), 'contact_clinic', true );
			$email = $contact_clinic['email'];
			$phone = $contact_clinic['phone']; 

			$treatment_clinic 	= get_post_meta( get_the_ID(), 'treatment_clinic', true );
			$count_treatment    = count($treatment_clinic);
			for($j = 0; $j < $count_treatment; $j++){ 
				if ($treatment_clinic[$j]['checkbox'] == 'yes' && $treatment_clinic[$j]['name'] == $treatment_term && !empty($treatment_clinic[$j]['price']) ) {
					$price_val = $treatment_clinic[$j]['price'];
					$price_out = 0.0378 * $price_val; 
					$check_treatment_clinic = $check_treatment_clinic + 1; ?>

					<div class="col-xs-12 post-item">
						<div class="col-xs-5  -sm-12 col-md-4">
							<a href="<?=get_permalink();?>">
								<?php if ($promotion > 0 ) { 
									echo '<div class="ribbon-promotion"><span>PROMOTION !</span></div>'; 
								}?>
								<img title="<?php echo $title; ?>" class="img-responsive" src="<?php echo $img; ?>">
							</a>
						</div>
						<div class="contentpost-item col-xs-7 col-sm-12 col-md-8">
							<div class="headpost">
								<h3><a href="<?=$link;?>"><?php echo $title; ?></a></h3>
								<div class="row">
									<?php
										if ($articles_term != 'all') { 
											echo '<span class="col-xs-6 col-sm-6"> '.ucwords($articles_term).', Thailand</span>';
										}else{
											$termss = 	wp_get_object_terms( get_the_ID(), 'county_types', array('fields'=>'slugs'));
											echo '<span class="col-xs-6 col-sm-6">'.ucwords($termss[0]).', Thailand</span>';
										}		
										// show review
										$count_review = '';
										$stars_point_sum = '';
										$stars = '';
										$argscount = WP_Query_writereview($title);
										$loopcount = new WP_Query($argscount);
										$count_review = $loopcount->post_count;
									
										$stars_point_sum = count_review_point($loopcount); // call function count_review_point()
										if ($stars_point_sum != 0){
											$stars = number_format($stars_point_sum / $count_review);
										}

										echo '<span class="reviews col-xs-6 col-sm-6 text-right">';
										for ($star_count = 0 ; $star_count < $stars; $star_count++) { 
											echo '<i class="fa fa-star"></i>';
										}
										for ($nostar=0; $nostar < 5-$star_count; $nostar++) { 
											echo '<i class="fa fa-star-o"></i>';
										} 
										echo '<a href="'.$link.'/#review"> '.$count_review.' reviews</a>';
										echo '</span>';

									?>			
								</div>
							</div>
							<?php 
								echo '<p>'.$treatment_clinic[$j]['name'].'<span> From </span><span class="currencyTA show_priceunit">THB</span>';		
								echo '<span class="valthb show_priceunit"> '.number_format($price_val).' </span>';						
								echo '<span class="valaud show_priceunit"> '.number_format($price_out,2).'</span></p>';
							?>	
							<p><?php echo $about; ?></p>
							<div class="footertpost">
								<div class="row">
									<div class="col-lg-8  col-xs-12 email-phone ">
										<?php 
											if ($email) {  
												echo '<div><i class="fa fa-envelope-o" ></i><a href="mailto:'.$email.'?subject=smilesgo"> '.$email.'</a></div>';
											} 
											if ($phone) { 
												echo '<div><i class="fa fa-phone"></i><a href="tel:'.$phone.'"> '.$phone.'</a></div>';
											} 
										?>
									</div>
									<div class="col-lg-4 col-xs-12">
										<a class="btn-main btn-custom" href="<?=$link;?>">View Details</a>
									</div>
								</div>
							</div>
						</div>	
					</div>
				<?php } // if
			}// for
		endwhile;
	endif;

	if ($check_treatment_clinic < 1 ){ ?>
		<div id="no_more_infohubTre" class="col-xs-12"></div>
		<div class="col-xs-12  post-item"><h4 class="text-center col-xs-12" style="color: #005eb8;font-weight: bold;">Sorry, we don't have anymore clinic</h4></div>
	<?php }

	die();
}

//Add Ajax Actions : Show Button More Post ( Treatment  Types )
add_action('wp_ajax_display_btntre', 'ajax_display_btntre');
add_action('wp_ajax_nopriv_display_btntre', 'ajax_display_btntre');
function ajax_display_btntre(){
	display_btntre();
}
function display_btntre(){ 
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	$treatment_term = (isset($query_data['treatment_cate']) ) ? $query_data['treatment_cate'] : '';
	header("Content-Type: text/html");
	wp_reset_query();
	$infohub_loop = check_WP_Query_County('-1', '' ,$articles_term);
	$check_treatment_clinic = 0;
	if( $infohub_loop->have_posts() ):
		while( $infohub_loop->have_posts() ): $infohub_loop->the_post();
			$treatment_clinic 	= get_post_meta( get_the_ID(), 'treatment_clinic', true );
			$count_treatment    = count($treatment_clinic);
			for($j = 0; $j < $count_treatment; $j++){ 
				if ($treatment_clinic[$j]['checkbox'] == 'yes' && $treatment_clinic[$j]['name'] == $treatment_term && !empty($treatment_clinic[$j]['price']) ) {
					$check_treatment_clinic = $check_treatment_clinic + 1; 
				}
			}
		endwhile;
	endif;
	if ($check_treatment_clinic > 6 ){ ?>
		<div id="more_articlesTre" class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-8 col-xs-12">
			<a  onClick = "more_infohubTre('<?=$treatment_term?>','<?=$articles_term?>');" class="btn-review btn-custom">See more Clinic</a>
		</div>
	<?php }
	die();
}

//Add Ajax Actions : Count Post Treatment Types
add_action('wp_ajax_infohub_countTre', 'ajax_infohub_countTre');
add_action('wp_ajax_nopriv_infohub_countTre', 'ajax_infohub_countTre');
function ajax_infohub_countTre()
{
	infohub_countTre();
}
function infohub_countTre(){
	$query_data = $_POST;
	$articles_term = (isset($query_data['articles_cate']) ) ? $query_data['articles_cate'] : '';
	$treatment_term = (isset($query_data['treatment_cate']) ) ? $query_data['treatment_cate'] : '';
	header("Content-Type: text/html");
	wp_reset_query();
	$infohub_loop = check_WP_Query_County('-1', '' ,$articles_term);
	$check_treatment_clinic = 0;
	if( $infohub_loop->have_posts() ):
		while( $infohub_loop->have_posts() ): $infohub_loop->the_post();
			$treatment_clinic 	= get_post_meta( get_the_ID(), 'treatment_clinic', true );
			$count_treatment    = count($treatment_clinic);
			for($j = 0; $j < $count_treatment; $j++){ 
				if ($treatment_clinic[$j]['checkbox'] == 'yes' && $treatment_clinic[$j]['name'] == $treatment_term && !empty($treatment_clinic[$j]['price']) ) {
					$check_treatment_clinic = $check_treatment_clinic + 1; 
				}
			}
		endwhile;
	endif;
	if ($articles_term == 'all') {
		$articles_term = 'all county';
	}
	if($check_treatment_clinic == 1){
		echo '<h4><span>By '.$treatment_term.'</span><span>'.$check_treatment_clinic.' Clinic Found In '.ucwords($articles_term).'</span></h4>'; 
	}else{
		echo '<h4><span>By '.$treatment_term.'</span><span>'.$check_treatment_clinic.' Clinics Found In '.ucwords($articles_term).'</span></h4>';
	} 	
	die();
}
?>