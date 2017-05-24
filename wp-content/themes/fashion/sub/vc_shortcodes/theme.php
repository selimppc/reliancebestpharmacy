<?php

$option_menu = array('---Select Menu---'=>'');

if( is_admin() ){
	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
	foreach ($menus as $menu) {
		$option_menu[$menu->name]=$menu->term_id;
	}
}

vc_map( array(
    "name" => __("WPO Vertical Menu",'fashion'),
    "base" => "wpo_verticalmenu",
    "class" => "",
    "category" => esc_html__('WPO Elements','fashion'),
    "params" => array(
    	array(
			"type" => "textfield",
			"heading" => __("Title", 'fashion'),
			"param_name" => "title",
			"value" => 'Vertical Menu'
		),
    	array(
			"type" => "dropdown",
			"heading" => __("Menu", 'fashion'),
			"param_name" => "menu",
			"value" => $option_menu,
			"admin_label" => true,
			"description" => __("Select menu.", 'fashion')
		),
		array(
			"type" => "dropdown",
			"heading" => __("Position", 'fashion'),
			"param_name" => "postion",
			"value" => array(
					'left'=>'left',
					'right'=>'right'
				),
			"admin_label" => true,
			"description" => __("Postion Menu Vertical.", 'fashion')
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'fashion'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
		)
   	)
));
add_shortcode( 'wpo_verticalmenu', ('wpo_vc_shortcode_render') );

/* =================================================================== */
/*
 * Testimonials
 */
/* =================================================================== */
vc_map( array(
    "name" => __("WPO Banner",'fashion'),
    "base" => "wpo_banner",
    "class" => "",
    "category" => esc_html__('Opal Widgets','fashion'),
    "params" => array(
    	array(
			"type" => "textfield",
			"heading" => __("Title", 'fashion'),
			"param_name" => "title",
			"admin_label" => true,
			"value" => ''
		),
		array(
			"type" => "textfield",
			"heading" => __("Sub Title", 'fashion'),
			"param_name" => "sub_title",
			"value" => ''
		),
		array(
			"type" => "attach_image",
			"heading" => __("Image", 'fashion'),
			"param_name" => "image",
		),
		array(
			"type" => "textarea",
			"heading" => __("Description", 'fashion'),
			"param_name" => "desc",
		),
		array(
			"type" => "textfield",
			"heading" => __("Link", 'fashion'),
			"param_name" => "link",
			"value" => '#'
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'fashion'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
		)
   	)
));
add_shortcode( 'wpo_banner', ('wpo_vc_shortcode_render') );


/* =================================================================== */
/*
 * Testimonials
 */
/* =================================================================== */
vc_map( array(
    "name" => __("WPO Testimonials",'fashion'),
    "base" => "wpo_testimonials",
    "class" => "",
    "category" => esc_html__('Opal Widgets','fashion'),
    "params" => array(
    	array(
			"type" => "textfield",
			"heading" => __("Title", 'fashion'),
			"param_name" => "title",
			"admin_label" => true,
			"value" => ''
		),
		array(
			"type" => "dropdown",
			"heading" => __("Skin", 'fashion'),
			"param_name" => "skin",
			"value" => array('Skin 1'=>'skin-1','Skin 2'=>'skin-2'),
			"admin_label" => true,
			"description" => __("Select Skin layout.", 'fashion')
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'fashion'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
		)
   	)
));
add_shortcode( 'wpo_testimonials', ('wpo_vc_shortcode_render') );


/* =================================================================== */
/*
 * Brands
 */
/* =================================================================== */
vc_map( array(
    "name" => __("WPO Brands",'fashion'),
    "base" => "wpo_brands",
    "class" => "",
    "category" => esc_html__('Opal Widgets','fashion'),
    "params" => array(
    	array(
			"type" => "textfield",
			"heading" => __("Title", 'fashion'),
			"param_name" => "title",
			"value" => '',
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __("Number of brands to show", 'fashion'),
			"param_name" => "number",
			"value" => '6',
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __("Layout", 'fashion'),
			"param_name" => "layout",
			"value" => array('Grid'=>'grid','Carousel'=>'carousel'),
			"admin_label" => true,
			"description" => __("Select Skin layout.", 'fashion'),
			"std"=>'carousel'
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'fashion'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
		)
   	)
));
add_shortcode( 'wpo_brands', ('wpo_vc_shortcode_render') );





