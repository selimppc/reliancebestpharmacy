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

class WPO_Shortcode_Submenu extends WPO_Shortcode_Base{

		public function __construct( ){
			// add hook to convert shortcode to html.
			$this->name = str_replace( 'wpo_shortcode_','',strtolower( __CLASS__ ) );
			$this->key = 'wpo_'.$this->name;

			add_shortcode( $this->key  ,  array($this,'render') );

			parent::__construct( );
		}

		/**
		 * $data format is object field of megamenu_widget record.
		 */
		public function getButton( $data=null ){
			$button = array(
				'icon'	 => 'content',
				'title' => esc_html__( 'Sub Menu' , 'fashion'),
				'desc'  => '',
				'name'  => $this->name
			);
			return $button;
		}

		public function getOptions( ){
		    $this->options[] = array(
		        'label' 	=> __('Title', 'fashion'),
		        'id' 		=> 'title',
		        'type' 		=> 'input',
		        'explain'	=> __( 'Put Title Here', 'fashion' ),
		        'default'	=> '',
		        'hint'		=> '',
	        );

	        $menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
	        $option = array();
	        foreach ($menus as $menu) {
	        	$option[$menu->term_id]=$menu->name;
	        }

	        $this->options[] = array(
		        'label' 	=> __('Menu', 'fashion'),
		        'id' 		=> 'menu',
		        'type' 		=> 'select',
		        'explain'	=> __( 'Select Menu', 'fashion' ),
		        'default'	=> '',
		        'options' 	=> $option,
		        'hint'		=> '',
	        );

	        $this->options[] = array(
		        'label' 	=> __('Addition Class', 'fashion'),
		        'id' 		=> 'class',
		        'type' 		=> 'input',
		        'explain'	=> __( 'Using to make own style', 'fashion' ),
		        'default'	=> '',
		        'hint'		=> '',
	        );
		}
	}
?>