<?php

	class WPO_Shortcode_Sidebar extends WPO_Shortcode_Base{

		public function __construct( ){
			// add hook to convert shortcode to html.
			$this->name = str_replace( 'wpo_shortcode_','',strtolower( __CLASS__ ) );
			$this->key = 'wpo_'.$this->name;

			parent::__construct( );
		}


		/**
		 * $data format is object field of megamenu_widget record.
		 */
		public function getButton( $data=null ){
			$button = array(
				'icon'	 => 'sidebar',
				'title' => esc_html__( 'Sidebar Embeded', 'fashion' ),
				'desc'  => esc_html__( 'Embeded widgets in a sidebar' , 'fashion'),
				'name'  => $this->name
			);
			return $button;
		}

		public function getOptions( ){

		    $this->options[] = array(
		        'label' 	=> __('Sidebar', 'fashion'),
		        'id' 		=> 'sidebar',
		        'type' 		=> 'sidebars',
		        'explain'	=> __( 'Display all widgets on selected sidebar', 'fashion' )
	        );

	        $this->options[] = array(
		        'label' 	=> __('Addition Class', 'fashion'),
		        'id' 		=> 'class',
		        'type' 		=> 'text',
		        'explain'	=> __( 'Using to make own style', 'fashion' ),
		        'default'	=> '',
		        'hint'		=> '',
	        );
		}

		public function render( $atts ){
			$class = trim($atts['class']);
			$output = '';
			if($class!=""){
				$output.='<div class="'.$class.'">';
			}
				ob_start();
				dynamic_sidebar($atts['sidebar']);
				$output.=ob_get_clean();
			if($class!=""){
				$output.='</div>';
			}
			return $output;
		}
	}
?>