<?php 
function treatment_meta_boxes() {
    add_meta_box( 'treatment_value', __( 'Name Treatment ( whene add more treatment please double click update) ', '' ), 'treatment_callback', 'treatment', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'treatment_meta_boxes' );
function treatment_callback( $post ) { 
	global $post;
    $treatments 	= get_post_meta($post->ID,'treatments',true); 
    $x = 0;
    if(is_array($treatments)){
        foreach ( $treatments as $name ) {
            if ( isset( $name['name'] ) ) {
                if ($name['popular'] == '') {
                   $checked = '';
                }else{ 
                    $checked    = 'checked=checked'; 
                }
                echo '<p>';
                echo '<label style="width: 135px;display: inline-block;">Name Treatment : </label>';
                echo '<input style="width: 400px;" type="text" name="treatments['.$x.'][name]" value="'.$name['name'].'" />';
                echo '<input class="check_pop" type="checkbox" name="treatments['.$x.'][popular]" value="'.$name['popular'].'"/ '.$checked.' style="margin: -5px 5px 0 10px">popular</br>';
                echo '<label style="width: 135px;display: inline-block;">URL Picture : </label>';
                echo '<input style="width: 400px;" type="text" name="treatments['.$x.'][img]" value="'.$name['img'].'" />';
                echo '<a class="button-secondary removetreatment" style="margin-left:10px; background-color: #ffc4c4;">Remove</a>';
                echo '</p>';
                $x = $x +1;
            }
        }
    } ?>	
   	<span id="here_treatment"></span>
	<a class="button-secondary addtreatment"><?php _e('Add More Treatment'); ?></a>
	<script>
	    jQuery(document).ready(function(){
	        var k = <? echo $x ;?>;
	        jQuery(".addtreatment").click(function() {
	            k = k + 1;
	            jQuery('#here_treatment').append('<p><label style="width: 135px;display: inline-block;">Name Treatment : </label><input style="width: 400px;" type="text" name="treatments['+k+'][name]" value="" /><input type="checkbox" name="treatments['+k+'][popular]" style="margin: -5px 5px 0 10px"/>popular</br><label style="width: 135px;display: inline-block;">URL Picture :</label><input style="width: 400px;" type="text" name="treatments['+k+'][img]" value="" /><a class="button-secondary removetreatment" style="margin-left:10px; background-color: #ffc4c4;">Remove</a></p>' );
	            return false;
	        });
	        jQuery(".removetreatment").live('click', function() {
	            jQuery(this).parent().remove();
	        });
	    });

        jQuery(document).ready(function(){
            jQuery(".check_pop").click(function() {
                if(jQuery(this).is(":checked")) { 
                    jQuery(this).attr("value","yes");
                } else{
                    jQuery(this).attr("value","");
                }
            });
        });
	</script>
    <?php wp_nonce_field('treatment_nonce_action', 'treatment_nonce_name'); 
} 
function save_data_treatment( $post_id ){
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['treatment_nonce_name'] ) || !wp_verify_nonce( $_POST['treatment_nonce_name'], 'treatment_nonce_action' ) ) return;
 
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // Make sure your data is set before trying to save it

    if( isset( $_POST['treatments'] ) ) {
        update_post_meta( $post_id, 'treatments', $_POST['treatments'] );
    }	
}
add_action( 'save_post', 'save_data_treatment' );
?>