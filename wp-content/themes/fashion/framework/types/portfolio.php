<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     Opal  Team <opalwordpressl@gmail.com >
  * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/support/forum.html
  */
if(!function_exists('wpo_create_type_portfolio')){
    function wpo_create_type_portfolio(){
      $labels = array(
          'name' => __( 'Portfolios', 'fashion' ),
          'singular_name' => __( 'Portfolio', 'fashion' ),
          'add_new' => __( 'Add New Portfolio', 'fashion' ),
          'add_new_item' => __( 'Add New Portfolio', 'fashion' ),
          'edit_item' => __( 'Edit Portfolio', 'fashion' ),
          'new_item' => __( 'New Portfolio', 'fashion' ),
          'view_item' => __( 'View Portfolio', 'fashion' ),
          'search_items' => __( 'Search Portfolios', 'fashion' ),
          'not_found' => __( 'No Portfolios found', 'fashion' ),
          'not_found_in_trash' => __( 'No Portfolios found in Trash', 'fashion' ),
          'parent_item_colon' => __( 'Parent Portfolio:', 'fashion' ),
          'menu_name' => __( 'WPO Portfolios', 'fashion' ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => true,
          'description' => 'List Portfolio',
          'supports' => array( 'title', 'editor', 'thumbnail' ),
          'taxonomies' => array( 'Portfolio_category','skills' ),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'menu_icon' => WPO_FRAMEWORK_ADMIN_IMAGE_URI.'icon/admin_ico_portfolio.png',
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'has_archive' => true,
          'query_var' => true,
          'can_export' => true,
          'rewrite' => true,
          'capability_type' => 'post'
      );
      register_post_type( 'portfolio', $args );

      //Add Port folio Skill
      // Add new taxonomy, make it hierarchical like categories
      //first do the translations part for GUI
      $labels = array(
        'name' => __( 'Skills', 'fashion' ),
        'singular_name' => __( 'Skill', 'fashion' ),
        'search_items' =>  __( 'Search Skills', 'fashion' ),
        'all_items' => __( 'All Skills', 'fashion' ),
        'parent_item' => __( 'Parent Skill', 'fashion' ),
        'parent_item_colon' => __( 'Parent Skill:', 'fashion' ),
        'edit_item' => __( 'Edit Skill', 'fashion' ),
        'update_item' => __( 'Update Skill', 'fashion' ),
        'add_new_item' => __( 'Add New Skill', 'fashion' ),
        'new_item_name' => __( 'New Skill Name', 'fashion' ),
        'menu_name' => __( 'Skills', 'fashion' ),
      );
      // Now register the taxonomy
      register_taxonomy('Skills',array('portfolio'),
          array(
              'hierarchical' => true,
              'labels' => $labels,
              'show_ui' => true,
              'show_admin_column' => true,
              'query_var' => true,
              'show_in_nav_menus'=>false,
              'rewrite' => array( 'slug' => 'skills'
          ),
      ));
  }
  add_action( 'init','wpo_create_type_portfolio' );
}