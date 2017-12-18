<?php /* Template Name: Page Book Consultation */ ?>
<?php 
	if (isset($_POST['submit'])){
	$title = $_POST['title']; 
	// Data Clinic 
	$args_data_clinic = array(
		'post_type' => 'clinic', 
		'name' 		=> $title
	);
	$loop = new WP_Query( $args_data_clinic );
	while ( $loop->have_posts() ) : $loop->the_post();

		$image_ofclinic 	= get_img_src_bypostid($post->ID, 'large'); 
		if (!$image_ofclinic) {
		 	$image_ofclinic = get_bloginfo('template_url') . '/assets/images/dental.jpg';
		}

		// Contact 
		$contact_clinic = get_post_meta( get_the_ID(), 'contact_clinic', true ); 
		$address	= $contact_clinic['address'];

		// Time
		$time_clinic = get_post_meta( get_the_ID(), 'time_clinic', true ); 

		// Treatment
		$treatment_clinic 		= get_post_meta( get_the_ID(), 'treatment_clinic', true );  
		$count_all_treatment 	= count($treatment_clinic);

		// Promotion 
		$promotion_clinic 		= get_post_meta( get_the_ID(), 'promotion_clinic', true ); 
		$count_all_promotion 	= count($promotion_clinic);
		$promotion_check 		= checkHasPormotion($count_all_promotion,$promotion_clinic);
		
	endwhile; 
?>
	<link rel="stylesheet" href="<?=get_bloginfo('template_url') . '/assets/styles/jquery-ui.css';?>">
	<script src="<?=get_bloginfo('template_url') . '/assets/scripts/jquery-1.12.4.js';?>"></script>
	<script src="<?=get_bloginfo('template_url') . '/assets/scripts/jquery-ui.js';?>"></script>
	<script> $( function() { $( "#datepicker" ).datepicker({minDate:0});  } ); </script>
	<section class="container-fluid header-posttype" style="margin-bottom: 0;">
		<div class="container">
			<div class="col-xs-12">
				<div class="row sub-menu">
					<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"><a href="<?= esc_url(home_url('/clinics/')); ?>"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"><a href="<?= esc_url(home_url('/clinic/'.strtolower(str_replace(" ","-",$title)).'')); ?>"> <?php echo $title ;?></a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize">Book Consultation</span>
				</div>
				<div class="row">
					<h1><?php echo ucwords($title); ?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<div class="col-xs-12 title-review">
						<h3 class="col-xs-12">Thank You For Book Consultation</h3>
					</div>
					<div class="col-xs-12 form-review">
						<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
							<div class="form-group col-xs-12">
								<label>Name*</label><input type="text" name='name' required/>
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label>Email*</label><input type="email" name='email' required/>
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label>Telephone Number*</label><input type="text" name='phone' required/>
							</div>	
							<div class="form-group col-xs-12 col-md-6">
								<label>Booking Date</label>
								<input name='bookdate' type="text" id="datepicker" style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)" value="<?=date('m/d/Y')?>">
							</div>	
							<div class="form-group col-xs-12 col-md-6">
								<label>Booking Time</label>
								<select name='booktime' style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
									<option value="Anytime" selected="">Anytime</option>
									<option value="Morning">Morning</option>
									<option value="Afternoon">Afternoon</option>
									<option value="Evening">Evening</option>
								</select>
							</div>	
							<?php if ($promotion_check > 0 ) { ?>
								<div class="form-group col-xs-12 col-md-6">
							<?php }else{ ?>		
								<div class="form-group col-xs-12">
							<?php } ?>
								<label>Treatment</label>
								<select name='treatment' style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
									<option value="" selected=""></option>
									<?php 
										for($t = 0; $t < $count_all_treatment; $t++){ 
											if ($treatment_clinic[$t]['checkbox'] == 'yes' || $treatment_clinic[$t]['checkbox'] == 'on') {
												echo '<option value="'.$treatment_clinic[$t]['name'].'">'.$treatment_clinic[$t]['name'].'</option>';
											}
										}	
									?>
								</select>
							</div>
							<?php if ($promotion_check > 0 ) { ?>
								<div class="form-group col-xs-12 col-md-6">
									<label>Promotion</label>
									<select class="text-capitalize" name='promotion' style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
										<option value="" selected=""></option>
										<?php 
											for($p = 0; $p < $count_all_promotion; $p++){ 
												if ($promotion_clinic[$p]['checkbox'] == 'yes' || $treatment_clinic[$t]['checkbox'] == 'on') {
													echo '<option value="'.$promotion_clinic[$p]['name'].'">'.$promotion_clinic[$p]['name'].'</option>';
												}
											}	
										?>
									</select>
								</div>
							<?php }?>
							<div class="form-group col-xs-12">
								<label>Special Instructions</label><textarea name='message'></textarea>
							</div>
							<div class="col-xs-12 col-md-4 col-md-offset-4"> 
								<input type="hidden" name="name_clinic" value="<?php echo $title; ?>"/>
								<input type="hidden" name="post_id" value="<?if(isset($_GET['pid'])){echo $_GET['pid'];}?>"  />
								<input type="hidden" name="action" value="bookcon" />
								<input type='submit' name='submitbook' value="submit" class="btn-submit btn-custom"/>
							</div>
						</form>	
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 bar-right" style="margin:30px 0;">
					<img class="img-responsive" src="<?php echo $image_ofclinic;?>"/>	
					<?php 
						// call function contact_barright() in ../lib/shortcode.php
						contact_barright($contact_clinic); 
					?>
					<div class="clinic-details">	
					<?php	
						if ($address) {
							echo '<div class="address">'.$address.'</div>';
						} 
						// call function operation_time_fuc() in ../lib/shortcode.php
						operation_time_fuc($time_clinic);
					?>
					</div>
				</div>	
			</div>		
		</div>
	</section>
		<?php	get_template_part('widgets/content', 'get_quote'); 	?> 	
<? }else{ ?>
	<section class="container-fluid header-posttype" style="margin-bottom: 0;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<div class="row">
						<div class="col-xs-12 sub-menu">
							<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
							<span> Book Consultation</span>
						</div>
						<div class="col-xs-12 the-title  sub-menu">
							<h2>Please Choose The Clinic Before Book Consultation</h2>
						</div> 
					</div>
				</div>
			</div>	
		</div>
	</section>	
	<?php	get_template_part('widgets/content', 'county'); ?> 
	<?php	get_template_part('widgets/treatment', 'type'); ?> 
<?php } ?>		