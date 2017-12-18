<?php /* Template Name: Page Experts */ ?>
<?php while (have_posts()) : the_post(); ?>
	<section class="container-fluid header-posttype" style="margin-bottom: 0;">
		<div class="container">
			<div class="col-xs-12">
				<div class="row sub-menu">
					<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
					<span class="text-capitalize"> <?php the_title();?></span>
				</div>
				<div class="row">
					<h1>Ask An Dental Expert</h1>
				</div>
			</div>
		</div>
	</section> 	
	<?php $county_name = array('bangkok' , 'pattaya' , 'phuket' , 'krabi'); ?>

	<section class="container-fluid tab-single tab-experts affix-tab" data-spy="affix" data-offset-top="165">
		<div class="container">
			<nav class="navbar">
				<div id="myNavbar" class="col-xs-12 col-lg-10 col-lg-offset-1 col-sm-12 col-sm-offset-0" style="padding:0;">
				    <ul class="nav navbar-nav">
				    	<?php for ($j=0; $j < 4 ; $j++) {
				    	echo '<li><a href="#'.$county_name[$j].'">'.ucwords($county_name[$j]).'</a></li>';
				    	}?>
				    </ul>
				</div>
			</nav>
		</div>
	</section>
	<?php for ($i=0; $i < 4 ; $i++) {  
		$args   = array(
			'post_type'         => 'expert', 
			'posts_per_page'    => -1 ,
			'orderby'        	=> 'rand',
			'tax_query'         => array(
				array(
				    'taxonomy' => 'county_types',
				    'field'    => 'slug',
				    'terms'    => $county_name[$i],
				),
			),
  		);
		$loop = new WP_Query( $args );
		$count 	= $loop->post_count;
	?>
	<section class="container-fluid widgets-content section-experts">
		<div class="container">
			<?php if ($i == 0 ) { ?>
				<div id="<?php echo $county_name[0];?>" class="affix-first" data-spy="affix" data-offset-top="165">
					<div class="border-link row"></div>
				</div>
			<?php }else{ ?>
				<div id="<?php echo $county_name[$i];?>" class="col-xs-12 col-lg-10 col-lg-offset-1 col-sm-12 col-sm-offset-0 link-id">
					<div class="border-link row"></div>
				</div>
			<?php }?>
			<div class="row">
				<h3 class="text-center col-xs-12 text-uppercase"><?php echo $county_name[$i];?></h3>
				<div class="col-xs-12 col-lg-10 col-lg-offset-1 col-sm-12 col-sm-offset-0">
					<?php 
					if ($count == 3 ) {
						echo '<div class="row experts-row flex-center display-block-col-xs">';
					}elseif($count< 4 ){
						echo '<div class="row experts-row flex-center">';
					}else{
						echo '<div class="row experts-row">';
					}?>
					
					<?php 	while ( $loop->have_posts() ) : $loop->the_post(); 
						$name_expert 	= 	get_the_title();
						$link   		= 	get_permalink();
						$style_img 		=   'border: 1px solid #ddd;';
						$img 			=  	get_img_src_bypostid($post->ID, 'large');
					
						$expert_content = get_the_content();

					 	$area_expert 	= get_post_meta( get_the_ID(), 'area_expert', true );
					 	$count_area_expert = count($area_expert);
					?>
						<div class="col-xs-4 col-sm-4 col-md-3 expert-box">
							<div class="ex-body">
								<div class="ex-name"><h4><?php echo $name_expert; ?></h4></div>
								<a class="ex-img" href="<?php echo $link;?>">
									<img title="<?php echo $name_expert; ?>" src="<?php echo $img; ?>" style="width:100%; <?php echo $style_img;?>" />
									<div class="hover"></div>
									<span class="ex-area">
										<?php 
											$max_count = 0;
											for($ae = 0; $ae < $count_area_expert; $ae++){ 
											if ($max_count < 3) {
												if ($area_expert[$ae]['checkbox'] == 'yes' || $area_expert[$ae]['checkbox'] == 'on') {  
													echo $area_expert[$ae]['val'].', ';
													$max_count = $max_count + 1; 
												}	
											}
										} ?>
									...</span>
									<p class="ex-ask">Ask a Question <i class="fa fa-angle-double-right"></i></p>
								</a>
							</div>
						</div>
					<?php endwhile;?>
					</div>
				</div>
			</div>
		</div>	
	</section>	
	<? } ?>
<?php endwhile; ?>