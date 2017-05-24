<?php

$nav_menu = ( $menu !='' ) ? wp_get_nav_menu_object( $menu ) : false;
if(!$nav_menu) return false;
$postion_class = ($position=='left')?'menu-left':'menu-right';
$args = array(  'menu' => $nav_menu,
                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse vertical-menu '.$postion_class,
                'menu_class' => 'nav navbar-nav megamenu',
                'fallback_cb' => '',
                'walker' => new Wpo_Megamenu_Vertical());
?>
<div class="hidden-xs">
	<?php
	if ( $title ) {
	    echo $before_title .'<i class="fa fa-bars pull-left"></i>'. $title . $after_title;
	}

	?>
	<div class="box-content">
		<?php wp_nav_menu($args); ?>
	</div>
</div>
