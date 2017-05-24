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


if( !defined("WPO_THEME_DIR") ){
   define( 'WPO_THEME_DIR', get_template_directory() );
   define( 'WPO_THEME_URI', get_template_directory_uri() );
}


define( 'WPO_FRAMEWORK_PATH', WPO_THEME_DIR . '/framework/' );
define( 'WPO_FRAMEWORK_MEGAMENU', WPO_FRAMEWORK_PATH.'megamenu/' );
define( 'WPO_FRAMEWORK_SHORTCODE', WPO_FRAMEWORK_PATH.'shortcodes/' );
define( 'WPO_FRAMEWORK_LANGUAGE', WPO_FRAMEWORK_PATH.'language' );
define( 'WPO_FRAMEWORK_WIDGETS', WPO_FRAMEWORK_PATH.'widgets/' );
define( 'WPO_FRAMEWORK_POSTTYPE', WPO_FRAMEWORK_PATH.'types/' );

define( 'WPO_FRAMEWORK_TEMPLATES', WPO_THEME_DIR.'/templates/' );
define( 'WPO_FRAMEWORK_WOOCOMMERCE_WIDGETS', WPO_THEME_DIR.'/woocommerce/widgets/' );
define( 'WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER', WPO_THEME_DIR.'/vc_templates/' );
define( 'WPO_FRAMEWORK_ADMIN_TEMPLATE_PATH', WPO_THEME_DIR . '/framework/admin/templates/' );
define( 'WPO_FRAMEWORK_PLUGINS', WPO_THEME_DIR.'/framework/plugins/' );
define( 'WPO_FRAMEWORK_XMLPATH', WPO_THEME_DIR.'/sub/customize/' );
define( 'WPO_FRAMEWORK_CUSTOMZIME_STYLE', WPO_FRAMEWORK_XMLPATH.'assets/' );

// URI
define( 'WPO_FRAMEWORK_CUSTOMZIME_STYLE_URI', WPO_THEME_URI.'/sub/customize/assets/' );
define( 'WPO_FRAMEWORK_ADMIN_STYLE_URI', WPO_THEME_URI.'/framework/admin/assets/' );
define( 'WPO_FRAMEWORK_ADMIN_IMAGE_URI', WPO_FRAMEWORK_ADMIN_STYLE_URI.'images/' );
define( 'WPO_FRAMEWORK_STYLE_URI', WPO_THEME_URI.'/framework/assets/' );

global $wpdb;
define( 'DB_PREFIX', $wpdb->prefix  );
//echo WPO_FRAMEWORK_POSTTYPE;
require_once ( WPO_FRAMEWORK_PATH . 'functions/functions.php');
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/metabox.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/params.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/plugin-activation.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu-config.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu-vertical.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu-sub.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu-offcanvas.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/megamenu-widget.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/shortcodebase.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/template.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/options.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/core/pagebuilder.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/megamenu-editor.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/multiple_sidebars.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/admin.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/framework.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/woocommerce.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/shortcodes.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/livetheme.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/widget.php' );

if( is_admin() ){
  require_once ( WPO_FRAMEWORK_PATH . 'import/import.php' );
  require_once ( WPO_FRAMEWORK_PATH . 'export/export.php' );
}

//$WPO_SHORTCODE =   WPO_Shortcodes::getInstance();