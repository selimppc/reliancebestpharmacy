<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team < opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */


$nav_menu = ! empty( $atts['menu'] ) ? wp_get_nav_menu_object( $atts['menu'] ) : false;
if ( !$nav_menu )
	return;

if($atts['title']!=''){
	echo '<h3 class="widget-title">'.$atts["title"].'</h3>';
}

$args = array(	'menu' => $nav_menu ,
	            'menu_class' => 'megamenu-items',
	            'walker' => new Wpo_Megamenu_Sub()
            );
	wp_nav_menu($args);