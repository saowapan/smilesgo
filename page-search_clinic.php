<?php if (isset($_POST['submit']) || isset($_POST['category'])) { 
	$category = $_POST['category'];
	if ($category == 'bangkok' ) {
		$active_b = 'active';
	}elseif ($category == 'pattaya' ) {
		$active_pa = 'active';
	}elseif ($category == 'phuket' ) {
		$active_p = 'active';
	}elseif ($category == 'krabi' ) {
		$active_k = 'active';
	}else{
		$active_a = 'active';
	}
}else{
	$active_a = 'active';
}?>
<section class="container-fluid header-posttype" style="margin:0;">
	<div class="container">
		<div class="col-xs-12">
			<div class="row sub-menu">
				<span><a href="<?= esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> </span>
				<span><a href="<?= esc_url(home_url('/clinics')); ?>"> Dentistry Clinic</a> <i class="fa fa-angle-right"></i> </span>
				<span> Search Clinic</span>
			</div>
			<div class="row">
				<h1 class="col-sm-9 col-md-10 col-xs-12">Search Clinics And Hospitals</h1>
			</div>
			<?php  get_template_part('widgets/content', 'ribbon'); ?> 
		</div>
	</div>
</section>
<section class="container-fluid searchTabs-section">
	<div class="div-search row">
		<div class="container">
			<?php get_search_form(); ?>
		</div>
	</div>
	<div class="container">
		<div class="navbar tabtop-affix" data-spy="affix" data-offset-top="200">
			<ul class="nav nav-tabs">
		  		<li class="tab-all <?=$active_a?>">
		  			<a data-toggle="tab" href="#" onClick = "infohub_send('all');" class="text-center">All</a> 
		    	</li>
		    	<li class="tab-bangkok <?=$active_b?>">
		    		<a data-toggle="tab" href="#" onClick = "infohub_send('bangkok'); " class="text-center">Bangkok</a>
		    	</li>
		    	<li class="tab-pattaya <?=$active_pa?>">
		    		<a data-toggle="tab" href="#" onClick = "infohub_send('pattaya');" class="text-center">Pattaya</a>
		    	</li>
		    	<li class="tab-phuket <?=$active_p?>"> 
		    		<a data-toggle="tab" href="#" onClick = "infohub_send('phuket');" class="text-center">Phuket</a> 			
		    	</li>
		    	<li class="tab-krabi <?=$active_k?>">       
		    		<a data-toggle="tab" href="#" onClick = "infohub_send('krabi');"  class="text-center">Krabi</a>
		    	</li>
			</ul>
	  	</div>
	</div>
</section>
<section id="postClinicSection" class="container-fluid content-posttype">
	<div class="container">
		<div class="row">
			<div class="posttype-leftbar left-bar col-lg-3 col-md-4 col-sm-5 col-xs-12" style="padding-bottom:15px;">
				<div class="filter_treatment">							
					<h4 class="text-uppercase xs-hide" style="font-size: 14px;">Select treatment to narrow down</h4>
					<button  type="button" data-toggle="collapse" data-target="#filter_tre"  class="mobile collapsed">Select treatment to narrow down
						<i class="fa fa-angle-up "></i>
					</button>
					<ul class="navleftbar collapse in" id="filter_tre">
						<?php if($category){ ?>
							<script type="text/javascript">
								jQuery(document).on('ready', function() {
									infohub_leftbar('<?=$category?>','all');
								});
							</script>
						<?php }else{ ?>
							<script type="text/javascript">
								jQuery(document).on('ready', function() {
									infohub_leftbar('all','all'); 
								});
							</script>
						<?php } ?>
					</ul>
				</div>	
			</div>
			<article class="article-post col-lg-9 col-md-8 col-sm-7 col-xs-12">
				<div id="loadPage" class="row text-center">
					<img src="<?=get_bloginfo('template_url').'/assets/images/ring-alt.svg'?>">
				</div>
				<div id="post-found" class="row typefound flex-between">
					<?php if($category){ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								infohub_countcounty('<?=$category?>');
							});
						</script>
					<?php }else{ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								infohub_countcounty('all');
							});
						</script>
					<?php } ?>
				</div>
				<div id="postClinic-container" class="row post-list">
					<?php if($category){ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								infohub_county('<?=$category?>');
							});
						</script>
					<?php }else{ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								infohub_county('all');
							});
						</script>
					<?php } ?>
				</div>
				<div id="postClinic-moreBtn" class="row" style="margin-top:30px;">
					<?php if($category){ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								display_btncounty('<?=$category?>');
							});
						</script>
					<?php }else{ ?>
						<script type="text/javascript">
							jQuery(document).on('ready', function() {
								display_btncounty('all');
							});
						</script>
					<?php } ?>
				</div>
			</article>	
		</div>
	</div>	
</section>	