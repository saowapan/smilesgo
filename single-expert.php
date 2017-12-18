<?php while (have_posts()) : the_post(); ?>
<?php 
	$name_expert 	= get_the_title();
	$image_expert	= get_img_src_bypostid($post->ID, 'large'); 
	$expert_content = get_the_content();
	$area_expert 	= get_post_meta( get_the_ID(), 'area_expert', true );
	$count_area_expert = count($area_expert);
?>
<section class="container-fluid section-single-header" style="background-image:url(<? build_url('/assets/images/quote.jpg'); ?>)">
	<div class="single-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<div class="row">
						<div class="col-xs-12 sub-menu">
							<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
							<span> <?php echo $name_expert ;?></span>
						</div>
						<div class="col-xs-12 the-title">
							<h1><?php echo $name_expert ;?></h1>
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
<section class="container-fluid single-posttype-expert">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 text-center barright">
				<div class="expert-barright">
					<h4>ASK <?php echo $name_expert; ?></h4>
					<div class="size-img-ex">
						<img class="img-responsive" title="<?php echo $name_expert; ?>" src="<?php echo $image_expert; ?>"/>
					</div>
					<div class="form-ex">
						<form  action="" method="post">
							<input type="text"  name="ex_username" placeholder="Name*" required="" />
							<input type="email" name="ex_email" placeholder="Email*" required="" />
							<input type="text"  name="ex_subject" placeholder="Enter Question Title*" required="" />
							<textarea placeholder="Enter Question Details*" required="" name="ex_message"></textarea>
							<input type="submit" name="ex_submit" value="Send" class="btn-submit btn-custom" />
						</form>
					</div>
				</div>
			</div>
			<article class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
				<div class="title-body flex-start">
					<h3>Overview</h3>
				</div>
				<div class="expert-area">
					<h4><strong>Area of expertise:</strong> 
						<span> <?php  for($ae = 0; $ae < $count_area_expert; $ae++){ 
							if ($area_expert[$ae]['checkbox'] == 'yes' || $area_expert[$ae]['checkbox'] == 'on') {  
								echo $area_expert[$ae]['val'].', ';
							}	
						}?></span>
					</h4>
				</div>
				<div><?php echo $expert_content;?></div>
				<div class="row"><? $args   = array(
					    'post_type'       => 'clinic', 
					    'posts_per_page'  => -1 ,
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); 
						$expert_clinic 		= get_post_meta( get_the_ID(), 'expert_clinic', true ); 
						$img 	=  	get_img_src_bypostid($post->ID, 'large');
						if (!$img){ 
							$img = get_bloginfo('template_url') . '/assets/images/dental.jpg';
						}
						foreach ($expert_clinic as $value) {
							if ($value != '') {
								if ($value['name'] == $name_expert ) { ?>
									<div class="col-xs-12 col-md-6 find-clinic">
										<div class="row expert-area"">
											<h4  class="col-xs-12"><strong><?=get_the_title();?></strong></h4>
											<img class="col-xs-12" style="padding-bottom: 15px;" src="<?=$img?>" />
											<div class="col-xs-12">
												<a href="<?=get_permalink();?>" class="btn-custom btn-main">Find Clinic</a>
											</div>
										</div>
									</div>	
								<?php }
							}
						}
					endwhile;?>
				</div>	
			</article>		
		</div>
	</div>
</section>		
<?php endwhile ?>	
<?php if(isset($_POST['ex_submit'])){
	$from_email = $_POST['ex_email'];
	$to = 'new@saowapan.com';
	$subject = ''.$_POST['ex_subject'].':'.$_POST['ex_username'].'';
	$message = 'Name :'.$_POST['ex_username'].' Message : '.$_POST['ex_message'].'';
	mail($to,$from_email, $subject, $message );
}?>