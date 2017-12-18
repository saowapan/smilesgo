<?php 
function promotion_meta_boxes() {
    add_meta_box( 'treatment_value', __( 'Name Promotion ( whene add more promotion please double click update) ', '' ), 'promotion_callback', 'promotion', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'promotion_meta_boxes' );
function promotion_callback( $post ) { 
	global $post;
    $promotions 	= get_post_meta($post->ID,'promotions',true); 

    $p = 0;
    if(is_array($promotions)){
        foreach ( $promotions as $name ) {
            if ( isset( $name['name'] ) ) {
                printf( '<p><label style="width: 124px;display: inline-block;">Name Promotion : </label><input style="width: 400px;" type="text" name="promotions[%1$s][name]" value="%2$s" /><a class="button-secondary removepromotion" style="margin-left:10px;background-color: #ffc4c4;">%3$s</a></p>', $x, $name['name'], __( 'Remove' ) );
                $p = $p +1;
            }
        }
    } ?>	
   	<span id="here_promotion"></span>
	<a class="button-secondary addpromotion"><?php _e('Add More Promotion'); ?></a>
	<script>
	    jQuery(document).ready(function(){
	        var k = <? echo $p ;?>;
	        jQuery(".addpromotion").click(function() {
	            k = k + 1;
	            jQuery('#here_promotion').append('<p><label style="width: 124px;display: inline-block;">Name Promotion : </label><input style="width: 400px;" type="text" name="promotions['+k+'][name]" value="" /><a class="button-secondary removepromotion" style="margin-left:10px;background-color: #ffc4c4;">Remove</a></p>' );
	            return false;
	        });
	        jQuery(".removepromotion").live('click', function() {
	            jQuery(this).parent().remove();
	        });
	    });
	</script>
    <?php wp_nonce_field('promotion_nonce_action', 'promotion_nonce_name'); 
}
function save_data_promotion( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !isset( $_POST['promotion_nonce_name'] ) || !wp_verify_nonce( $_POST['promotion_nonce_name'], 'promotion_nonce_action' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    if( isset( $_POST['promotions'] ) ) {
        update_post_meta( $post_id, 'promotions', $_POST['promotions'] );
    }	
}
add_action( 'save_post', 'save_data_promotion' );
?>