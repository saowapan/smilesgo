<? 
function set_taxonomies() {
    $taxonomies = [   
        'county_types' => [
            'name'              => 'county_types',
            'singular_name'     => 'County Type',
            'plural_name'       => 'County Types',
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => false,
            'object_type'       => array( 'clinic', 'expert' )
        ],
        /*'expert_types' => [
        'name'              => 'expert_typess',
        'singular_name'     => 'Expert Type',
        'plural_name'       => 'Expert Types',
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => false,
        'rewrite'           => false,
        'object_type'       => array( 'expert')
        ],*/
    ];
    foreach ($taxonomies as $taxonomy) { 

        if (isset($taxonomy['rewrite'])) {
            $rewrite = $taxonomy['rewrite'];
        } else {
            $rewrite = false;
        }       
        
        sage_register_taxonomy(
            $taxonomy['name'],
            $taxonomy['singular_name'],
            $taxonomy['plural_name'],
            $taxonomy['hierarchical'],
            $taxonomy['show_ui'],
            $taxonomy['show_admin_column'],
            $taxonomy['query_var'],
            $rewrite,
            $taxonomy['object_type']
        );
    }
}
add_action( 'init', 'set_taxonomies', 0 );


function sage_register_taxonomy($name, $singular_name, $plural_name, $hierarchical, $show_ui, $show_admin_column, $query_var, $rewrite = false, $object_type) {
    $labels = array(
        'name'              => __( $plural_name ),
        'singular_name'     => __( $singular_name ),
        'search_items'      => __( 'Search ' . $plural_name ),
        'all_items'         => __( 'All ' . $plural_name ),
        'parent_item'       => __( 'Parent ' . $singular_name ),
        'parent_item_colon' => __( 'Parent ' . $singular_name . ':' ),
        'edit_item'         => __( 'Edit ' . $singular_name ),
        'update_item'       => __( 'Update ' . $singular_name ),
        'add_new_item'      => __( 'Add New ' . $singular_name ),
        'new_item_name'     => __( 'New ' . $singular_name . ' Name' ),
        'menu_name'         => __( $singular_name ),
    );
    $args = array(
        'hierarchical'      => $hierarchical,
        'labels'            => $labels,
        'show_ui'           => $show_ui,
        'show_admin_column' => $show_admin_column,
        'query_var'         => false,
        'rewrite'           => $rewrite
    );

    register_taxonomy( $name, $object_type, $args );
}
?>