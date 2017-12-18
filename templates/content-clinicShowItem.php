<?php 
$name_img_default 	= get_bloginfo('template_url') . '/assets/images/treatments-type.jpg';

$title 	= 	get_the_title();
$link   = 	get_permalink();

$img 	=  	get_img_src_bypostid($post->ID, 'large');
if (!$img){ 
	$img = $name_img_default; 
}
$about_clinic 	= get_post_meta( get_the_ID(), 'about_clinic', true );
$about 	   		= $about_clinic['about'];
if(strlen($about ) > 220) { 
	$about  = iconv_substr($about , 0, 220,"UTF-8"). '...'; 
}

$promotion_clinic    = get_post_meta( get_the_ID(), 'promotion_clinic', true );
$count_all_promotion = count($promotion_clinic);
$promotion = checkHasPormotion($count_all_promotion,$promotion_clinic);

$contact_clinic = get_post_meta( get_the_ID(), 'contact_clinic', true );
$email = $contact_clinic['email'];
$phone = $contact_clinic['phone']; 

$terms 	= 	wp_get_object_terms( $post->ID, 'county_types', array('fields'=>'slugs'));

?>
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
					<?php // show county [0]
						if (isset($terms)) { 
							echo '<span class="col-xs-6 col-sm-6"> '.ucwords($terms[0]).', Thailand</span>';
						}else{
							echo '<span class="col-xs-6 col-sm-6">Thailand</span>';
						}
						// show review
						$argscount = WP_Query_writereview($title);
						$loopcount = new WP_Query( $argscount );
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
			<p><?php echo $about; ?></p>
			<div class="footertpost">
				<div class="row">
					<div class="col-lg-8  col-xs-12 email-phone ">
						<?php 
							if ($email) {  
								echo '<div><i class="fa fa-envelope-o" ></i><a class="break-word" href="mailto:'.$email.'?subject=smilesgo"> '.$email.'</a></div>';
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