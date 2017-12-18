<?php 
	$images_name = array('bangkok' , 'pattaya' , 'phuket' , 'krabi');
?>
<section class="container-fluid widgets-content section-county">
	<div class="container">
		<div class="row">
			<h3 class="text-center col-xs-12">Find a Clinic for Destinations</h3>
			<div class="col-xs-12 col-lg-12 col-lg-offset-0 col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 ">
				<div class="row county-row">
					<?php  for ($i=0; $i < 4 ; $i++) { 
						$bg = 'background-image:url('.get_bloginfo('template_url').'/assets/images/'.$images_name[$i].'.jpg'.');';
						?>
						<div class="col-xs-6 col-sm-6 col-lg-3 county-box">
							<div class="box-a" style="border: 1px solid #dddddd; cursor: pointer; <?=$bg?>">
								<form action="<?=home_url('/search-clinic/')?>" method="post" style="z-index:2;width: 100%; height: 100%;position: absolute;top: 0; left: 0;">
									<input type="hidden" name="category"  value="<?=$images_name[$i]?>">
									<button type="submit" name="submit" style="width: 100%;height: 100%;opacity: 0;"></button>
								</form>
								<h4><?=$images_name[$i]?></h4>
								<p>view all clinic <i class="fa fa-angle-double-right"></i></p>
								<div class="hover"></div>
							</div>
						</div>
						<?php
					 } ?>
				</form>
			</div>
		</div>
	</div>
</section>