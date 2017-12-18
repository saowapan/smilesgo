<?php /* Template Name: Page Home */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php	get_template_part('widgets/content', 'header'); ?> 
	<?php	get_template_part('widgets/content', 'county'); ?> 
	<?php	get_template_part('widgets/treatment', 'pop'); ?> 
	<?php	get_template_part('widgets/content', 'get_quote'); 	?> 
	<?php	get_template_part('widgets/content', 'helpyou'); 	?>
<?php endwhile; ?>
