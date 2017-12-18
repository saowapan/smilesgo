<?php  
// Area of Expertise
function area_expert_meta_boxes() {
    add_meta_box( 'area_expert', __( 'Area of Expertise', '' ), 'area_expert_callback', 'expert', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'area_expert_meta_boxes' );
function area_expert_callback( $post ) { 
	$area_expert_values = get_post_custom( $post->ID );
	$area_expert = isset($area_expert_values['area_expert']) ? unserialize($area_expert_values['area_expert'][0]): '';
	wp_nonce_field('expert_nonce_action', 'expert_nonce_name'); 
	
	$values_expert  = array('Dental Implants Expert', 'Root Canal Treatment Expert', 'Veneers Expert', 'Crowns Expert', 'Teeth Whitening Expert', 'Tooth Extraction Expert', 'Orthodontics Expert', 'Cfast Expert', 'Specialist in Oral Surgery', 'Six-Month Smiles Expert', 'Sedation Expert');
	?>
	<div style="width: 100%; overflow: hidden;">
		<?php  for ($i=0; $i < count($values_expert); $i++)  { 
				if (isset($area_expert[$i]['checkbox']) == '') {
					$checked = '';
				}else{
					$checked = 'checked="checked"'; 
					
				}	
		?>
			<p style="width: 30%;float: left; margin: 0; padding: 10px;">
			   	<input  class="btn-checkbox" type="checkbox"  name="area_expert[<?php echo $i ;?>][checkbox]" value="<?php if (isset($area_expert[$i]['checkbox'])) {echo $area_expert[$i]['checkbox'];}?>" <?php  echo $checked;?>/>
			   	<span><?php echo $values_expert[$i]; ?></span>
			   	<input type="hidden"  	name="area_expert[<?php echo $i ;?>][val]" value="<?php echo $values_expert[$i]; ?>" />
			</p>
		<?php }
		?>
		<p style="width: 30%;float: left; margin: 0; padding: 10px;">
		   	<input type="text"  name="area_expert[other]"   value="<?php if (isset($area_expert['other'])) echo $area_expert['other']; ?>" placeholder="Other"/>
		</p>
	</div>
	 <script>
        jQuery(document).ready(function(){
            jQuery(".btn-checkbox").click(function() {
                if(jQuery(this).is(":checked")) { 
                    jQuery(this).attr("value","yes");
                } else{
                    jQuery(this).attr("value","");
                }
            });
        });
    </script>
<?php }

function contact_expert_meta_boxes() {
    add_meta_box( 'contact_expert', __( 'Contact Expert', '' ), 'contact_expert_callback', 'expert', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'contact_expert_meta_boxes' );
function contact_expert_callback( $post ) { 
	$contact_expert_values = get_post_custom( $post->ID );
	$contact_expert = isset($contact_expert_values['contact_expert']) ? unserialize($contact_expert_values['contact_expert'][0]): '';
	wp_nonce_field('expert_nonce_action', 'expert_nonce_name'); ?>
	<input type="email"  name="contact_expert[email]"   			value="<?php if (isset($contact_expert['email'])) echo $contact_expert['email']; ?>" placeholder="Email" style="width: 50%;"/>
<?php }

function save_data_expert( $post_id ){
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['expert_nonce_name'] ) || !wp_verify_nonce( $_POST['expert_nonce_name'], 'expert_nonce_action' ) ) return;
 
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // Make sure your data is set before trying to save it

    if( isset( $_POST['area_expert'] ) ) {
        update_post_meta( $post_id, 'area_expert', $_POST['area_expert'] );
    }
    if( isset( $_POST['contact_expert'] ) ) {
    	update_post_meta($post_id,'contact_expert',$_POST['contact_expert'] );
    }
    
}
add_action( 'save_post', 'save_data_expert' );
?>