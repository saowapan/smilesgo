<?php  
// Support
function support_clinic_meta_boxes() {
    add_meta_box( 'support_clinic', __( 'Support for Smilesgo', '' ), 'support_clinic_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'support_clinic_meta_boxes' );
function support_clinic_callback( $post ) { 
    $support_clinic = get_post_meta($post->ID,'support_clinic',true);
    ?>
    <input type="number" name="support_clinic" value="<?php if (isset($support_clinic)) echo $support_clinic; ?>" /> THB
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}

// About  
function about_clinic_meta_boxes() {
    add_meta_box( 'about_clinic', __( 'About Clinic', '' ), 'about_clinic_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'about_clinic_meta_boxes' );
function about_clinic_callback( $post ) { 
    $about_clinic_values = get_post_custom( $post->ID );
    $about_clinic = isset($about_clinic_values['about_clinic']) ? unserialize($about_clinic_values['about_clinic'][0]): '';
    ?>
        <p> 
            <?php if (isset($about_clinic['about'])){
                $valueabout =  $about_clinic['about']; 
            }?>
            <textarea placeholder="About Clinic" name="about_clinic[about]" id="about" value="<?php echo $valueabout; ?>" style="width: 100%;height: 100px;" ><?php echo $valueabout; ?></textarea>
        </P>
    <?php     
    wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}
// Operation Hours
function time_clinic_meta_boxes() {
    add_meta_box( 'time_clinic', __( 'Operation Hours', '' ), 'time_clinic_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'time_clinic_meta_boxes' );
function time_clinic_callback( $post ) { 
    $time_clinic_values = get_post_custom( $post->ID );
    $time_clinic        = isset($time_clinic_values['time_clinic']) ? unserialize($time_clinic_values['time_clinic'][0]): ''; 
    $option_values      = array('07.00', '07.30', '08.00', '08.30', '09.00', '09.30', '10.00', '10.30', '11.00', '11.30', '12.00', '12.30', '13.00', '13.30', '14.00', '14.30', '15.00', '15.30', '16.00', '16.30', '17.00', '17.30', '18.00', '18.30', '19.00', '19.30', '20.00', '20.30', '21.00', '21.30', '22.00', '22.30' );
    $setting_day        = array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');?>
    <p>if setting time on <strong>Monday</strong> will be auto change the time in all day and you can edit time in other day after</p>
    <p>   
        <?php // for mon day only : add class mon_start , mon_end use in js
            echo '<label style="width: 80px;display: inline-block;">'.$setting_day[1].' : </label>';
            if (isset($time_clinic[1]['start']) == '') { // start not have value
                echo '<select class="mon_start" name="time_clinic[1][start]"><option>Close</option>'; 
                foreach($option_values as $key => $valuestart) {
                    echo '<option>'.$valuestart.'</option>';
                }
            }else{ // have value
                echo '<select class="mon_start" name="time_clinic[1][start]" value="'.$time_clinic[1]['start'].'"><option>Close</option>'; 
                foreach($option_values as $key => $valuestart) {
                    if($valuestart == $time_clinic[1]['start']){
                        echo '<option selected>'.$valuestart.'</option>';
                    }else{
                        echo '<option>'.$valuestart.'</option>';
                    }
                }
            }
            echo '</select><span> - </span>';

            if (isset($time_clinic[1]['end']) == '') { // end not have value 
                echo '<select class="mon_end" name="time_clinic[1][end]"><option></option>';
                    foreach($option_values as $key => $valueend) {
                        echo '<option>'.$valueend.'</option>';
                    }                
            }else{ // end  have value 
                echo '<select class="mon_end" name="time_clinic[1][end]" value="'.$time_clinic[1]['end'].'" ><option></option>';
                foreach($option_values as $key => $valueend) {
                    if($valueend == $time_clinic[1]['end']){
                        echo '<option selected>'.$valueend.'</option>';
                    }else{
                        echo '<option>'.$valueend.'</option>';
                    }
                }
            } 
            echo '</select></br>';
        ?>   
        <?php for ($settingtime=2; $settingtime <= 7 ; $settingtime++) { 
           echo '<label style="width: 80px;display: inline-block;">'.$setting_day[$settingtime].' : </label>';
            if (isset($time_clinic[$settingtime]['start']) == '') { // start not have value
                echo '<select class="start"     name="time_clinic['.$settingtime.'][start]"><option>Close</option>'; 
                foreach($option_values as $key => $valuestart) {
                    echo '<option>'.$valuestart.'</option>';
                }
            }else{ // have value
                echo '<select class="start" name="time_clinic['.$settingtime.'][start]" value="'.$time_clinic[$settingtime]['start'].'"><option>Close</option>'; 
                foreach($option_values as $key => $valuestart) {
                    if($valuestart == $time_clinic[$settingtime]['start']){
                        echo '<option selected>'.$valuestart.'</option>';
                    }else{
                        echo '<option>'.$valuestart.'</option>';
                    }
                }
            }
            echo '</select><span> - </span>';

            if (isset($time_clinic[$settingtime]['end']) == '') { // end not have value 
                echo '<select class="end" name="time_clinic['.$settingtime.'][end]"><option></option>';
                    foreach($option_values as $key => $valueend) {
                        echo '<option>'.$valueend.'</option>';
                    }                
            }else{ // end  have value 
                echo '<select class="end" name="time_clinic['.$settingtime.'][end]" value="'.$time_clinic[$settingtime]['end'].'" ><option></option>';
                foreach($option_values as $key => $valueend) {
                    if($valueend == $time_clinic[$settingtime]['end']){
                        echo '<option selected>'.$valueend.'</option>';
                    }else{
                        echo '<option>'.$valueend.'</option>';
                    }
                }
            } 
            echo '</select></br>';
        } ?>      
    </p>   
     <script>
        jQuery(document).ready(function(){
            jQuery(".mon_start").change(function() {  
                var values_mon_start = jQuery(".mon_start").val();
                jQuery(".start").attr("value",values_mon_start);
                if (values_mon_start == 'Close' ) {
                    jQuery(".end").attr("value",'');
                    jQuery(".mon_end").attr("value",'');
                };
            });
            jQuery(".mon_end").change(function() {  
                var values_mon_end = jQuery(".mon_end").val();
                jQuery(".end").attr("value",values_mon_end);
            });
            jQuery(".start").change(function(){
                var values_start = jQuery(this).val();
                if (values_start == "Close") {
                    jQuery(this).next().next().attr("value",'');
                };           
            });
        });
    </script>
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}
//  Contact
function contact_clinic_meta_boxes() {
    add_meta_box( 'contact_clinic', __( 'Contact', '' ), 'contact_clinic_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'contact_clinic_meta_boxes' );
function contact_clinic_callback( $post ) { 
    $contact_clinic_values = get_post_custom( $post->ID );
    $contact_clinic = isset($contact_clinic_values['contact_clinic']) ? unserialize($contact_clinic_values['contact_clinic'][0]): '';
    ?>
    <p><label>Address</label></br>
        <?php if (isset($contact_clinic['address'])) { $address = $contact_clinic['address']; } ?>
        <textarea placeholder="Address" name="contact_clinic[address]" value="<?php echo $address;?>" style="width: 100%;height: 50px;" ><?php echo $address;?></textarea>
    </P>
    <p><label>Latitude & Longitude (input values for show map) <a href="http://www.latlong.net/" target="_blank">find latitude & longitude from location</a></label></br>
        <input placeholder="Latitude" type="text" name="contact_clinic[latitude]" value="<?php if (isset($contact_clinic['latitude'])) echo $contact_clinic['latitude']; ?>" />
        <input placeholder="Longitude" type="text" name="contact_clinic[longitude]" value="<?php if (isset($contact_clinic['longitude'])) echo $contact_clinic['longitude']; ?>" />
    </p>
    <p><label>Email</label></br>
        <input placeholder="Email" type="email" name="contact_clinic[email]" value="<?php if (isset($contact_clinic['email'])) echo $contact_clinic['email']; ?>" />
        <input placeholder="Email Reserve" type="email" name="contact_clinic[email2]" value="<?php if (isset($contact_clinic['email2'])) echo $contact_clinic['email2']; ?>" />
    </p>
    <p><label>Number Phone</label></br>
        <input placeholder="Phone" type="text" name="contact_clinic[phone]" value="<?php if (isset($contact_clinic['phone'])) echo $contact_clinic['phone']; ?>" />
        <input placeholder="Phone Reserve" type="text" name="contact_clinic[phone2]" value="<?php if (isset($contact_clinic['phone2'])) echo $contact_clinic['phone2']; ?>" />
    </p>
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}
// Get Treatment Type 
function gettreatment_meta_boxes() {
    add_meta_box( 'treatment_clinic', __( 'Treatments', '' ), 'gettreatment_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'gettreatment_meta_boxes' );
function gettreatment_callback( $post ) { 
    $treatment_clinic_values = get_post_custom( $post->ID );
    $treatment_clinic = isset($treatment_clinic_values['treatment_clinic']) ? unserialize($treatment_clinic_values['treatment_clinic'][0]): '';
    $args   = array(
        'post_type'         => 'treatment', 
        'posts_per_page'    => -1 ,
    );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post(); 
        $treatment_value    = get_post_meta( get_the_ID(), 'treatments', true );
        $count_treatment    = count($treatment_value);
        echo '<div style="width: 100%; overflow: hidden;">';
        for($j = 0; $j < $count_treatment; $j++){ ?>
            <p style="width: 20%;float: left;">
                <?php if (isset($treatment_clinic[$j]['checkbox']) == '') {
                    $checked = '';
                    $style = 'display: none;';
                    $treatment_clinic[$j]['price'] = '';
                }else{ // value = yes 
                    $checked    = 'checked=checked'; 
                    $style = 'display: inline-block;';
                } ?>
                <input class="btn" type="checkbox"  name="treatment_clinic[<?php echo $j; ?>][checkbox]"   value="<?php if (isset($treatment_clinic[$j]['checkbox'])) {echo $treatment_clinic[$j]['checkbox'];}?>" <?php echo $checked;?> /><?php echo $treatment_value[$j]['name']; ?>
                <input class="div" type="number"    name="treatment_clinic[<?php echo $j; ?>][price]"      value="<?php if (isset($treatment_clinic[$j]['price'])) echo $treatment_clinic[$j]['price']; ?>"  style="width: 100%; margin-top:5px; <?php echo $style; ?>" placeholder="Price (THB)" />
                <input type="hidden"  name="treatment_clinic[<?php echo $j; ?>][name]"  value="<?php echo $treatment_value[$j]['name']; ?>" />
            </p>
        <?php 
        }
        echo  '</div>';
    endwhile;   
    ?>
    <script>
        jQuery(document).ready(function(){
            jQuery(".btn").click(function() {
                jQuery(this).next().toggle(); 
                jQuery(this).next().next().toggle();
                if(jQuery(this).is(":checked")) { 
                    jQuery(this).attr("value","yes");
                } else{
                    jQuery(this).attr("value","");
                }
            });
        });
    </script>
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}
// Get Promotion Type 
function getpromotion_meta_boxes() {
    add_meta_box( 'promotion_clinic', __( 'Promotion', '' ), 'getpromotion_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'getpromotion_meta_boxes' );
function getpromotion_callback( $post ) { 
    $promo_clinic_values = get_post_custom( $post->ID );
    $promotion_clinic    = isset($promo_clinic_values['promotion_clinic']) ? unserialize($promo_clinic_values['promotion_clinic'][0]): '';
    $args_pro   = array(
        'post_type'         => 'promotion', 
        'posts_per_page'    => -1 ,
    );
    $loop_pro = new WP_Query( $args_pro );
    while ( $loop_pro->have_posts() ) : $loop_pro->the_post();
        $promotion_value    = get_post_meta( get_the_ID(), 'promotions', true );
        $count_promotion    = count($promotion_value);
        echo '<div style="width: 100%; overflow: hidden;">';
        for($p = 0; $p < $count_promotion; $p++){ ?>
            <p style="width: 47%;float: left; margin: 0; padding: 10px;">
                <?php if (isset($promotion_clinic[$p]['checkbox']) == '') {
                    $checked = '';
                    $style = 'display: none;';
                    $promotion_clinic[$p]['price'] = '';
                    $promotion_clinic[$p]['description'] = '';
                }else{ // value = yes 
                    $checked    = 'checked=checked'; 
                    $style = 'display: inline-block;';
                } ?>
                <input class="btn" type="checkbox"  name="promotion_clinic[<?php echo $p; ?>][checkbox]"    value="<?php if (isset($promotion_clinic[$p]['checkbox'])) {echo $promotion_clinic[$p]['checkbox'];}?>" <?php echo $checked;?> /><?php echo $promotion_value[$p]['name']; ?>
                <input class="div" type="text"      name="promotion_clinic[<?php echo $p; ?>][price]"       value="<?php if (isset($promotion_clinic[$p]['price'])) echo $promotion_clinic[$p]['price']; ?>"  style="width: 100%; margin:5px 0; <?php echo $style; ?>" placeholder="Price or Percent %" />
                <?php if (isset($promotion_clinic[$p]['description'])) { $description = $promotion_clinic[$p]['description']; } ?>
                <textarea class="div" placeholder="Descriptions"name="promotion_clinic[<?php echo $p; ?>][description]" value="<?php echo $description;?>" style="width: 100%;height: 50px; margin: 0; <?php echo $style; ?>" ><?php echo $description;?></textarea>
                <input type="hidden"  name="promotion_clinic[<?php echo $p; ?>][name]"  value="<?php echo $promotion_value[$p]['name']; ?>" />
            </p>
        <?php 
        }
        echo  '</div>';
    endwhile;  
    ?>      
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}
// Get Experts 
function getexperts_meta_boxes() {
    add_meta_box( 'expert_clinic', __( 'Experts', '' ), 'getexperts_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'getexperts_meta_boxes' );

function args_expert(){
    $args_expert   = array(
        'post_type'         => 'expert', 
        'posts_per_page'    => -1 ,
        'order'   => 'ASC',
    );
    return  $args_expert;
}
function loopnameexpert(){
    $posts = get_posts(args_expert()); 
    foreach( $posts as $key =>  $post){ 
        echo '<option>'.$post->post_title.'</option>';
    }
}
function getexperts_callback( $post ) { 
    $expert_clinic_values = get_post_custom( $post->ID );
    $expert_clinic = isset($expert_clinic_values['expert_clinic']) ? unserialize($expert_clinic_values['expert_clinic'][0]): '';
    wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
    $outcount_ex = 0;
    if(is_array($expert_clinic)){
        foreach ( $expert_clinic as $name ) {
            if ( isset( $name['name'] ) ) {
                $showcount_ex = $outcount_ex +1;
                echo '<p style="position: relative;"><label style="display: inline-block;width: 20px;">'.$showcount_ex.')</label>';
                echo '<select name="expert_clinic['.$outcount_ex.'][name]" value="'.$name['name'].'">';
                $posts = get_posts(args_expert()); 
                echo '<option></option>';
                foreach( $posts as $key =>  $post){ 
                    if ($name['name'] == $post->post_title) {
                        $img    =   get_img_src_bypostid($post->ID, 'thumbnail');  
                        $terms_county   =   wp_get_object_terms( $post->ID, 'county_types', array('fields'=>'slugs'));
                        echo '<option selected value="'.$post->post_title.'">'.$post->post_title.'</option>';
                       
                    }else{
                        echo '<option>'.$post->post_title.'</option>';
                    }
                }
                echo '</select><a class="button-secondary removeexpert" style="margin: 0 10px;">Remove</a>';
                if (!empty($img)) {
                    echo '<img style="height: 40px;position: absolute;top: -7px;" src="'.$img.'">';
                }else{
                    echo '';
                }
                if (!empty($terms_county)) {
                    echo  '<span style="margin-left: 50px">'.$terms_county[0].'</span></p>';
                }    
                $outcount_ex  = $outcount_ex +1;
            }
            $img = '';
        }
    }?>  
    <div id="hereexpert"></div>
    <a class="button-secondary addexpert">Add More Expert</a>
    <script>
        jQuery(document).ready(function(){
            var count_js_ex = <?php echo $outcount_ex; ?>;
            jQuery(".addexpert").click(function() {
                count_js_ex = count_js_ex+1;
                jQuery('#hereexpert').append('<p style="margin-left: 20px;"><select name="expert_clinic['+count_js_ex+'][name]"><option></option><?php loopnameexpert(); ?></select><a class="button-secondary removeexpert" style="margin: 0 10px;">Remove</a></p>');
                return false;
            });
            jQuery(".removeexpert").live('click', function() {
                jQuery(this).parent().remove();
            });
        });
    </script>
<?php
}
// GALLERYS
function gallerys_clinic_meta_boxes() {
    add_meta_box( 'gallerys_clinic', __( 'Gallerys (Choose or Upload Images)', '' ), 'gallerys_clinic_callback', 'clinic', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'gallerys_clinic_meta_boxes' );
function gallerys_clinic_callback( $post ) { ?>
    <?php 
        $img_meta = get_post_meta( $post->ID ); 
        $images_clinic = isset($img_meta['images_clinic']) ? unserialize($img_meta['images_clinic'][0]): '';
    ?>
    <?php  for ($count_img=1; $count_img <= 10 ; $count_img++) {  ?>
    <div class="divgallerys_<?php echo $count_img; ?> divgallerys">
        <p style="position: relative;"><span style="width: 25px;display: inline-block;"><?php echo $count_img.' )'; ?></span>
            <input type="button" class="<?php echo 'pic_img_btn_'.$count_img.'' ; ?> button" value="<?php _e( 'Choose Image', 'prfx-textdomain' )?>"  />
            <input type="text" name="images_clinic[<?php echo $count_img; ?>]" class="<?php echo 'pic_name_show_'.$count_img.'' ; ?>" value="<?php  if ( isset ( $images_clinic[$count_img] ) ) echo $images_clinic[$count_img]; ?>" style="width: 50%;margin-right: 10px;"/>
            <?php if ( !empty ( $images_clinic[$count_img]) ) { ?>
            <img class="<?php echo 'pic_img_show_'.$count_img.'' ; ?>" src="<?php echo $images_clinic[$count_img]; ?>" style="height: 35px;position: absolute;top: -5px;"/>
            <?php }else{ 
                echo '<span  class="pic_img_show_'.$count_img.'"></span>';
            }?>
        </p>
        <a class="button-secondary add_img add_img_<?php echo $count_img; ?>">Add <?php echo $count_img+1; ?></a>
        <a class="button-secondary remove_img remove_img_<?php echo $count_img; ?>">Remove <?php echo $count_img; ?></a>
    </div>
    <?php } ?>
    <?php wp_nonce_field('clinic_nonce_action', 'clinic_nonce_name'); 
}

function prfx_image_enqueue() {
    wp_enqueue_media();
    // Registers and enqueues the required javascript.
    wp_register_script( 'meta-box-image',get_bloginfo('template_url') . '/assets/scripts/meta-box-image.js', array( 'jquery' ) );
    wp_localize_script( 'meta-box-image', 'meta_image',
        array(
            'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
            'button' => __( 'Use this image', 'prfx-textdomain' ),
        )
    );
    wp_enqueue_script( 'meta-box-image' );
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );

function save_data_clinic( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !isset( $_POST['clinic_nonce_name'] ) || !wp_verify_nonce( $_POST['clinic_nonce_name'], 'clinic_nonce_action' ) ) return;
 
    if( !current_user_can( 'edit_post' ) ) return;

    if( isset( $_POST['contact_clinic'] ) ) {
        update_post_meta( $post_id, 'contact_clinic', $_POST['contact_clinic'] );
    }
    if( isset( $_POST['gallerys_clinic'] ) ) {
    	update_post_meta($post_id,'gallerys_clinic',$_POST['gallerys_clinic'] );
    }
    if( isset( $_POST['treatment_clinic'] ) ) {
        update_post_meta($post_id,'treatment_clinic',$_POST['treatment_clinic'] );
    }	
    if( isset( $_POST['promotion_clinic'] ) ) {
        update_post_meta($post_id,'promotion_clinic',$_POST['promotion_clinic'] );
    }     
    if( isset( $_POST['time_clinic'] ) ) {
        update_post_meta($post_id,'time_clinic',$_POST['time_clinic'] );
    }
    if( isset( $_POST['expert_clinic'] ) ) {
        update_post_meta($post_id,'expert_clinic',$_POST['expert_clinic'] );
    }
    if( isset( $_POST['about_clinic'] ) ) {
        update_post_meta($post_id,'about_clinic',$_POST['about_clinic'] );
    }
    if( isset( $_POST[ 'images_clinic' ] ) ) {
        update_post_meta( $post_id, 'images_clinic', $_POST[ 'images_clinic' ] );
    }
     if( isset( $_POST[ 'support_clinic' ] ) ) {
        update_post_meta( $post_id, 'support_clinic', $_POST[ 'support_clinic' ] );
    }
  }
add_action( 'save_post', 'save_data_clinic' );
?>