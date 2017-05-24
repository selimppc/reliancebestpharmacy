<?php

	class WPO_Shortcode_Video extends WPO_Shortcode_Base{

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
				'icon'	 => 'video',
				'title' => esc_html__( 'Video' , 'fashion'),
				'desc'  => esc_html__( 'Embed Youtube/Vimeo Video' , 'fashion'),
				'name'  => $this->name
			);
			return $button;
		}

		public function getOptions( ){
		    $this->options[] = array(
		        'label' 	=> esc_html__('Video Link', 'fashion'),
		        'id' 		=> 'link',
		        'type' 		=> 'embed',
		        'explain'	=> esc_html__( 'Enter Vimeo Link or Youtube Here' , 'fashion'),
		        'default'	=> '',
		        'hint'		=> '',
	        );
	        $this->options[] = array(
		        'label' 	=> esc_html__('Addition Class', 'fashion'),
		        'id' 		=> 'class',
		        'type' 		=> 'text',
		        'explain'	=> esc_html__( 'Using to make own style' , 'fashion'),
		        'default'	=> '',
		        'hint'		=> '',
	        );
		}

		public function render( $atts ){
			$class = ($atts['class']!='')?" ".$atts['class']:"";
			$output='
				<div class="video-responsive'.$class.'">
					'.wp_oembed_get($atts["link"]).'
				</div>
			';
			return $output;
		}
	}
?>