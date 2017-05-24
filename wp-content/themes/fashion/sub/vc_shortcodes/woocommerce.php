<?php 
	
	/**
	 * wpo_productcategory
	 */

	$value = array();

	global $wpdb;
	
	if( is_admin() ){
		$sql = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = 'product_cat'";
		$results = $wpdb->get_results($sql);
		
		foreach ($results as $vl) {
			$value[$vl->name] = $vl->slug;
		}
	}
		
	$product_layout = array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel');
	$product_type = array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' );
	$product_columns = array(6,4, 3, 2, 1);
	$show_tab = array(
	                array('recent', __('Latest Products', 'fashion')),
	                array( 'featured_product', __('Featured Products', 'fashion' )),
	                array('best_selling', __('BestSeller Products', 'fashion' )),
	                array('top_rate', __('TopRated Products', 'fashion' )),
	                array('on_sale', __('Special Products', 'fashion' ))
	            );

	vc_map( array(
	    "name" => __("WPO Product Category",'fashion'),
	    "base" => "wpo_productcategory",
	    "class" => "",
	    "category" => esc_html__('Opal Widgets','fashion'),
	    "params" => array(
	    	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__('Category','fashion'),
				"param_name" => "category",
				"value" =>$value,
				"admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style", 'fashion'),
				"param_name" => "style",
				"value" => $product_layout
			),
			array(
				"type" => "textfield",
				"heading" => __("Carousel row(s)", 'fashion'),
				"param_name" => "carousel_row",
				"value" => '2',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'carousel' )
				)
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show", 'fashion'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count", 'fashion'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.", 'fashion')
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon", 'fashion'),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'fashion'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
			)
	   	)
	));
	add_shortcode( 'wpo_productcategory', ('wpo_vc_shortcode_render') );

	

	/**
	 * wpo_products
	 */
	vc_map( array(
	    "name" => __("WPO Products",'fashion'),
	    "base" => "wpo_products",
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
				"heading" => __("Type", 'fashion'),
				"param_name" => "type",
				"value" => $product_type,
				"admin_label" => true,
				"description" => __("Select columns count.", 'fashion')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style", 'fashion'),
				"param_name" => "style",
				"value" => $product_layout
			),
			array(
				"type" => "textfield",
				"heading" => __("Carousel row(s)", 'fashion'),
				"param_name" => "carousel_row",
				"value" => '2',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'carousel' )
				)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count", 'fashion'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.", 'fashion')
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show", 'fashion'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'fashion'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
			)
	   	)
	));
	add_shortcode( 'wpo_products', ('wpo_vc_shortcode_render')  );

	/**
	 * wpo_all_products
	 */
	vc_map( array(
	    "name" => __("WPO Products Tabs",'fashion'),
	    "base" => "wpo_all_products",
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
	            "type" => "sorted_list",
	            "heading" => __("Show Tab", 'fashion'),
	            "param_name" => "show_tab",
	            "description" => __("Control teasers look. Enable blocks and place them in desired order.", 'fashion'),
	            "value" => "recent,featured_product,best_selling",
	            "options" => $show_tab
	        ),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show", 'fashion'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of row to show", 'fashion'),
				"param_name" => "row",
				"value" => '1'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count", 'fashion'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.", 'fashion')
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'fashion'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
			)
	   	)
	));

	/**
	 * wpo_brands
	 */
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
				"value" => ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of brands to show", 'fashion'),
				"param_name" => "number",
				"value" => '6'
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon", 'fashion'),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'fashion'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'fashion')
			)
	   	)
	));
	add_shortcode( 'wpo_brands', ('wpo_vc_shortcode_render')  );

?>