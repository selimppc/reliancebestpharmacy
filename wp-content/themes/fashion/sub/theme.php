<?php
class WPO_SubTheme extends WPO_Framework {
	public function __construct(){
		parent::__construct();
		// Add default Sidebar
		$this->setSidebarDefault();

		/**
		* Register  Metabox
		*/
		$this->initMetaBox();

		// Add default Required Plugin
		$this->requiredPlugin();


		/* add  post types support as default */
 		$this->addThemeSupport( 'post-formats',  array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' , 'video' , 'audio' , 'chat' ) );
 		/* This theme uses post thumbnails */
		$this->addThemeSupport( 'post-thumbnails' );
		// Add default posts and comments RSS feed links to head*/
		$this->addThemeSupport( 'automatic-feed-links' );


        $this->addImagesSize('blog-home-image',281,235,true);
        $this->addImagesSize('blog-single-image',872,468,true);



		// Register Post type support
		$this->addPostTypeSuport( array( 'brands','testimonials', 'footer' ) );
		
		/**
		* Register  list of widgets supported inside framework
		*/
		$this->addWidgetsSuport( array( 'cart','twitter','sliders','recent_post','facebook_like','tabs','flickr','menu_vertical' ) );

		add_action( 'wp_head' , array($this,'ititThemeOption') );

		add_filter('WPO_Enable_Vertical_Megamenu',array($this,'enable_vertical_menu'));

		add_filter('body_class',array($this,'enable_sticky_menu'));
		
		if( WPO_VISUAL_COMPOSER_ACTIVED ){
			add_action( 'wp_enqueue_scripts' , array($this,'fix_VC_frontend_editor'),999 );
		}

	}



	public function fix_VC_frontend_editor(){
		wp_enqueue_script( 'vc_inline_iframe1_js', get_template_directory_uri() . '/js/vc_page_editable_custom.js' , array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-draggable','vc_inline_iframe_js' ), WPB_VC_VERSION, true );
	}

	public function enable_sticky_menu($classes){
		if(of_get_option('megamenu-is-sticky',true))
			$classes[] = 'main-menu-fixed';
		return $classes;
	}


	public function enable_vertical_menu(){
		return true;
	}

	public function ititThemeOption(){
	    global $wp_query,$fashion_option;
	    $fashion_option = array();
	    $layout = get_post_meta($wp_query->get_queried_object_id(),'wpo_template',true);
	    $layout = wp_parse_args( $layout, array(
	        'layout_page'   => of_get_option('layout','box')
	    ) );
	    
	    switch ($layout['layout_page']){
	        case 'full':
	            $fashion_option['topbar'] = '<div class="inner"><div class="container">';
	            $fashion_option['mainmenu'] = '<div class="mainnav-wrap"><div class="container">';
	            $fashion_option['copyright'] = '<div class="inner"><div class="container">';
	            $fashion_option['footer'] = '<div>';
	            break;
	       	default:
	            $fashion_option['topbar'] = '<div class="container"><div class="inner">';
	            $fashion_option['mainmenu'] = '<div class="container"><div class="mainnav-wrap">';
	            $fashion_option['copyright'] = '<div class="container"><div class="inner">';
	            $fashion_option['footer'] = '<div class="container">';
	            break;
	    }
	}

	private function requiredPlugin(){
		$this->addRequiredPlugin(array(
			'name'                     => 'Options Framework', // The plugin name
		    'slug'                     => 'options-framework', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'WooCommerce', // The plugin name
		    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'Contact Form 7', // The plugin name
		    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'WPBakery Visual Composer', // The plugin name
		    'slug'                     => 'js_composer', // The plugin slug (typically the folder name)
		    'required'                 => true,
		    'source'                   => 'http://www.wpopal.com/thememods/js_composer.zip', // The plugin source
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'Revolution Slider', // The plugin name
            'slug'                     => 'revslider', // The plugin slug (typically the folder name)
            'required'                 => true, // If false, the plugin is only 'recommended' instead of required
            'source'                   => 'http://www.wpopal.com/thememods/revslider.zip', // The plugin source
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'YITH WooCommerce Wishlist', // The plugin name
            'slug'                     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'required'                 => true
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'YITH WooCommerce Zoom Magnifier', // The plugin name
		    'slug'                     => 'yith-woocommerce-zoom-magnifier', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'YITH Woocommerce Compare', // The plugin name
            'slug'                     => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'required'                 => true
		));
	}


	/**
	 * Initial Scripts
	 */
	public function initScripts(){
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
      		wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script("jquery");
		/*  add scripts files  */
		wp_enqueue_script('base_bootstrap_js',WPO_FRAMEWORK_STYLE_URI.'js/bootstrap.min.js');
		// register google Map API
		wp_register_script('base_gmap_api_js','http://maps.google.com/maps/api/js?sensor=true');
		wp_register_script('base_gmap_function_js',WPO_FRAMEWORK_STYLE_URI.'js/jquery.ui.map.min.js');


		foreach( $this->scripts as $key => $file ) {
			wp_register_script( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_script( $key );
		}

		wp_enqueue_script('base_wpo_plugin_js',WPO_FRAMEWORK_STYLE_URI.'js/wpo-plugin.js',array(),false,true);
		wp_enqueue_script('base_wpo_megamenu_js',WPO_FRAMEWORK_STYLE_URI.'js/megamenu.js',array(),false,true);
		wp_enqueue_style( 'theme-style', get_stylesheet_uri());
		

		// Check RTL
		if(is_rtl()){
			wp_enqueue_style('base-bootstrap',get_template_directory_uri().'/css/bootstrap-rtl.css');
		}else{
			wp_enqueue_style('base-bootstrap',get_template_directory_uri().'/css/bootstrap.css');
		}

		wp_enqueue_style('base-fonticon',get_template_directory_uri().'/css/font-awesome.min.css');
		$templatecss = of_get_option('skin','default');
		//if($templatecss=='default'){
			wp_enqueue_style('base-template',get_template_directory_uri().'/css/template.css');
		//}
		
		wp_enqueue_style('base-animation',WPO_FRAMEWORK_STYLE_URI.'css/animation.css');

		/* add styles files */
		foreach( $this->styles as $key => $file ) {
			wp_register_style( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_style( $key );
		}
		if(is_rtl()){
			wp_enqueue_style('base-style-rtl',get_template_directory_uri().'/css/rtl/template.css');
		}
		if(of_get_option('customize-theme','')!=''){
			wp_enqueue_style('customize-style',WPO_FRAMEWORK_CUSTOMZIME_STYLE_URI.of_get_option('customize-theme').'.css');
		}
	}

	

	/**
	 * Init Meta Box fields
	 */
	private function initMetaBox(){
		$path = get_template_directory() . '/sub/customfield/';
		if(function_exists('of_get_option')){
			if(of_get_option('is-seo',true)){
				new WPO_MetaBox(array(
				    'id' => 'wpo_seo',
				    'title' => esc_html__('SEO Fields', 'fashion'),
				    'types' => array('page','portfolio','post','video'),
				    'priority' => 'high',
				    'template' => $path . 'seo.php',
				));
			}
		}

		new WPO_MetaBox(array(
		    'id' => 'wpo_template',
		    'title' => esc_html__('Advanced Configuration', 'fashion'),
		    'types' => array('page'),
		    'priority' => 'high',
		    'template' => $path . 'page-advanced.php'
		));

		new WPO_MetaBox(array(
		    'id' => 'wpo_brand',
		    'title' => esc_html__('Configuration', 'fashion'),
		    'types' => array('brands'),
		    'priority' => 'high',
		    'template' => $path . 'brands.php'
		));

		new WPO_MetaBox(array(
		    'id' => 'wpo_pageconfig',
		    'title' => esc_html__('Page Configuration', 'fashion'),
		    'types' => array('page'),
		    'priority' => 'high',
		    'template' => $path . 'page.php',
		));

		new WPO_MetaBox(array(
		    'id' => 'wpo_post',
		    'title' => esc_html__('Embed Options', 'fashion'),
		    'types' => array('post','video'),
		    'priority' => 'high',
		    'template' => $path . 'post.php',
		));
	}

	//override
	public function configLayout($layout,$config=array()){
		switch ($layout) {
			// Two Sidebar
			case '1-1-1':
				$config['left-sidebar']['show'] 	= true;
				$config['left-sidebar']['class'] 	='col-sm-6 col-md-3 col-md-pull-6';
				$config['right-sidebar']['class']	='col-sm-6  col-md-3';
				$config['right-sidebar']['show'] 	= true;
				$config['main']['class'] 			='col-xs-12 col-md-6 col-md-push-3';
				break;
			//One Sidebar Right
			case '0-1-1':
				$config['left-sidebar']['show'] 	= false;
				$config['right-sidebar']['show'] 	= true;
				$config['main']['class']  			='col-xs-12 col-sm-8 col-md-9 no-sidebar-left';
				$config['right-sidebar']['class'] 	='col-xs-12 col-sm-4  col-md-3';
				break;
			// One Sidebar Left
			case '1-1-0':
				$config['left-sidebar']['show'] 	= true;
				$config['right-sidebar']['show'] 	= false;
				$config['left-sidebar']['class'] 	='col-xs-12 col-sm-4 col-sm-pull-8 col-md-3 col-md-pull-9';
				$config['main']['class'] 			='col-xs-12 col-sm-8 col-sm-push-4 col-md-9 col-md-push-3 no-sidebar-right';
				break;

			case 'm-1-1':
				$config['left-sidebar']['show'] 	= true;
				$config['left-sidebar']['class'] 	='col-sm-6 col-md-3 sidebar-main';
				$config['right-sidebar']['class']	='col-sm-6  col-md-3';
				$config['right-sidebar']['show'] 	= true;
				$config['main']['class'] 			='col-xs-12 col-md-6';
				break;

			case '1-1-m':
				$config['left-sidebar']['show'] 	= true;
				$config['right-sidebar']['show'] 	= true;
				$config['left-sidebar']['class'] 	='col-sm-6 col-md-3 col-md-pull-6';
				$config['right-sidebar']['class']	='col-sm-6 col-md-3 col-md-pull-6';
				$config['main']['class'] 			='col-xs-12 col-md-6 col-md-push-6';
				break;
			// Fullwidth
			default:
				$config['left-sidebar']['show'] 	= false;
				$config['right-sidebar']['show'] 	= false;
				$config['main']['class'] 			='col-xs-12 no-sidebar';
				break;
		}
		return $config;
	}

	/**
	*
	*/
	private function setSidebarDefault(){
		$this->addSidebar('slideshow',
			array(
				'name'          => esc_html__( 'Slideshow' , 'fashion'),
				'id'            => 'slideshow',
				'description'   => esc_html__( 'Appears in the slideshow section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));

		$this->addSidebar('sidebar-left',
			array(
				'name'          => esc_html__( 'Left Sidebar' , 'fashion'),
				'id'            => 'sidebar-left',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s sidebar-element">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>'
			));
        $this->addSidebar('sidebar-right',
            array(
                'name'          => esc_html__( 'Right Sidebar' , 'fashion'),
                'id'            => 'sidebar-right',
                'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'fashion'),
                'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s sidebar-element">',
                'after_widget'  => '</aside>',
                'before_title'  => '<div class="box-heading"><span>',
                'after_title'   => '</span></div>',
            ));
        $this->addSidebar('blog-sidebar-left',
			array(
				'name'          => esc_html__( 'Blog Left Sidebar' , 'fashion'),
				'id'            => 'blog-sidebar-left',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s sidebar-element">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>'
			));
        $this->addSidebar('blog-sidebar-right',
            array(
                'name'          => esc_html__( 'Blog Right Sidebar', 'fashion' ),
                'id'            => 'blog-sidebar-right',
                'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'fashion'),
                'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s sidebar-element">',
                'after_widget'  => '</aside>',
                'before_title'  => '<div class="box-heading"><span>',
                'after_title'   => '</span></div>',
            ));

		$this->addSidebar('footer-1',
			array(
				'name'          => esc_html__( 'Footer 1', 'fashion' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
		$this->addSidebar('footer-2',
			array(
				'name'          => esc_html__( 'Footer 2' , 'fashion'),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
		$this->addSidebar('footer-3',
			array(
				'name'          => esc_html__( 'Footer 3' , 'fashion'),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
		$this->addSidebar('footer-4',
			array(
				'name'          => esc_html__( 'Footer 4', 'fashion' ),
				'id'            => 'footer-4',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
        $this->addSidebar('footer-5',
			array(
				'name'          => esc_html__( 'Footer 5' , 'fashion'),
				'id'            => 'footer-5',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
        $this->addSidebar('footer-sticky',
			array(
				'name'          => esc_html__( 'Footer Sticky' , 'fashion'),
				'id'            => 'footer-sticky',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'fashion'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="box-heading"><span>',
				'after_title'   => '</span></div>',
			));
	}
}
?>