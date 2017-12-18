<?php
	function bookcon_meta_boxes() {
    add_meta_box( 'bookcon_details', __( 'Details', '' ), 'bookcon_detail_callback', 'bookconsultation', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'bookcon_meta_boxes' );
 	
 	function bookcon_detail_callback( $post ) {
		$values = get_post_custom( $post->ID );
		$text_fields = [
			'name_clinic'=> isset($values['name_clinic']) ? $values['name_clinic'] : "",
			'name'		=> isset($values['name']) ? $values['name'] : "",
			'email' 	=> isset($values['email']) ? $values['email'] : "",
			'phone' 	=> isset($values['phone']) ? $values['phone'] : "",
			'bookdate' 	=> isset($values['bookdate']) ? $values['bookdate'] : "",
			'booktime' 	=> isset($values['booktime']) ? $values['booktime'] : "",
			'treatment' 	=> isset($values['treatment']) ? $values['treatment'] : "",
			'promotion' 	=> isset($values['promotion']) ? $values['promotion'] : ""
		];
		?><table><?
 		foreach ($text_fields as $name => $value) { ?>
			<tr>
				<td><label for="<?php echo $name; ?>"><?php echo $name; ?></label></td>
				<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if (isset($value[0])) echo $value[0]; ?>"></td>
			</tr>
		<?php } ?>
		</table>
 	<?php wp_nonce_field('bookcon_nonce_action', 'bookcon_nonce_name');
}
function bookcon_save_meta_box( $post_id ) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	 
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['bookcon_nonce_name'] ) || !wp_verify_nonce( $_POST['bookcon_nonce_name'], 'bookcon_nonce_action' ) ) return;
	 
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

}
add_action( 'save_post', 'bookcon_save_meta_box' );
?>