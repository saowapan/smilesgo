<?php 
	$treatments 	= WP_Query_treatment();
   	$count_treatment    = count($treatments);  
?>
<section class="container-fluid widgets-content section-county">
	<div class="container">
		<div class="row">
			<h3 class="text-center col-xs-12">All Treatment</h3>
			<div class="col-xs-12">
				<div class="row county-row treatments-row">
					<?php  for ($i=0; $i < $count_treatment ; $i++) {
						if ($treatments[$i]['img'] == '') {
							$bg = 'background-image:url('.get_bloginfo('template_url').'/assets/images/treatments-type.jpg);';
						}else{
							$bg = 'background-image:url('.$treatments[$i]['img'].');';
						}?>
							<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 county-box">
								<div class="box-a" style="border: 1px solid #dddddd; cursor: pointer; <?=$bg?>">
									<form action="<?=home_url('/search-clinics/')?>" method="post" style="z-index:2;width: 100%; height: 100%;position: absolute;top: 0; left: 0;">
										<input type="hidden" name="cate_tre"  value="<?=$treatments[$i]['name']?>">
										<button type="submit" name="submit" style="width: 100%;height: 100%;opacity: 0;"></button>
									</form>
									<h2><?=$treatments[$i]['name']?></h2>
									<p>view all clinic <i class="fa fa-angle-double-right"></i></p>
									<div class="hover"></div>
								</div>
							</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>						