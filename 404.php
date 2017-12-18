<?php get_template_part('templates/page', 'header'); ?>
<section class="container-fluid">
	<div class="container">
		<div class="text-center">
			<h1>Not Found</h1>
		</div>
		<div class="alert alert-warning">
		  	<?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?>
		</div>
	</div>
</section>

<?php get_search_form(); ?>
