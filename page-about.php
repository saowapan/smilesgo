<?php /* Template Name: Page About */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php 	$title_img = 'dentistry, treatment, dental implant, dentures, all on four, fillings, root canal, Laser Teeth Whitening, crowns, veneers, bangkok, pattaya, phuket, krabi';?>

<section class="container-fluid header-posttype" >
	<div class="container">
		<div class="col-xs-12">
			<div class="row sub-menu">
				<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
				<span class="text-capitalize">About Us</span>
			</div>
			<div class="row">
				<h3>About <span class="text-uppercase"><?php bloginfo('name'); ?></span></h3>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid aboutus-thailand">
	<div class="container">
		<div class="row  text-center">
			<h1 class="col-xs-12 text-uppercase"><?php bloginfo('name'); ?> Connects Patients And Doctors IN THAILAND</h1>
			<h4 class="col-xs-12">This is your international network of <?php bloginfo('name'); ?> experts. Welcome to healthcare made simple</h4>
		</div>
		<div class="row flex-center">
			<div class="col-xs-12 col-sm-4">
				<p>Access specialist second opinions, compare treatment costs, and schedule an appointment at a trusted clinic or hospital.</p>
				<p><span class="text-uppercase"><?php bloginfo('name'); ?></span> is a world of connected healthcare: higher quality care, shorter waiting times, affordable treatment.</p>
			</div>	
			<div class="col-xs-12 col-sm-4">
				<p>Improves access to healthcare for people everywhere. It is an easy to use platform and service that helps patients to get medical second opinions and to schedule affordable, high quality medical treatment</p>
			</div>	
		</div>
	</div>
</section>
<section class="container-fluid aboutus-box">
	<div class="container">
		<div class="row">
			<div class="text-center  col-xs-12 col-sm-4">
				<h4>PRIVACY</h4>
				<p>We do not and never will sell your personal data.</p>
				<p>Simply send us an inquiry and we will help you get a personalized quote from a specialist. Each quote includes a treatment plan and cost estimate.</p>
			</div>
			<div class="text-center col-xs-12 col-sm-4">
				<h4>TRANSPARENCY</h4>
				<p>We believe that when making health decisions, the more information you have the better.</p>
				<p>Clinics are listed with accreditation levels, staff experience, facility pictures, procedure prices and reviews from former patients. By using your personal dashboard, you contact the clinic staff directly.</p>		
			</div>	
			<div class="text-center  col-xs-12 col-sm-4">
				<h4>ACCESSIBILITY</h4>
				<p>We connect you with trusted health care providers and we partner with internationally accredited institutions.</p>
				<p>We are committed to upholding patient privacy and use state-of-the-art encryption in all transactions.</p>
			</div>	
		</div>
	</div>
</section>
<?php	get_template_part('widgets/content', 'aboutusworks'); 	?>
<?php endwhile; ?>