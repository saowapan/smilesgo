<?php
	function review_meta_boxes() {
    add_meta_box( 'review_details', __( 'Review Details', '' ), 'review_detail_callback', 'writereview', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'review_meta_boxes' );
 	
 	function review_detail_callback( $post ) {
		$values = get_post_custom( $post->ID );
		$text_fields = [
			'name_clinic'	=> isset($values['name_clinic']) ? $values['name_clinic'] : "",
			'name'			=> isset($values['name']) ? $values['name'] : "",
			'email' 		=> isset($values['email']) ? $values['email'] : "",
			'quality' 		=> isset($values['quality']) ? $values['quality'] : "",
			'service' 		=> isset($values['service']) ? $values['service'] : "",
			'cleanliness' 	=> isset($values['cleanliness']) ? $values['cleanliness'] : "",
			'comfort' 		=> isset($values['comfort']) ? $values['comfort'] : "",
			'commun' 		=> isset($values['commun']) ? $values['commun'] : "",
			'values' 		=> isset($values['values']) ? $values['values'] : "",
			'stars_point'   => isset($values['stars_point']) ? $values['stars_point'] : "",
		];
		?><table><?
 		foreach ($text_fields as $name => $value) { ?>
			<tr>
				<td><label for="<?php echo $name; ?>"><?php echo $name; ?></label></td>
				<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if (isset($value[0])) echo $value[0]; ?>"></td>
			</tr>
		<?php } ?>
		</table>
		<p>stars_point = (quality + service + cleanliness + comfort + commun + values) / 6   </p>
 	<?php wp_nonce_field('register_nonce_action', 'register_nonce_name');
}
function review_save_meta_box( $post_id ) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	 
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['register_nonce_name'] ) || !wp_verify_nonce( $_POST['register_nonce_name'], 'register_nonce_action' ) ) return;
	 
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// Make sure your data is set before trying to save it
	if( isset( $_POST['name_clinic'] ) ) {
		update_post_meta( $post_id, 'name_clinic', $_POST['name_clinic'] );
	}
	if( isset( $_POST['name'] ) ) {
		update_post_meta( $post_id, 'name', $_POST['name'] );
	}
	if( isset( $_POST['email'] ) ) {
		update_post_meta( $post_id, 'email', $_POST['email'] );
	}
	if( isset( $_POST['quality'] ) ) {
		update_post_meta( $post_id, 'quality', $_POST['quality'] );
	}
	if( isset( $_POST['service'] ) ) {
		update_post_meta( $post_id, 'service', $_POST['service'] );
	}
	if( isset( $_POST['cleanliness'] ) ) {
		update_post_meta( $post_id, 'cleanliness', $_POST['cleanliness'] );
	}
	if( isset( $_POST['comfort'] ) ) {
		update_post_meta( $post_id, 'comfort', $_POST['comfort'] );
	}
	if( isset( $_POST['commun'] ) ) {
		update_post_meta( $post_id, 'commun', $_POST['commun'] );
	}
	if( isset( $_POST['values'] ) ) {
		update_post_meta( $post_id, 'values', $_POST['values'] );
	}
}
add_action( 'save_post', 'review_save_meta_box' );
?>