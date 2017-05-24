<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */



class WPO_PageBuilder extends WPO_PageBuilder_Base{

	public function __construct(){
		parent::__construct();

		$this->loadThemeShortCode();

		//Edit Elements
		$this->elementTabItem();
		$this->elementButton();
		$this->elementColumn();
		$this->elementRow();
		$this->elementTitle();
		$this->elementPostGrid();
		$this->elementSingleImage();
	}

	/**
	 *
	 */	
	private function loadThemeShortCode(){ 
		if( WPO_WOOCOMMERCE_ACTIVED ) {
			require_once( WPO_THEME_SUB_DIR.'vc_shortcodes/woocommerce.php');	
		}
		require_once( WPO_THEME_SUB_DIR.'vc_shortcodes/theme.php');		
	} 	

	private function elementSingleImage(){
		$param = WPBMap::getParam( 'vc_single_image' , 'css_animation');
		$param['heading'] = 'Effect' ;
		$param['value']=array(
				'Overlay' => 'overlay',
				'Overlay Full' => 'overlay-full',
				'Overlay Bottom' => 'overlay-bottom',
				'Overlay Top' => 'overlay-top',
				'Overlay Right' => 'overlay-right',
				'Overlay Left' => 'overlay-left',
				'Overlay Rotate' => 'overlay-rotate',
				'Overlay In to out' => 'overlay-in-to-out',
				'Overlay Out to in' => 'overlay-out-to-in',
				'overlay Top to bottom' => 'overlay-top-to-bottom',
			);
		$param['description']='';
		$param['admin_label']=true;
		WPBMap::mutateParam('vc_single_image', $param);
	}

	/**
	 *
	 */	
	private function elementPostGrid(){
		$this->deleteParam('vc_posts_grid',array(
												'grid_columns_count',
												'grid_layout',
												'grid_link_target',
												'filter',
												'grid_layout_mode',
												'grid_thumb_size'
												));
		vc_add_param( 'vc_posts_grid', array(
				"type" => "dropdown",
				"heading" => __("Layout Type", 'fashion'),
				"param_name" => "layout",
				"value" => array(
						'Grid 1'=>'grid-1',
						'Grid 2'=>'grid-2',
						'List 1'=>'list-1',
						'List 2'=>'list-2',
						'List 3'=>'list-3',
						'List 4'=>'list-4',
						'Featured 1'=>'featured-1',
						'Featured 2'=>'featured-2'
					),
					array(
						"type" => "dropdown",
						"heading" => __("Columns count", 'fashion'),
						"param_name" => "columns_count",
						"value" => array(4, 3, 2, 1),
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
			));
		}

		private function elementTitle(){
			vc_add_param( 'vc_text_separator', array(
		         "type" => "textarea",
		         "heading" => esc_html__("Description", 'fashion'),
		         "param_name" => "descript",
		         "value" => ''
		    ));
		}

		private function elementRow(){
			vc_add_param( 'vc_row', array(
		         "type" => "checkbox",
		         "heading" => esc_html__("Full Width", 'fashion'),
		         "param_name" => "fullwidth",
		         "value" => array(
		         				'Yes, please' => true
		         			)
		    ));
		}

		private function elementColumn(){
			$add_css_animation = array(
				"type" => "dropdown",
				"heading" => __("CSS Animation", 'fashion'),
				"param_name" => "css_animation",
				"admin_label" => true,
				"value" => $this->cssAnimation,
				"description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'fashion')
			);
			vc_add_param('vc_column',$add_css_animation);
			vc_add_param('vc_column_inner',$add_css_animation);
		}


		/**
		 * Tab Item
		 */
		private function elementTabItem(){
			vc_add_param( 'vc_tab', array(
		         "type" => "textfield",
		         "heading" => esc_html__("Icon", 'fashion'),
		         "param_name" => "tabicon",
		         "value" => ''
		    ));
		}

		/**
		 * Button
		 */
		private function elementButton(){
			// color
			$param = WPBMap::getParam('vc_button', 'color');
			$param['value'] = array(
								'Default'=>'btn-default',
								'Primary'=>'btn-success',
								'Success'=>'btn-success',
								'Info'=>'btn-warning',
								'Danger'=>'btn-danger',
								'Link'=>'btn-link'
							);
			$param['heading']='Type';
			WPBMap::mutateParam('vc_button', $param);

			// icon
			$param = WPBMap::getParam('vc_button', 'icon');
			$param['type']='textfield';
			$param['value']='';
			WPBMap::mutateParam('vc_button', $param);

			// size
			$param = WPBMap::getParam('vc_button', 'size');
			$param['value']= array(
								'Default'=>'',
								'Large'=>'btn-lg',
								'Small'=>'btn-sm',
								'Extra small'=>'btn-xs'
							);
			WPBMap::mutateParam('vc_button', $param);
		}

		/**
		 * Image Carousel
		 */

		private function elementImageCarousel(){
			$this->deleteParam('vc_images_carousel',array(
														'img_size',
														'onclick',
														'fashion',
														'slides_per_view',
														'wrap',
														'partial_view',
														'speed',
														'autoplay'
													));
		}


		private function elementProgressBar(){
			$this->deleteParam('vc_progress_bar',array(
											'title',
											'units',
											'bgcolor',
											'custombgcolor',
											'options'
										));
		}

	}

add_action( 'init', 'wpo_init_pagebuilder' );
function wpo_init_pagebuilder(){
	new WPO_PageBuilder();
}