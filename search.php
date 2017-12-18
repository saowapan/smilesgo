<?php 
	$strlen = '300';
	$name_img_default 			= get_bloginfo('template_url') . '/assets/images/treatments-type.jpg';
?>
<section class="container-fluid header-posttype" >
	<div class="container">
		<div class="col-xs-12">
			<div class="row sub-menu">
				<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
				<span class="text-capitalize">Search Results</span>
			</div>
			<div class="row">
				<h1 class="col-sm-9 col-md-10 col-xs-12"><?php use Roots\Sage\Titles; ?><?= Titles\title(); ?></h1>
			</div>
			<?php  get_template_part('widgets/content', 'ribbon'); ?> 
		</div>
	</div>
</section>	
<?php if (!have_posts()) { // check has post ?>
	<section class="container-fluid content-posttype">
		<div class="container">
			<div class="row">
				<div class="left-bar col-lg-3 col-md-4 col-sm-5 col-xs-12">
					<div class="row search"><?php get_search_form(); ?></div>
				</div>
				<article class="article-post col-lg-9 col-md-8 col-sm-7 col-xs-12">
					<div class="row post-found">
						<h4>Sorry, Not Found<h4>	
					</div>
				</article>
			</div>
		</div>
	</section> 
<?php }else{ 
		// end if check has post ?.
    	$count = $wp_query->post_count; 
    ?>
	<section class="container-fluid content-posttype">
		<div class="container">
			<div class="row">
				<div class="left-bar col-lg-3 col-md-4 col-sm-5 col-xs-12">
					<div class="row search"><?php get_search_form(); ?></div>
				</div>
				<article class="article-post col-lg-9 col-md-8 col-sm-7 col-xs-12">
					<div class="row post-found">
						<h4><?php echo $count; ?> Search Results Found<h4>	
					</div>
					<ul class="row post-list" style="padding: 0; list-style: none; margin-bottom: 30px;">
					<?php while ( $wp_query->have_posts() ) :  $wp_query->the_post(); 
							$title 	= 	get_the_title();
							$img 	=  	get_img_src_bypostid($post->ID, 'large');
							if (!$img) { $img = $name_img_default; }

							$about_clinic   = get_post_meta( get_the_ID(), 'about_clinic', true );
							$expert_content = get_the_content();
							$content_show   = '';
							if ($about_clinic) {
								$about 	    = $about_clinic['about'];
								if(strlen($about ) > $strlen) { 
									$content_show  = iconv_substr($about , 0, $strlen ,"UTF-8"). '...'; 
								}else{
									$content_show  = $about;
								} 
							}elseif ($expert_content) {
								if(strlen($expert_content ) > $strlen) { 
									$content_show  = iconv_substr($expert_content , 0, $strlen ,"UTF-8"). '...'; 
								}else{
									$content_show  = $expert_content;
								} 
							}
					?>
						<li class="col-xs-12 post-item">
							<div class="col-xs-5 col-sm-12 col-md-4">
								<a href="<?=get_permalink();?>">
									<img class="img-responsive" src="<?php echo $img; ?>">
								</a>
							</div>
							<div class="contentpost-item col-xs-7 col-sm-12 col-md-8">
								<div class="headpost">
									<h3><a href="<?=get_permalink();?>"><?php echo $title; ?></a></h3>
								</div>	
								<p><?php echo $content_show; ?></p>
								<div class="footertpost">
									<div class="row">
										<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
											<a class="btn-main btn-custom" href="<?=get_permalink();?>">View Details</a>
										</div>
									</div>
								</div>
							</div>		
						</li>
					<?php endwhile; ?>
					</ul>
				</article>
			</div>
		</div>
	</section>
<?php } ?>