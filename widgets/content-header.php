<section class="section-header widgets-content" style="background-image:url(<? build_url('/assets/images/headerbg.jpg'); ?>)">
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9 col-md-6 content-header">
					<h1>Find healthcare in Thailand</h1>
					<p><i class="fa fa-check"></i>Internationally accredited hospitals</p>
					<p><i class="fa fa-check"></i>Healthcare for every budget</p>
					<p><i class="fa fa-check"></i>Dedicated personal assistance</p>
					<p><i class="fa fa-check"></i>Completely free consultations</p>
					<a href="<?= esc_url(home_url('/about/')); ?>">About Us<i class="fa fa-play"></i></a>
				</div>
			</div>
		</div>
		<div class="container section-search">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab"  href="#lookingfor">I am looking for</a></li>
					    <li><a data-toggle="tab" href="#location">Location</a></li>
					</ul>
					<div class="tab-content">
						<div id="lookingfor" class="tab-pane active"><?php dynamic_sidebar('sidebar-primary'); ?></div>
						<form id="location" class="row tab-pane" action="<?=home_url('/search-clinics')?>" method="post">
							<div class="col-xs-12 input-top">
								<select name="cate_tre" style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
									<?php $treatments = WP_Query_treatment();
										foreach ($treatments as $treatment){ ?>
											<option value="<?=$treatment['name']?>"><?php echo $treatment['name'];?></option>
										<?php }
									?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-9 map-date">
								<div class="row">
									<span class="input-left col-xs-12 col-sm-66">
										<select name="category"  style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
										<?php	
											$tax_terms = get_terms('county_types');
											foreach ($tax_terms as $tax_term){
												$name_county = $tax_term->name; 
												$name_slug = $tax_term->slug; 
												?>
												<option value="<?php echo $name_slug;?>"><?php echo $name_county;?></option>
											<?php } 
										?>
										</select>
									</span>
								</div>
							</div>
							<div class="input-right col-xs-12 col-sm-3">
								<input class="btn-submit btn-custom" type="submit" name="submit" value="Search">
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
