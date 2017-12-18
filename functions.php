<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php',// Theme customizer 
  'lib/wp_bootstrap_navwalker.php', // menu wp_bootstrap_navwalker
  'lib/set_post_types.php',   // set All post types 
  'lib/set_taxonomies.php',   // set_taxonomies // cat.
  'lib/bookreview.php',       // form review
  'lib/set_bookreview.php',   // set Review post type
  'lib/bookcon.php',          // form bookcon
  'lib/set_bookcon.php',      // set Book Con. post type 
  'lib/set_clinic.php',       // set clinic post type 
  'lib/set_treatment.php',    // set treatment post type 
  'lib/set_promotion.php',    // set promotion post type 
  'lib/set_expert.php',    // set promotion post type 
  'lib/function-singleClinic.php', // function singleClinic
  'lib/function-searchClinic.php', // function searchClinic
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
function build_url($path = '', $image = false, $return = false, $page = false) {
    $url = home_url();
    if ($path != '' && $page == false) {
      $url = get_stylesheet_directory_uri() . $path;
    }

    if ($page == true) {
      $url = $url . $path;
    }

    if ($return === true) {
      return $url;
    } else {
      echo $url;
    }
}

function get_img_src_bypostid($post_id, $image_size = 'thumbnail') {
  $post_thumbnail_id = get_post_thumbnail_id($post_id);
  $image = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
  $image_src = $image[0];
  return $image_src;
}

function checkHasTreatment($count_all_treatment,$treatment_clinic){
  $treatment_check    = 0 ;
  for ($t_check=0; $t_check <$count_all_treatment; $t_check++) { 
    if ($treatment_clinic[$t_check]['checkbox'] == 'yes' || $treatment_clinic[$t_check]['checkbox'] == 'on') {
      $treatment_check = $treatment_check + 1;
    }
  }
  return $treatment_check;
}

function checkHasPormotion($count_all_promotion,$promotion_clinic){
  $promotion_count = 0 ;
  for ($p_check=0; $p_check <$count_all_promotion; $p_check++) { 
    if ($promotion_clinic[$p_check]['checkbox'] == 'yes' || $promotion_clinic[$p_check]['checkbox'] == 'on') {
      $promotion_count = $promotion_count + 1;
    }
  }
  return $promotion_count;
}

function WP_Query_writereview($name_clinic){
    $args = array(
        'post_type'     => 'writereview', 
        'posts_per_page'  => -1 ,
        'post_status'   => 'publish',
        'meta_query'    => array(
            array(
                'key'   => 'name_clinic',
                'value' => $name_clinic,
            )
        )
    );
    return $args;
}

function count_review_point($loopcount){
  $stars_point_sum = 0;

  while ( $loopcount->have_posts() ) : $loopcount->the_post(); 
    $stars_point   = get_post_meta( get_the_ID(), 'stars_point', true );
    $stars_point_sum = $stars_point_sum + $stars_point;
  endwhile;

  return $stars_point_sum;
}

function WP_Query_treatment(){
  $args   = array(
      'post_type'         => 'treatment', 
      'posts_per_page'    => -1 ,
  );
  $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post(); 
      $treatment_value    = get_post_meta( get_the_ID(), 'treatments', true );
    endwhile; 
    return ($treatment_value);
}
?>