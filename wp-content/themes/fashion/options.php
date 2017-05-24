<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {
        // This gets the theme name from the stylesheet (lowercase and without spaces)
        $themename = get_option( 'stylesheet' );
        $themename = preg_replace("/\W/", "_", strtolower($themename) );

        $optionsframework_settings = get_option('optionsframework');
        $optionsframework_settings['id'] = $themename;
        update_option('optionsframework', $optionsframework_settings);
         // echo $themename;
}
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

/**
 *
 * List option keys using for injecting sub theme options in the form
 *
 * general: for General Option
 * pages: for General Option
 * fonts: for General Option
 * general: for General Option
 * general: for General Option
 * general: for General Option
 */
function optionsframework_options() {

    $options = array();

    $footers_type = get_posts( array('posts_per_page'=>-1,'post_type'=>'footer') );
    $footers = array('default'=>'Default');
    foreach ($footers_type as $key => $value) {
        $footers[$value->ID] = $value->post_title;
    }

    $wp_editor_settings = array(
        'wpautop' => true, // Default
        'textarea_rows' => 5,
        'media_buttons' => true
    );

    $options['general'][] = array(
        'name'  => __('Layout Page', 'fashion'),
        'desc'  => __("Images for layout.", 'fashion'),
        'id'    => "layout",
        'std'   => "box",
        'type'  => "select",
        'options' => array(
            'full' =>'Full',
            'box' => 'Box'
        )
    );

    $options['general'][] = array(
        'name' => __('Header Contact', 'fashion'),
        'id' => 'header-contact',
        'type' => 'editor',
        'std' =>'<i class="fa fa-phone"></i>Call toll free:  <span>0123 456 789</span>',
        'settings' => $wp_editor_settings );
    
    $imagepath = get_template_directory_uri().'/images/options/';

    $options['general'][] = array(
        'name' => "Header Skin",
        'id' => "header",
        'std' => "default",
        'type' => "images",
        'options' => array(
            'default' => $imagepath . 'header-default.png',
            'style2' => $imagepath . 'header-style2.png')
    );

    $options['general'][] = array(
        'name' => __('Enable language ', 'fashion'),
        'desc' => __('Check the box to enable language.', 'fashion'),
        'id'   => 'enable_language',
        'std'  => '1',
        'type' => 'checkbox'
    );

    $options['general'][] = array(
        'name' => __('Enable currency ', 'fashion'),
        'desc' => __('Check the box to enable currency.', 'fashion'),
        'id'   => 'enable_currency',
        'std'  => '1',
        'type' => 'checkbox'
    );

    $options['general'][] = array(
        'name'      => __('Footer Style', 'fashion'),
        'desc'      => __("Choose one of your footers style that were created from Footers buider", 'fashion'),
        'id'        => "footer-style",
        'std'       => "default",
        'type'      => "select",
        'options'   => $footers
    );

    $options['general'][] = array(
        'name'      => __('Enable Footer Sticky', 'fashion'),
        'desc'      => __('Check the box to show sticky footer.', 'fashion'),
        'id'        => "footer-is-sticky",
        'std' => '1',
        'type' => 'checkbox'
    );

    // $options['general'][] = array(
    //     'name' => __( 'Logo', 'fashion' ),
    //     'desc' => '',
    //     'id' => 'logo',
    //     'type' => 'upload'
    // );

    // $options['general'][] = array(
    //     'name' => __( 'Logo', 'fashion' ),
    //     'desc' => '',
    //     'id' => 'logo',
    //     'type' => 'upload'
    // );

    $newoptions = WPO_Option::getInstance()->getOption( $options );

    /*
     *  if you would like to make new  options in new tabs. you  meger owner options with $newoptions
     *
     *  $owneroptions[] = array(
     *    'name' => __( 'Logo', 'fashion' ),
     *    'desc' => '',
     *    'id' => 'logo',
     *    'type' => 'upload'
     *  );
     *
     *  $newoptions = array_merge_recursive( $newoptions, $owneroptions );
     */

    return $newoptions;

}