<?php while (have_posts()) : the_post(); ?>
<?php 
	$name_clinic 	= get_the_title();
	$image_ofclinic 	= get_img_src_bypostid($post->ID, 'large'); 
	if (!$image_ofclinic) {
	 	$image_ofclinic = get_bloginfo('template_url') . '/assets/images/dental.jpg';
	} 
	
	// About
	$about_clinic	= get_post_meta( get_the_ID(), 'about_clinic', true );  
	$about 		 	= $about_clinic['about'];

	// Treatment
	$treatment_clinic 		= get_post_meta( get_the_ID(), 'treatment_clinic', true );  
	$count_all_treatment 	= count($treatment_clinic);
	$treatment_check 		= checkHasTreatment($count_all_treatment,$treatment_clinic) ;


	// Promotion 
	$promotion_clinic 		= get_post_meta( get_the_ID(), 'promotion_clinic', true ); 
	$count_all_promotion 	= count($promotion_clinic);
	$promotion_check 		= checkHasPormotion($count_all_promotion,$promotion_clinic);

	// Expert
	$expert_clinic 		= get_post_meta( get_the_ID(), 'expert_clinic', true ); 
	$count_all_expert 	= count($expert_clinic);
	$expert_check 		= 'true';
	if ($count_all_expert == 1) {
		if (empty($expert_clinic[0]['name'])) {
			$expert_check 	= 'false';
		}
	}	
	
	// Images
	$images_clinic 	= get_post_meta( get_the_ID(), 'images_clinic', true ); 
	$images_check 	= 0;
	for ($i_check=1; $i_check <= 10; $i_check++) { 
		if ($images_clinic[$i_check] != '') {
			$images_check = $images_check + 1;
		}
	}

	// Contact 
	$contact_clinic = get_post_meta( get_the_ID(), 'contact_clinic', true ); 
	$latitude 	= $contact_clinic['latitude'];
	$longitude 	= $contact_clinic['longitude'];
	$address	= $contact_clinic['address'];

	// Time 
	$time_clinic = get_post_meta( get_the_ID(), 'time_clinic', true ); 

	//Review 
	$args = WP_Query_writereview($name_clinic);
	$loop = new WP_Query( $args ); 
	$count_review = $loop->post_count;		
	
?>	
<section class="container-fluid section-single-header" style="background-image:url(<? build_url('/assets/images/quote.jpg'); ?>)">
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<div class="row">
						<div class="col-xs-12 sub-menu">
							<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
							<span class="text-capitalize"><a href="<?= esc_url(home_url('/clinics/')); ?>"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>
							<span> <?php echo $name_clinic ;?></span>
						</div>
						<div class="col-xs-12 the-title">
							<h1><?php echo $name_clinic ;?></h1>
						</div>
						<div class="col-xs-12 terms_county">
						<?php	$terms_county 	= 	wp_get_object_terms( $post->ID, 'county_types', array('fields'=>'slugs'));
							if (empty($terms_county)) { 
								echo '<span>Thailand</span>';
							}else{ 
								echo '<span> '.ucwords($terms_county[0]).', Thailand</span>';
							} ?>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>
<section class="container-fluid tab-single affix-tab" data-spy="affix" data-offset-top="200">
	<div class="container">
		<nav class="navbar">
			<div id="myNavbar">
			    <ul class="nav navbar-nav">
			    	<?php if ($about) { 
			      		echo '<li><a href="#about">Overview</a></li>';
			      	} 
			      	if ($treatment_check > 0 ) { 
			      		echo '<li><a href="#treatments">Treatments</a></li>';
			   		}
			      	if ($promotion_check > 0 ) {
			      		echo '<li><a href="#promotion">Promotion</a></li>';
			      	}
			      	if ($expert_check == 'true'){
						echo '<li><a href="#dentists">Dentists</a></li>';
					}

					echo '<li><a href="#review">Review</a></li>';

					if ($images_check > 0 ) { 
						echo '<li><a href="#gallerys">Gallerys</a></li>';
					} ?>
					<li class="thbaud">
                        <a class="thb" href="#treatments">THB <i class="fa fa-long-arrow-right"></i> AUD</a>
                        <a class="aud" href="#treatments">AUD <i class="fa fa-long-arrow-right"></i> THB</a>
					</li>
			    </ul>
			</div>
		</nav>
	</div>
</section>
<section class="container-fluid single-posttype">
	<div class="container">
		<div class="row">
			<article class="col-lg-8 col-md-8 col-sm-7 col-xs-12">

				<?php if($about){ // About ?>
					<div class="col-xs-12">
						<div id="about" class="row affix-first" data-spy="affix" data-offset-top="200">
							<div class="border-link"></div>
						</div>
						<div class="row about">
							<div class="title-body flex-start">
								<h3>Overview of <?php echo $name_clinic;?></h3>
							</div>	
							<p><?php echo $about;?></p>
						</div>	
					</div>	
				<?php } ?>
	
				<?php if ($treatment_check > 0 ) { // Treatments  ?>
					<div class="col-xs-12">
						<div id="treatments" class="row link-id">
							<div class="border-link"></div>
						</div>
						<div class="row treatments price">
							<div class="title-body flex-start">
								<h3>treatments</h3>
								<div class="thbaud">
				               	    <a class="thb">THB <i class="fa fa-long-arrow-right"></i> AUD</a>
				                    <a class="aud">AUD <i class="fa fa-long-arrow-right"></i> THB</a>
								</div>	
							</div>
							<table class="dentistry-post_type">
								<thead>
									<tr>
										<td>Procedure</td>
										<td class="converter">Price</td>
									</tr>
								</thead>
								<tbody>
									<?php for($t = 0; $t < $count_all_treatment; $t++){ 
										if ($treatment_clinic[$t]['checkbox'] == 'yes' || $treatment_clinic[$t]['checkbox'] == 'on') {

											$price = $treatment_clinic[$t]['price'];
											echo '<tr><td>'.$treatment_clinic[$t]['name'].'</td><td class="currencyConverter">';
											if ($price) {
												$valConver = 	0.0378 * $price;
	    										$valConver = 	number_format($valConver,2);
	    										echo '<span class="valthb" style="width: 70px;display: inline-block;">'.number_format($price).'</span>';
												echo '<span class="valaud" style="width: 70px;display: inline-block; color:#005eb8;">'.$valConver.'</span>';
												echo '<span class="currencyTA">THB</span>';
											}else{
												echo "-";
											}
											echo '</td></tr>';
										}
									} ?>	
								</tbody>
							</table>
						</div>
					</div>
				<?php } ?>	

				<?php if ($promotion_check > 0 ) { // Promotion ?>
					<div class="col-xs-12">
						<div id="promotion" class="row link-id">
							<div class="border-link"></div>
						</div>	
						<div class="row promotion">
							<div class="title-body flex-start">
								<h3>Promotion</h3>
							</div>
							<div class="promotion-pic">
								<?php for($p = 0; $p < $count_all_promotion; $p++){ 
									if ($promotion_clinic[$p]['checkbox'] == 'yes' || $promotion_clinic[$p]['checkbox'] == 'on' )  {
										echo '<p class="namepromo"><i class="fa fa-check"></i>';
										echo $promotion_clinic[$p]['name'];
										echo '<span>'.$promotion_clinic[$p]['price'].'</span></p>';
										echo '<p class="despromo">'.$promotion_clinic[$p]['description'].'</p>';
									}
								}?>
							</div>
						</div>
					</div>			
				<?php } ?>	

				<?php if ($expert_check == 'true'){ // Expert ?>	
					<div class="col-xs-12">
						<div id="dentists" class="row link-id">
							<div class="border-link"></div>
						</div>	
						<div class="row dentists">
							<div class="title-body flex-start">
								<h3>Dentists</h3>
							</div>
							<div class="row">
								<?php for($e = 0; $e < $count_all_expert; $e++){ 
									if ($expert_clinic[$e]['name'] != '') {
										$sendname_fun = $expert_clinic[$e]['name'];
										// call function singleclinic_expert() in ../lib/shortcode.php
										singleclinic_expert($sendname_fun, $e );
									}
								} ?>	
							</div>
						</div>
					</div>		
				<?php } ?>	
	
				<div class="col-xs-12"> <? //Review  ?>
					<div id="review" class="row link-id">
						<div class="border-link"></div>
					</div>	
					<div class="row review">
						<div class="title-body flex-start">	
							<h3>review</h3><span>(<?php echo $count_review; ?> reviews)</span>
						</div>
						<ul id="showReview" style="padding: 0;list-style: none;">
							<script type="text/javascript">
								jQuery( document ).ready(function() {
									var name_clinic_js  = '<?php echo $name_clinic;?>';
									show_review(name_clinic_js);

									jQuery('#loadMore').click(function(){
										more_review(name_clinic_js);
									});
								});
							</script> 
						</ul>		
					</div>	
					<div class="row review">
						<?  $post_id = $post->ID;
							$page_url = home_url('/write-review/?pid='.$post_id.'');
						?>
						<form class="col-md-4 col-sm-5 col-xs-12 " action="<?php echo $page_url; ?>"  method="post" >
							<input type="hidden" name='title' value="<? echo $name_clinic; ?>"/>
							<input type='submit' name='submit' value="Write Review" class="btn-review btn-custom">
						</form>
						<? if ($count_review > 3) { ?>
							<div id="more_review" class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-5 col-xs-12 butt">
								<button id="loadMore" class="btn-main btn-custom">Load more</button>
							</div>	
						<?php } ?>
					</div>
				</div>

				<?php if ($images_check > 0 ) {  // Gallerys ?>
					<div class="col-xs-12">
						<div id="gallerys" class="row link-id">
							<div class="border-link"></div>
						</div>
						<div class="row gallerys">
							<div class="title-body flex-start">
								<h3>Gallerys</h3>
							</div>
							<?php if ($images_check == 1) { ?>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<img class="img-responsive" src="<?php echo $images_clinic[1]; ?>" style="width: 100%;"/>
									</div>
								</div>
							<?php }if ($images_check == 2) { ?>
								<div class="row">
									<div class="col-xs-6 col-sm-12 col-md-6">
										<img class="img-responsive" src="<?php echo $images_clinic[1]; ?>" style="width: 100%;"/>
									</div>
									<div class="col-xs-6 col-sm-12 col-md-6">
										<img class="img-responsive" src="<?php echo $images_clinic[2]; ?>" style="width: 100%;"/>
									</div>
								</div>
							<?php }if ($images_check > 2) { 
								echo '<link rel="stylesheet" type="text/css"  href="'.get_bloginfo('template_url') .'/slider/slick/slick.css'.'" />';
								echo '<link rel="stylesheet" type="text/css"  href="'.get_bloginfo('template_url') .'/slider/slick/slick-theme.css'.'" />';
								echo '<script type="text/javascript" src="'.get_bloginfo('template_url') . '/slider/slick/slick.js'.'"></script>';
								echo '<script type="text/javascript" src="'.get_bloginfo('template_url') . '/slider/slick/slick.min.js'.'"></script>'; 
							?>
								<script type="text/javascript">
									jQuery(document).on('ready', function() {
										jQuery('.slider-gallerys').slick({
							  				dots: true, infinite: true, autoplay: true, autoplaySpeed: 2000, fade: true, cssEase: 'linear'
										});
									});
								</script>
								<div class="slider-gallerys slider">
								<?php for($j = 1; $j <= 10; $j++){
									if ($images_clinic[$j] != '') {
										echo '<div><img src="'.$images_clinic[$j].'"/></div>';	
									}
								} ?>	
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</article>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 bar-right ">
				<div class="right-affix" data-spy="affix" data-offset-top="800">
					<img class="img-responsive" src="<?php echo $image_ofclinic;?>"/>
					<?php 
						// Contact
						//contact_barright($contact_clinic); 
					?>
					<?php  $book_id = $post->ID;
						$book_url = home_url('/book-consultation/?pid='.$book_id.'');
					?>
					<div class="bookcon">
						<form  action="<?php echo $book_url; ?>"  method="post" >
							<input type="hidden" name='title' value="<? echo $name_clinic ; ?>"/>
							<input type='submit' name='submit' value="Book Consultation" class="btn-submit btn-custom">
						</form>
					</div>	
					<?php // Map
						if ($latitude && $longitude) {
							map_call_fun($latitude,$longitude);
						}
					?>
					<div class="clinic-details">	
						<?php 
							if ($address) {
								echo '<div class="address">'.$address.'</div>';
							} 
							// Time Open
							operation_time_fuc($time_clinic);
						?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
<?php endwhile ?>			