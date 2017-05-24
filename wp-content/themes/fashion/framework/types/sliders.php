<?php

if(!function_exists('wpo_create_type_sliders')){
    function wpo_create_type_sliders(){
        $labels = array(
            'name' => __( 'Sliders', 'fashion' ),
            'singular_name' => __( 'Slider', 'fashion'),
            'add_new' => __( 'Add New Slider', 'fashion' ),
            'add_new_item' => __( 'Add New Slider', 'fashion' ),
            'edit_item' => __( 'Edit Slider', 'fashion' ),
            'new_item' => __( 'New Slider', 'fashion' ),
            'view_item' => __( 'View Slider', 'fashion' ),
            'search_items' => __( 'Search Slider', 'fashion' ),
            'not_found' => __( 'No Slider found', 'fashion' ),
            'not_found_in_trash' => __( 'No Slider found in Trash', 'fashion' ),
            'parent_item_colon' => __( 'Parent Slider:', 'fashion' ),
            'menu_name' => __( 'Sliders', 'fashion' )
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'List Slider',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array('slider_group' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => false,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );
        register_post_type( 'sliders', $args );


        $labels = array(
            'name' => __( 'Slider groups', 'fashion' ),
            'singular_name' => __( 'Slider group', 'fashion' ),
            'search_items' =>  __( 'Search Slider groups', 'fashion' ),
            'all_items' => __( 'All Slider groups', 'fashion' ),
            'parent_item' => __( 'Parent Slider group', 'fashion' ),
            'parent_item_colon' => __( 'Parent Slider group:', 'fashion' ),
            'edit_item' => __( 'Edit Slider group', 'fashion' ),
            'update_item' => __( 'Update Slider group', 'fashion' ),
            'add_new_item' => __( 'Add New Slider group', 'fashion' ),
            'new_item_name' => __( 'New Slider group', 'fashion' ),
            'menu_name' => __( 'Slider groups', 'fashion' ),
        );

        register_taxonomy('slider_group',array('sliders'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'slider_group' ),
            'show_in_nav_menus'=>false
        ));
    }
    add_action( 'init','wpo_create_type_sliders' );
}