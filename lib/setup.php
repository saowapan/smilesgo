<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    //is_front_page(),
    //is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


/* 
function page_setup  
auto
*/
function page_setup() {
  if (is_admin()) {
    // Always set up user id =1 to administrator role
    wp_update_user(array(
      'ID' => 1,
      'role' => 'administrator'
    ));
    $admin_page_author_id = 1; // We have to update this because right now we are still got different database

    // Home Page
    $home_title = 'Home';
    $home_page_template = 'page-home.php';
    $home_page = array(
      'post_type'     => 'page',
      'post_title'    => $home_title,
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => $admin_page_author_id,
    );
    
    $page_home_check = get_page_by_title($home_title);

    if(!isset($page_home_check->ID)) {
      $new_page_id = wp_insert_post($home_page);

      if(!empty($home_page_template)) {
        update_post_meta($new_page_id, '_wp_page_template', $home_page_template);
      }
    }
    // Contact Page
    $contact_title = 'Contact';
    $contact_page_template = 'page-contact.php';
    $contact_page = array(
      'post_type'     => 'page',
      'post_title'    => $contact_title,
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => $admin_page_author_id,
    );
    
    $page_contact_check = get_page_by_title($contact_title);

    if(!isset($page_contact_check->ID)) {
      $new_page_id = wp_insert_post($contact_page);

      if(!empty($contact_page_template)) {
        update_post_meta($new_page_id, '_wp_page_template', $contact_page_template);
      }
    }

    // About Page
    $about_title = 'About';
    $about_page_template = 'page-about.php';
    $about_page = array(
      'post_type' => 'page',
      'post_title' => $about_title,
      'post_content' => '',
      'post_status' => 'publish',
      'post_author' => $admin_page_author_id,
    );
    
    $page_about_check = get_page_by_title($about_title);

    if(!isset($page_about_check->ID)) {
      $new_page_id = wp_insert_post($about_page);

      if(!empty($about_page_template)) {
      update_post_meta($new_page_id, '_wp_page_template', $about_page_template);
      }
    }

    // Write Review Page
    $writereview_title = 'Write Review';
    $writereview_page_template = 'page-writereview.php';
    $writereview_page = array(
      'post_type' => 'page',
      'post_title' => $writereview_title,
      'post_content' => '',
      'post_status' => 'publish',
      'post_author' => $admin_page_author_id,
    );
    
    $page_writereview_check = get_page_by_title($writereview_title);

    if(!isset($page_writereview_check->ID)) {
      $new_page_id = wp_insert_post($writereview_page);

      if(!empty($writereview_page_template)) {
        update_post_meta($new_page_id, '_wp_page_template', $writereview_page_template);
      }
    }

    // Book consultation Page
    $book_title = 'Book Consultation';
    $book_page_template = 'page-book_con.php';
    $book_page = array(
      'post_type' => 'page',
      'post_title' => $book_title,
      'post_content' => '',
      'post_status' => 'publish',
      'post_author' => $admin_page_author_id,
    );
    
    $page_book_check = get_page_by_title($book_title);

    if(!isset($page_book_check->ID)) {
      $new_page_id = wp_insert_post($book_page);

      if(!empty($book_page_template)) {
        update_post_meta($new_page_id, '_wp_page_template', $book_page_template);
      }
    }

    // All Clinics Post // Clinic Page
    $clinic_title = 'Clinics';
    $clinic_page_template = 'page-clinic.php';
    $clinic_page  = array(
      'post_type'     => 'page',
      'post_title'    =>  $clinic_title,
      'post_status'   => 'publish',
      'post_author'   => $admin_page_author_id,
    );

    $page_clinic_check = get_page_by_title($clinic_title);

    if (!isset($page_clinic_check->ID)) {
      $new_page_id = wp_insert_post($clinic_page);
      if (!empty($clinic_page_template)) {
        update_post_meta($new_page_id,'_wp_page_template',$clinic_page_template );
      }
    }

    // Search clinic 
    $searchclinic_title = 'Search Clinic';
    $searchclinic_page_template = 'page-search_clinic.php';
    $searchclinic_page = array(
      'post_type'     => 'page',
      'post_title'    =>  $searchclinic_title,
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => $admin_page_author_id,
    );

    $page_searchclinic_check = get_page_by_title($searchclinic_title);

    if (!isset($page_searchclinic_check->ID)) {
      $new_page_id = wp_insert_post($searchclinic_page);
      if (!empty($searchclinic_page_template)) {
        update_post_meta($new_page_id,'_wp_page_template',$searchclinic_page_template );
      }
    } 

    // Search clinics 
    $searchclinics_title = 'Search Clinics';
    $searchclinics_page_template = 'page-search_clinics.php';
    $searchclinics_page = array(
      'post_type'     => 'page',
      'post_title'    =>  $searchclinics_title,
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => $admin_page_author_id,
    );

    $page_searchclinics_check = get_page_by_title($searchclinics_title);

    if (!isset($page_searchclinics_check->ID)) {
      $new_page_id = wp_insert_post($searchclinics_page);
      if (!empty($searchclinics_page_template)) {
        update_post_meta($new_page_id,'_wp_page_template',$searchclinics_page_template );
      }
    } 


    // Experts Page
    $experts_title = 'Experts';
    $experts_page_template = 'page-experts.php';
    $experts_page = array(
      'post_type' => 'page',
      'post_title' => $experts_title,
      'post_content' => '',
      'post_status' => 'publish',
      'post_author' => $admin_page_author_id,
    );
    
    $page_experts_check = get_page_by_title($experts_title);

    if(!isset($page_experts_check->ID)) {
      $new_page_id = wp_insert_post($experts_page);

      if(!empty($experts_page_template)) {
      update_post_meta($new_page_id, '_wp_page_template', $experts_page_template);
      }
    }
  } // if
} // function
add_action('after_setup_theme', __NAMESPACE__ . '\\page_setup');