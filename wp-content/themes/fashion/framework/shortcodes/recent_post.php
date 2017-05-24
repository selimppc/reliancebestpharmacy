<?php

	class WPO_Shortcode_Recent_post extends WPO_Shortcode_Base{

		public function __construct( ){
			// add hook to convert shortcode to html.
			$this->name = str_replace( 'wpo_shortcode_','',strtolower( __CLASS__ ) );
			$this->key = 'wpo_'.$this->name;
			add_shortcode( $this->key  ,  array($this,'render') );
			$this->excludedMegamenu = true;
			parent::__construct( );
		}

		/**
		 * $data format is object field of megamenu_widget record.
		 */
		public function getButton( $data=null ){
			$button = array(
				'icon'	 => 'recentpost',
				'title' => esc_html__( 'Recent Post' , 'fashion'),
				'desc'  => esc_html__( 'Display List of Newest Post' , 'fashion'),
				'name'  => $this->name
			);
			return $button;
		}

		public function getOptions( ){
		    $this->options[] = array(
		        'label' 	=> __('Limited Post', 'fashion'),
		        'id' 		=> 'limit',
		        'type' 		=> 'text',
		        'explain'	=> esc_html__( 'Enter Vimeo Link or Youtube Here' , 'fashion'),
		        'default'	=> '6',
		        'hint'		=> '',
	        );

	        $this->options[] = array(
		        'label' 	=> __('Display Date', 'fashion'),
		        'id' 		=> 'enable_date',
		        'type' 		=> 'select',
		        'explain'	=> esc_html__( 'Display posted data' , 'fashion'),
		        'default'	=> '0',
		        'options'   => array( 0=>esc_html__('No', 'fashion'), 1=>esc_html__('Yes', 'fashion') ),
		        'hint'		=> '',
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

		public function render( $attrs, $content="" ){
			return '<div>'.$attrs['style'].'</div>';
		}
	}
?>