<?php /* Template Name: Page Contact */ ?>
<?php while (have_posts()) : the_post(); ?>
<section class="container-fluid header-posttype" >
	<div class="container">
		<div class="col-xs-12">
			<div class="row sub-menu">
				<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
				<span class="text-capitalize">Contact Us</span>
			</div>
			<div class="row">
				<h1>Contact <span class="text-uppercase"><?php bloginfo('name'); ?></span></h1>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid content-posttype">
	<div class="container">
		<div class="row">
			<div class="conact-form">
			<?php echo apply_filters('the_content', $post->post_content);  ?>
			<?php // echo do_shortcode('[contact-form-7 id="102" title="Contact form 1"]'); ?>
				
			</div>
		</div>
	</div>
</section>		
<?php	get_template_part('widgets/content', 'helpyou'); 	?>
<?php	get_template_part('widgets/content', 'aboutusworks'); 	?>
<?php endwhile; ?>
