<?php /* Template Name: Page Review */ ?>
<?php 
	if (isset($_POST['submit'])){
	$title 		= $_POST['title']; 
	$name_star	= array('quality','service','cleanliness','comfort','commun','values');
	$name_star_show = array( 'Quality', 'Service' , 'Cleanliness' , 'Comfort'  ,'Communication' ,'Value' );

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
		$contact_clinic = get_post_meta( get_the_ID(), 'contact_clinic', true ); 
	endwhile; 
?>
	<section class="container-fluid header-posttype" style="margin-bottom: 0;">
		<div class="container">
			<div class="col-xs-12">
				<div class="row sub-menu">
					<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"><a href="<?= esc_url(home_url('/clinics/')); ?>"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"><a href="<?= esc_url(home_url('/clinic/'.strtolower(str_replace(" ","-",$title)).'')); ?>"> <?php echo $title ;?></a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"><?php echo 'Write Review'; ?></span>
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
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 ">
					<div class="col-xs-12 title-review">
						<h3 class="col-xs-12">Thank You For Review </h3>
					</div>
					<div class="col-xs-12 form-review">
						<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST" >
							<div class="form-group col-xs-12 col-md-6">
								<label>Name*</label>
								<input type="text" name='name' required/>
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label>Email*</label>
								<input type="email" name='email' required/>
							</div>
							<div class="form-group col-xs-12">
								<label>Message</label>
								<textarea name='message'></textarea>
							</div>
							<div class="form-group col-xs-12">
								<p>Please rate your experience for the following where 1 star is very bad and 5 stars is very good.</p>
								<table class="star-review">
								<?php for ($tr= 0; $tr < 6 ; $tr++) { 
									echo '<tr class="star-review-'.$name_star[$tr].'">';
									echo '<td class="label">'.$name_star_show[$tr].'</td>';
									echo '<td>';
									echo '<fieldset>';
									echo '<span class="star-cb-group">';
									for ($count_star=5; $count_star >= 1 ; $count_star--) { 
										echo '<input type="radio" id="'.$name_star[$tr].'-'.$count_star.'" name="'.$name_star[$tr].'" value="'.$count_star.'" /><label for="'.$name_star[$tr].'-'.$count_star.'">'.$count_star.'</label>';
									}
									echo '<input type="radio" id="'.$name_star[$tr].'-0" name="'.$name_star[$tr].'" value="0" class="star-cb-clear" checked="checked"/><label for="'.$name_star[$tr].'-0">0</label>';
									echo '</span>';
									echo '</fieldset>';
									echo '</td>';
									echo '</tr>';
								}?>
								</table>		
							</div>
							<div class="col-xs-12 col-md-4 col-md-offset-4"> 
								<input type="hidden" name="name_clinic" value="<?php echo $title; ?>"/>
								<input type="hidden" name="post_id" value="<?if(isset($_GET['pid'])){echo $_GET['pid'];}?>" />
								<input type="hidden" name="action" value="bookreview" />
								<input type='submit' name='submit' value="Send Review" class="btn-review btn-custom"/>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 bar-right" style="margin:30px 0;">
					<img class="img-responsive" src="<?php echo $image_ofclinic;?>"/>
					<?php  $book_id = $post->ID;
						$book_url = home_url('/book-consultation/?pid='.$book_id.'');
					?>
					<div class="bookcon">
						<form  action="<?php echo $book_url; ?>"  method="post" target="_blank">
							<input type="hidden" name='title' value="<? echo $title ; ?>"/>
							<input type='submit' name='submit' value="Book Consultation" class="btn-submit btn-custom">
						</form>
					</div>
					<?php 
						// call function contact_barright() in ../lib/shortcode.php
						contact_barright($contact_clinic); 
					?>
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
							<span> Write Review</span>
						</div>
						<div class="col-xs-12 the-title  sub-menu">
							<h2>Please Choose The Clinic Before Write Review</h2>
						</div> 
					</div>
				</div>
			</div>	
		</div>
	</section>	
	<?php	get_template_part('widgets/content', 'county'); ?> 
	<?php	get_template_part('widgets/treatment', 'type'); ?> 
<?php } ?>	
