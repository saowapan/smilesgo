<?php 
//Enqueue Ajax Scripts
function enqueue_review_ajax_scripts() {
    wp_register_script( 'review-ajax-js', get_bloginfo('template_url') . '/assets/scripts/loadReview.js', array( 'jquery' ), '', true );
    wp_localize_script( 'review-ajax-js', 'ajax_review_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'review-ajax-js' );
}
add_action('wp_enqueue_scripts', 'enqueue_review_ajax_scripts');

//Add Ajax Actions : Show Review
add_action('wp_ajax_show_review', 'ajax_show_review');
add_action('wp_ajax_nopriv_show_review', 'ajax_show_review');
function ajax_show_review()
{
	display_review();
}
//Add Ajax Actions : Show Review More
add_action('wp_ajax_more_showreview', 'ajax_more_showreview');
add_action('wp_ajax_nopriv_more_showreview', 'ajax_more_showreview');
function ajax_more_showreview()
{
	display_review();
}
function display_review(){
	$query_data = $_POST;
	$name_clinic = (isset($query_data['name_clinic']) ) ? $query_data['name_clinic'] : '';
	$num = (isset($query_data["num"])) ? $query_data["num"] : 3;
    $page = (isset($query_data['pageNumber'])) ? $query_data['pageNumber'] : 0;

    header("Content-Type: text/html");
    wp_reset_query(); 

    $args_review = array(
        'post_type'     	=> 'writereview', 
		'posts_per_page'  	=> $num, 
		'paged' 		  	=> $page, 
        'post_status'   	=> 'publish',
        'meta_query'    	=> array(
            array(
                'key'   => 'name_clinic',
                'value' => $name_clinic,
            )
        )
    );
	$loop_review = new WP_Query( $args_review ); 
	if( $loop_review->have_posts() ):
		while( $loop_review->have_posts() ): $loop_review->the_post();
			$name_details 	 = get_post_meta( get_the_ID(), 'name', true );
			$email_details 	 = get_post_meta( get_the_ID(), 'email', true );
			$stars_point 	 = get_post_meta( get_the_ID(), 'stars_point', true );
			
			$message_details = get_the_content();	
			if (empty($message_details)){
				$message_details = 'No Comments';
			} ?>

			<li class="review-item">
				<div class="review-header flex-between">
					<h5><?php echo $name_details; ?></h5>
					<div>
						<?php 
							for ($star_count = 0 ; $star_count < $stars_point ; $star_count++) { 
								echo '<i class="fa fa-star"></i>';
							}
							for ($nostar=0; $nostar < 5-$star_count; $nostar++) { 
								echo '<i class="fa fa-star-o"></i>';
							} 
						?>
						<p><?php echo get_the_date(); ?></p>
					</div>
				</div>
				<div class="review-body">
					<p><?php echo $message_details; ?></p>
				</div>	
				<div class="review-footer">
					<p class="text-right"><?php echo $email_details; ?></p>
				</div>
			</li>	
		<?php endwhile; ?>
	<?php else: ?>
		<div id="no_more_review" class="row"></div>
		<h4 class="text-center col-xs-12" style="color: #005eb8;font-weight: bold;margin-bottom: 30px;">Sorry, we don't have review</h4>
	<?php endif;
	die();

}

function singleclinic_expert($getname,$k){
	$args_expert   = array(
        'post_type'         => 'expert', 
        'name' => $getname
    ); 
    $loop_exp = new WP_Query( $args_expert);
    while ( $loop_exp->have_posts() ) : $loop_exp->the_post();
    	$img =   get_img_src_bypostid($post->ID, 'medium');   
    	$expert_content = get_the_content();

    	$contact_expert = get_post_meta( get_the_ID(), 'contact_expert', true );
    	$email_exp = $contact_expert['email'];

    	$area_expert = get_post_meta( get_the_ID(), 'area_expert', true );
    	$count_area_expert 	= count($area_expert);	
  
    endwhile; ?>

	<div class="col-xs-4 col-sm-6 col-md-4 dentist-item">
		<? if (empty($img)) { ?>
			<img class="img-responsive"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yODcsMjgyLjFoLTc3LjhjMTIuMSwzNi42LDEsNTMuMywxLDUzLjNsMjYuOSw2LjFoMjJsMjYuOS02LjFDMjg2LDMzNS40LDI3NC45LDMxOC43LDI4NywyODIuMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzAxOTg5NzsiIGQ9Ik0yNDguMSw0OTYuMmM3MC4yLDAsMTMzLjYtMjkuMiwxNzguNy03NmMtMi44LTE1LjEtNS42LTI4LjktOC4zLTM3LjQgIGMtOC41LTI3LjMtODEuMi00OS4zLTE3MC44LTQ5LjNzLTE2MS41LDIyLTE3MCw0OS4zYy0yLjYsOC41LTUuNSwyMi4yLTguMywzNy40QzExNC41LDQ2NywxNzcuOSw0OTYuMiwyNDguMSw0OTYuMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0QwRUFFRjsiIGQ9Ik0xOTguOCwzMzYuNWMwLDAtMTkuMiw0NCw0OSw0NHM0OS43LTQ0LDQ5LjctNDRsLTQ5LjQtNS44TDE5OC44LDMzNi41eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTJBMzc5OyIgZD0iTTIxMC4yLDMzNS40YzAsMC0xNC44LDM2LjcsMzcuNiwzNi43czM4LjItMzYuNywzOC4yLTM2LjdMMjQ3LjgsMzE3TDIxMC4yLDMzNS40eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRjRCMzgyOyIgZD0iTTMzNi40LDE3NS4yYzAtOTIuNC0zOS41LTExMy42LTg4LjMtMTEzLjZjLTQ4LjcsMC04OC4zLDIxLjItODguMywxMTMuNmMwLDMxLjMsNi4yLDU1LjgsMTUuNSw3NC43ICBjMjAuNCw0MS42LDU1LjcsNTYuMSw3Mi44LDU2LjFzNTIuNC0xNC41LDcyLjgtNTYuMUMzMzAuMiwyMzEsMzM2LjQsMjA2LjUsMzM2LjQsMTc1LjJ6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNBMUQxMjsiIGQ9Ik0xNjUuNSwxNDAuOGMtNC4yLDEwLjktNS42LDI0LjQtNS42LDM3LjVjMCwwLDguOC0xLjksOC44LDIuNmwyLjgsMjcuNmwzLjktMS45ICAgYy0wLjItMjMsNC45LTY4LDQuOS02OEwxNjUuNSwxNDAuOHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzQTFEMTI7IiBkPSJNMzMwLjgsMTQwLjhjNC4yLDEwLjksNS42LDI0LjQsNS42LDM3LjVjMCwwLTguOC0xLjktOC44LDIuNmwtMi44LDI3LjZsLTMuOS0xLjkgICBjMC4yLTIzLTQuOS02Ni4yLTQuOS02Ni4yTDMzMC44LDE0MC44eiIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMjI1LjQsMTM2LjMgMjI1LjQsMTY2LjMgMjc2LjQsMTM0LjggICIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMjA5LjksMTM2LjMgMjA5LjksMTY2LjMgMjYwLjksMTM0LjggICIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMTk0LjQsMTM2LjMgMTk0LjQsMTY2LjMgMjQ1LjQsMTM0LjggICIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiMwMTk4OTc7IiBkPSJNMTY0LDc4LjNjMCw4LjYtNCw3Ni44LTQsNzYuOGgxNzYuNWMwLDAtNC02OC4yLTQtNzYuOGMwLTQuMy0zNS41LTIzLTgzLjMtMjMuMSAgQzIwMC43LDU1LjIsMTY0LDczLjksMTY0LDc4LjN6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNzAuNCwyMzguN2MtOC40LDEuNC0xNC40LDAuMS0xOS4xLTI3LjdzMS43LTMxLjUsMTAuMS0zMi45TDE3MC40LDIzOC43eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0zMjUuOSwyMzguN2M4LjQsMS40LDE0LjMsMC4xLDE5LjEtMjcuN2M0LjgtMjcuOC0xLjctMzEuNS0xMC4xLTMyLjlMMzI1LjksMjM4Ljd6Ii8+CjwvZz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTMxMS4zLDIwOS44Yy0wLjMsMC0wLjYtMC4xLTAuOC0wLjJjLTEtMC41LTEuNC0xLjctMS0yLjdsMTUtMzIuM2MwLjUtMSwxLjctMS40LDIuNy0xICAgYzEsMC41LDEuNCwxLjcsMSwyLjdsLTE1LDMyLjNDMzEyLjgsMjA5LjMsMzEyLjEsMjA5LjgsMzExLjMsMjA5Ljh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTE4NC45LDIwOS44Yy0wLjgsMC0xLjUtMC40LTEuOC0xLjJsLTE1LTMyLjNjLTAuNS0xLDAtMi4yLDEtMi43czIuMiwwLDIuNywxbDE1LDMyLjMgICBjMC41LDEsMCwyLjItMSwyLjdDMTg1LjQsMjA5LjcsMTg1LjEsMjA5LjgsMTg0LjksMjA5Ljh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTMyMC45LDI0OS45bC01LjgtNDQuNWwtNjctMTAuM2wtNjcsMTAuMmwtNS44LDQ0LjVsMCwwYzIwLjQsNDEuNiw1NS43LDU2LjEsNzIuOCw1Ni4xICAgUzMwMC41LDI5MS41LDMyMC45LDI0OS45TDMyMC45LDI0OS45eiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
		<? } else { ?>
			<div class="img-dentists flex-center"><img class="img-responsive" src="<?=$img?>"/></div>
		<? } ?>	

		<h4><?=$getname?></h4>
		<p>Orthodontist</p>

		<button type="button" class="btn-main btn-custom" data-toggle="modal" data-target="#dentist-<?=$k?>">View Detail</button>
		<div class="modal fade" id="dentist-<?=$k?>" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">	
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?=$getname?></h4>
					</div>
					<div class="modal-body">
					<? if (empty($img)) { ?>
							<img class="img-popup img-responsive"  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yODcsMjgyLjFoLTc3LjhjMTIuMSwzNi42LDEsNTMuMywxLDUzLjNsMjYuOSw2LjFoMjJsMjYuOS02LjFDMjg2LDMzNS40LDI3NC45LDMxOC43LDI4NywyODIuMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzAxOTg5NzsiIGQ9Ik0yNDguMSw0OTYuMmM3MC4yLDAsMTMzLjYtMjkuMiwxNzguNy03NmMtMi44LTE1LjEtNS42LTI4LjktOC4zLTM3LjQgIGMtOC41LTI3LjMtODEuMi00OS4zLTE3MC44LTQ5LjNzLTE2MS41LDIyLTE3MCw0OS4zYy0yLjYsOC41LTUuNSwyMi4yLTguMywzNy40QzExNC41LDQ2NywxNzcuOSw0OTYuMiwyNDguMSw0OTYuMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0QwRUFFRjsiIGQ9Ik0xOTguOCwzMzYuNWMwLDAtMTkuMiw0NCw0OSw0NHM0OS43LTQ0LDQ5LjctNDRsLTQ5LjQtNS44TDE5OC44LDMzNi41eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRTJBMzc5OyIgZD0iTTIxMC4yLDMzNS40YzAsMC0xNC44LDM2LjcsMzcuNiwzNi43czM4LjItMzYuNywzOC4yLTM2LjdMMjQ3LjgsMzE3TDIxMC4yLDMzNS40eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRjRCMzgyOyIgZD0iTTMzNi40LDE3NS4yYzAtOTIuNC0zOS41LTExMy42LTg4LjMtMTEzLjZjLTQ4LjcsMC04OC4zLDIxLjItODguMywxMTMuNmMwLDMxLjMsNi4yLDU1LjgsMTUuNSw3NC43ICBjMjAuNCw0MS42LDU1LjcsNTYuMSw3Mi44LDU2LjFzNTIuNC0xNC41LDcyLjgtNTYuMUMzMzAuMiwyMzEsMzM2LjQsMjA2LjUsMzM2LjQsMTc1LjJ6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6IzNBMUQxMjsiIGQ9Ik0xNjUuNSwxNDAuOGMtNC4yLDEwLjktNS42LDI0LjQtNS42LDM3LjVjMCwwLDguOC0xLjksOC44LDIuNmwyLjgsMjcuNmwzLjktMS45ICAgYy0wLjItMjMsNC45LTY4LDQuOS02OEwxNjUuNSwxNDAuOHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzQTFEMTI7IiBkPSJNMzMwLjgsMTQwLjhjNC4yLDEwLjksNS42LDI0LjQsNS42LDM3LjVjMCwwLTguOC0xLjktOC44LDIuNmwtMi44LDI3LjZsLTMuOS0xLjkgICBjMC4yLTIzLTQuOS02Ni4yLTQuOS02Ni4yTDMzMC44LDE0MC44eiIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMjI1LjQsMTM2LjMgMjI1LjQsMTY2LjMgMjc2LjQsMTM0LjggICIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMjA5LjksMTM2LjMgMjA5LjksMTY2LjMgMjYwLjksMTM0LjggICIvPgoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzNBMUQxMjsiIHBvaW50cz0iMTk0LjQsMTM2LjMgMTk0LjQsMTY2LjMgMjQ1LjQsMTM0LjggICIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiMwMTk4OTc7IiBkPSJNMTY0LDc4LjNjMCw4LjYtNCw3Ni44LTQsNzYuOGgxNzYuNWMwLDAtNC02OC4yLTQtNzYuOGMwLTQuMy0zNS41LTIzLTgzLjMtMjMuMSAgQzIwMC43LDU1LjIsMTY0LDczLjksMTY0LDc4LjN6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNzAuNCwyMzguN2MtOC40LDEuNC0xNC40LDAuMS0xOS4xLTI3LjdzMS43LTMxLjUsMTAuMS0zMi45TDE3MC40LDIzOC43eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0zMjUuOSwyMzguN2M4LjQsMS40LDE0LjMsMC4xLDE5LjEtMjcuN2M0LjgtMjcuOC0xLjctMzEuNS0xMC4xLTMyLjlMMzI1LjksMjM4Ljd6Ii8+CjwvZz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTMxMS4zLDIwOS44Yy0wLjMsMC0wLjYtMC4xLTAuOC0wLjJjLTEtMC41LTEuNC0xLjctMS0yLjdsMTUtMzIuM2MwLjUtMSwxLjctMS40LDIuNy0xICAgYzEsMC41LDEuNCwxLjcsMSwyLjdsLTE1LDMyLjNDMzEyLjgsMjA5LjMsMzEyLjEsMjA5LjgsMzExLjMsMjA5Ljh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTE4NC45LDIwOS44Yy0wLjgsMC0xLjUtMC40LTEuOC0xLjJsLTE1LTMyLjNjLTAuNS0xLDAtMi4yLDEtMi43czIuMiwwLDIuNywxbDE1LDMyLjMgICBjMC41LDEsMCwyLjItMSwyLjdDMTg1LjQsMjA5LjcsMTg1LjEsMjA5LjgsMTg0LjksMjA5Ljh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTRGMEYyOyIgZD0iTTMyMC45LDI0OS45bC01LjgtNDQuNWwtNjctMTAuM2wtNjcsMTAuMmwtNS44LDQ0LjVsMCwwYzIwLjQsNDEuNiw1NS43LDU2LjEsNzIuOCw1Ni4xICAgUzMwMC41LDI5MS41LDMyMC45LDI0OS45TDMyMC45LDI0OS45eiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
					<? } else { ?>
							<img class="img-popup img-responsive" src="<?=$img?>"/>
					<? } 
						echo '<h4>Email : <a class="break-word" href="mailto:'.$email_exp.'" style="color: #005eb8;text-transform: lowercase;">'.$email_exp.'</a></h4>';
						echo '<h4 class="area-exp"><strong>Area Expert : </strong>';
					for($ae = 0; $ae < $count_area_expert; $ae++){ 
						if ($area_expert[$ae]['checkbox'] == 'yes' || $area_expert[$ae]['checkbox'] == 'on') {  
							echo '<span>'.$area_expert[$ae]['val'].'</span>';
							echo '<span>, </span>';
						}
					}
					if ($area_expert['other']) {
						echo ', '.$area_expert['other'];
					}
						echo '</h4>';
					?>
						<p><?=$expert_content?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-main btn-custom" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>	
	</div>	
<?php } 
function contact_barright($contact_clinic){ 
	$email 	= $contact_clinic['email'];		
	$email2 = $contact_clinic['email2'];
	$phone 	= $contact_clinic['phone'];
	$phone2 = $contact_clinic['phone2'];?>
	<div class="contact">
		<button  type="button" data-toggle="collapse" data-target="#contact-details"  class="btn-main btn-custom collapsed">Contact details <i class="fa fa-angle-up"></i></button>
		<div id="contact-details" class="collapse in">
			<?php 
				if ($email) {
					echo '<p><i class="fa fa-envelope" style="width: 20px;"></i> : <a class="break-word" href="mailto:'.$email.'">'.$email.'</a></p>';
				}
				if ($email2) {
					echo '<p><i class="fa fa-envelope" style="width: 20px;"></i> : <a class="break-word"  href="mailto:'.$email2.'">'.$email2.'</a></p>';
				}
				if ($phone) {
					echo '<p><i class="fa fa-phone" style="width: 20px;"></i> : <a class="break-word"  href="tel:'.$phone.'">'.$phone.'</a></p>';
				}
				if ($phone2) {
					echo '<p><i class="fa fa-phone" style="width: 20px;"></i> : <a class="break-word"  href="tel:'.$phone2.'">'.$phone2.'</a></p>';
				}
			?>
		</div>
	</div>
<?php }

function operation_time_fuc ($time_clinic){
	$show_day    = array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
	echo '<div class="operation"><p>Operation Hours</p>';
	echo '<table style="width: 100%;">';
	for ($day=1; $day <= 7 ; $day++) { 
		if ($time_clinic[$day]['start']) {
		echo '<tr><td>'.$show_day[$day].'</td><td>'.$time_clinic[$day]['start'];
			if ($time_clinic[$day]['end']) {
				echo ' - '.$time_clinic[$day]['end'];
			}
			echo '</td>';
		}
	}
	echo '</table>';
	echo '</div>';
}

function map_call_fun($latitude,$longitude){
	echo '<div class="map">';
	echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXc9gz0hppKiIu3FFvovSMGNfI3wiIMD0" type="text/javascript"></script>';
	echo '<script type="text/javascript">
	    	var myCenter = new google.maps.LatLng('.$latitude.', '.$longitude.');
	    	function initialize() {     
	        	var mapOptions = {  
	                zoom: 15,
	                scrollwheel: false,
	                center: myCenter,
	                mapTypeId:google.maps.MapTypeId.ROADMAP
	            };
		        var mapElement = document.getElementById("map");
		        var map = new google.maps.Map(mapElement, mapOptions);
	  
		        var image = "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDM0LjM5OCAzNC4zOTgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDM0LjM5OCAzNC4zOTg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4Ij4KPGc+Cgk8ZyBpZD0iYzI4X2dlb2xvY2FsaXphdGlvbiI+CgkJPHBhdGggZD0iTTE3LjIwMiwwQzEwLjc0OSwwLDUuNTE1LDUuMTk3LDUuNTE1LDExLjYwN2MwLDMuMjgxLDMuMjE4LDkuMTU2LDMuMjE4LDkuMTU2bDguMDM5LDEzLjYzNWw4LjM4Ni0xMy40NzcgICAgYzAsMCwzLjcyNi01LjYwNSwzLjcyNi05LjMxNEMyOC44ODMsNS4xOTcsMjMuNjUzLDAsMTcuMjAyLDB6IE0xNy4xNDcsMTguMDAyYy0zLjY5NSwwLTYuNjg4LTIuOTk0LTYuNjg4LTYuNjkzICAgIGMwLTMuNjkzLDIuOTkzLTYuNjg2LDYuNjg4LTYuNjg2YzMuNjkzLDAsNi42OSwyLjk5Miw2LjY5LDYuNjg2QzIzLjgzNywxNS4wMDgsMjAuODQsMTguMDAyLDE3LjE0NywxOC4wMDJ6IiBmaWxsPSIjMDA1ZWI4Ii8+CgkJPHBvbHlnb24gcG9pbnRzPSIxOC41MzksNy4yMzMgMTUuODk4LDcuMjMzIDE1Ljg5OCwxMC4yNDIgMTIuODIzLDEwLjI0MiAxMi44MjMsMTIuODg3IDE1Ljg5OCwxMi44ODcgMTUuODk4LDE1Ljk4NSAgICAgMTguNTM5LDE1Ljk4NSAxOC41MzksMTIuODg3IDIxLjU3NiwxMi44ODcgMjEuNTc2LDEwLjI0MiAxOC41MzksMTAuMjQyICAgIiBmaWxsPSIjMDA1ZWI4Ii8+Cgk8L2c+Cgk8ZyBpZD0iQ2FwYV8xXzE0Nl8iPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=";
		        var marker = new google.maps.Marker({ 
		        	position: myCenter,
		        	map: map,
		        	icon : image
	        	});
			}
			google.maps.event.addDomListener(window, "load", initialize);
		</script>';
	echo '<div id="map"  style="width: 100%;height: 200px;"></div>';
	echo '</div>';
}
?>