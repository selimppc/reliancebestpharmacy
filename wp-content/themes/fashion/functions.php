<?php
 /**
 * Theme function
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <opalwordpress@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

define( 'WPO_THEME_DIR', get_template_directory() );
define( 'WPO_THEME_SUB_DIR', WPO_THEME_DIR.'/sub/' );
define( 'WPO_THEME_CSS_DIR', WPO_THEME_DIR.'/css/' );
define( 'WPO_THEME_URI', get_template_directory_uri() );

define( 'WPO_THEME_NAME', 'fashion' );
define( 'WPO_THEME_VERSION', '1.0' );
 
define( 'WPO_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
define( 'WPO_VISUAL_COMPOSER_ACTIVED', in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

/*
 * Include list of files from Opal Framework.
 */ 
require_once( WPO_THEME_DIR . '/framework/loader.php' );
require_once( WPO_THEME_DIR . '/sub/theme.php' );
require_once( WPO_THEME_DIR . '/sub/startup.php' );


/*
 *  Shortcodes
 */
require_once( WPO_THEME_DIR. '/shortcode.php' );

/*
 * Pagebuilder Visual Composer
 */
/**
 * Create variant objects to modify and proccess actions of only theme.
 */
if( WPO_VISUAL_COMPOSER_ACTIVED ){
	require_once( WPO_THEME_DIR . '/sub/pagebuilder.php' );
	$path = WPO_THEME_SUB_DIR . '/vc_shortcodes/class/*.php';
	$files = glob($path);
	foreach ($files as $key => $file) {
		if(is_file($file)){
			require($file);
		}
	}
}


/// include list of functions to process logics of worpdress not support 3rd-plugins.
require_once( WPO_THEME_DIR . '/sub/functions/theme.php' );

/// WooCommerce specified functions
if( WPO_WOOCOMMERCE_ACTIVED  ) {
    require_once( WPO_THEME_DIR . '/sub/functions/woocommerce.php' );
}

add_action( 'after_setup_theme', 'fashion_fnc_setup' );
function fashion_fnc_setup() {
	add_theme_support( 'title-tag' );
}