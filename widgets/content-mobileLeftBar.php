<section class="widgets-content mobileLeftBar">
		<div class="container section-search">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab"  href="#lookingfor">I am looking for</a></li>
					    <li><a data-toggle="tab" href="#location">Location</a></li>
					</ul>
					<div class="tab-content">
						<div id="lookingfor" class="tab-pane active"><?php dynamic_sidebar('sidebar-primary'); ?></div>
						<form id="location" class="row tab-pane" action="<?=home_url('/search-clinic-submit-form/?submit')?>" method="post" >
							<div class="col-xs-12 input-top">
								<select name="data2[]" style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
									<option value="">Select Treatment</option>
									<option value="">All</option>
									<?php $treatments = WP_Query_treatment();
										foreach ($treatments as $treatment){ ?>
											<option value="<?php echo $treatment['name'];?>"><?php echo $treatment['name'];?></option>
										<?php }
									?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-9 map-date">
								<div class="row">
									<span class="input-left col-xs-12 col-sm-66">
										<select name="data[]"  style="background-image:url(<? build_url('/assets/images/down-arrow.png'); ?>)">
											<option value="">Select County</option>
											<option value="">All</option>
										<?php	
											$tax_terms = get_terms('county_types');
											foreach ($tax_terms as $tax_term){
												$name_county = $tax_term->name; ?>
												<option value="<?php echo $name_county;?>"><?php echo $name_county;?></option>
											<?php } // foreach
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
</section>
