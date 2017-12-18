<?php /* Template Name: All Clinic */ ?>
<section class="container-fluid header-posttype" style="margin-bottom: 0;">
	<div class="container">
		<div class="col-xs-12">
			<div class="row sub-menu">
				<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
				<span class="text-capitalize"> Dentistry Clinic</span>
			</div>
			<div class="row">
				<h1>Dentistry Clinic</h1>
			</div>
			<?php	get_template_part('widgets/content', 'ribbon'); ?> 
		</div>
	</div>
</section>
<section class="container-fluid searchTabs-section">
	<div class="div-search row" style="margin-bottom: 0;">
		<div class="container"><?php get_search_form(); ?></div>
	</div>
</section>
<?php	get_template_part('widgets/content', 'county'); ?> 
<?php	get_template_part('widgets/treatment', 'type'); ?> 
