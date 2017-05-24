<?php

	class WPO_Shortcode_Tab extends WPO_Shortcode_Base{

		public function __construct( ){

			// add hook to convert shortcode to html.
			 $this->name = str_replace( 'wpo_shortcode_','',strtolower( __CLASS__ ) );
 		 	 $this->key = 'wpo_'.$this->name;
			 add_shortcode( $this->key  ,  array($this,'render') );
			 $this->excludedMegamenu = true;
		}

		public function getButton( $data=null ){
			return array(
				'icon'	=> 'tab',
				'title' => esc_html__( 'Tab List' , 'fashion'),
				'desc'  => esc_html__( 'Display Tab List Supported By Bootstrap 3' , 'fashion'),
				'name'  => $this->name
			);
		}

		public function getOptions( ){

		}

		public function getAttrs( $attrs=array() ){

		}

		/**
		 *
		 */
		public function render( $atts, $content="" ){

		}
	}


?>