<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
if(!class_exists('WPO_Framework')){

abstract class WPO_Framework extends WPO_Template {

	/**
	 * @var String $themeName
	 *
	 * @access public
	 */
	protected $themeName='wpbase';

	/**
	 * @var Array $options
	 *
	 * @access protected
	 */
	protected $options=array();

	/**
	 * @var Array $menu
	 *
	 * @access protected
	 */
	protected $menus=array();

	/**
	 * @var string $sidebars
	 *
	 * @access protected
	 */
	protected $sidebars = array();

	/**
	 * @var Array $shortcodes
	 *
	 * @access protected
	 */
	protected $shortcodes = array();

	/**
	 * @var Array $images
	 *
	 * @access protected
	 */
	protected $imagesSize = array();

	/**
	 * @var Array $requiredPlugins
	 *
	 * @access protected
	 */
	protected $requiredPlugins = array();

	/**
	 * @var Array $scripts storing list of javascript files
	 *
	 * @access protected
	 */
	protected $scripts = array();

	/**
	 * @var Array $styles storing list of stylesheets files
	 *
	 * @access protected
	 */

	protected $styles = array();

	protected $themesSupports = array();

	protected $widgets = array();

	protected $posttype = array();

	/**
	 * constructor
	 */
	public function __construct(){
		$themename = get_option( 'stylesheet' );
        $themename = preg_replace("/\W/", "_", strtolower($themename) );

		$this->themeName = $themename;
		if( !defined('TEXTDOMAIN') ){
			define( 'TEXTDOMAIN', $themename );
		}
		if ( ! isset( $content_width ) ) $content_width = 900;
	}


	/**
	 *
	 */
	public function addImagesSize( $name=null, $width=0,$height=0,$crop=false){
		if($name!=null){
			$this->imagesSize[$name] = array('width'=>$width,'height'=>$height,'crop'=>$crop);
		}
	}

	/**
	 * Register  list of widgets supported inside framework
	 */
	public function addWidgetsSuport( $widgets=array()){
		if( is_array($widgets) ){
			$this->widgets = $widgets;
		}
	}

	/**
	 * Register  list of widgets supported inside framework
	 */
	public function addPostTypeSuport( $posttype=array()){
		if( is_array($posttype) ){
			$this->posttype = $posttype;
		}
	}

	/**
	 *
	 */
	public function setPostThumbnailSize($width=0,$height=0,$crop=false){
		set_post_thumbnail_size($width,$height,$crop);
	}

	/**
	 *
	 */
	public function addMenu( $location, $description  ){
		$this->menus[$location] = $description;
	}

	/**
	 *
	 */
	public function addRequiredPlugin( $required ){
		$this->requiredPlugins[] = $required;
	}

	/**
	 *
	 */
	public function addSidebar($key,$sidebar){
		if(is_array($sidebar))
			$this->sidebars[$key] = $sidebar;
	}


	/**
	 *
	 */
	public function addThemeSupport( $support, $default=null ){
		$this->themesSupports[$support] = $default;
	}

	/**
	 *
	 */
	public function addScript( $key, $src,$deps=array(),$ver=false,$in_footer=false){
		$this->scripts[$key] = array($src,$deps,$ver,$in_footer);
	}

	public function removeScript( $key ){
		if( isset($this->scripts[$key]) ){
			unset( $this->scripts[$key] );
			return true;
		}
		return false; 
	}

	public function addStyle( $key, $url, $deps=array(),$ver=false,$media='all'){
		$this->styles[$key] = array($url,$deps,$ver,$media);
	}

	public function removeStyle( $key ){
		if( isset($this->styles[$key]) ){
			unset( $this->styles[$key] );
			return true;
		}
		return false; 
	}
	
	/**
	 *
	 */
	public function getThemeSupport( $support ){
		return isset($this->themesSupports[$support])?$this->themesSupports[$support]:null;
	}

	public function init(){
		$this->initAdminActions();
		$this->initFrontEndActions();
		$this->initWidgets();
		$this->initShortcodes();
		$this->initPostType();

		// Setup Megamenu
		WPO_MegamenuEditor::getInstance()->init();
	}

	public function initScript(){
		foreach( $this->scripts as $key => $file ) {
			wp_register_script( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_script( $key );
		}
	}


	/**
	 * Initial Admin Actions
	 */
	public function initAdminActions(){
		if( is_admin() ){
			$admin =  new WPO_AdminTheme($this->themeName);
			$admin->init();
		}
	}

	/**
	 * Initial FrontEnd Actions
	 */
	public function initFrontEndActions(){
		add_action('wp_enqueue_scripts',array($this,'registerHead'),1);
		add_action('wp_enqueue_scripts', array( $this, 'initScripts' ) );

		add_action('wp_head',array($this,'setPostViews'));
		add_action('wp_head',array($this,'registerGoogleAnalytics'));
		add_action('wp_head',array($this,'initAjaxUrl'),15);
		add_action('wp_head',array($this,'initCustomCode'),99);
		add_action('wp_head',array($this,'checkHTML5'),100);

		add_action('init', array($this,'addVimeoOembedCorrectly'));
		
		add_action('after_setup_theme',array($this,'initSetup'));

		add_action('widgets_init', array($this,'initSidebars'));

		add_action('tgmpa_register',array($this,'initRequiredPlugin') );
		
		add_shortcode('gallery', '__return_false');

		add_filter('pre_get_posts',array($this,'searchFilter'));
		add_filter('widget_text', 'do_shortcode');
		add_filter( 'post_thumbnail_html', array($this,'removeThumbnailDimensions'), 10, 3 );
		
		// Fix Youtube Modal
		add_filter( 'oembed_result', array($this,'fixOembebYoutube') );
	}

	// Fix Youtube Modal
	public function fixOembebYoutube( $url )
	{
		$array = array (
	        'webkitallowfullscreen'     => '',
	        'mozallowfullscreen'        => '',
	        'frameborder="0"'			=> '',
	        '</iframe>)'        => '</iframe>'
	    );
	    $url = strtr( $url, $array );

	    if ( strpos( $url, "<embed src=" ) !== false ){
	        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
	    }
	    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
	        return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $url );
	    }
	    else{
	        return $url;
	    }
	}

	//Fix Vimeo embed
	public function addVimeoOembedCorrectly() {
	    wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );
	}

	// page Configuration
	public function getPageConfig(){
		global $wp_query;
		$pageconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);
		$defaults = array(  'page_layout' => '0-1-0',
                            'right_sidebar' => '' ,
                            'left_sidebar' => '',
                            'showtitle'=>true,
                            'advanced'=>'',
                            'breadcrumb'=>true
                            );
		$pageconfig = wp_parse_args((array) $pageconfig, $defaults);
		$config = array();
		if($pageconfig==''){
			$lt = '0-1-0';
		}else{
			$lt = (!empty($pageconfig['page_layout']) || $pageconfig['page_layout']!= '')?$pageconfig['page_layout']:'0-1-0';
			$config['breadcrumb']=$pageconfig['breadcrumb'];
			$config['right-sidebar']['widget']=$pageconfig['right_sidebar'];
			$config['left-sidebar']['widget']=$pageconfig['left_sidebar'];
			$config['showtitle']= $pageconfig['showtitle'];
			$config = $this->configLayout($lt,$config);
			$config['advanced'] = get_post_meta($wp_query->get_queried_object_id(), 'wpo_template', TRUE);
		}
		$maincontent = array();
		//
		if(is_front_page()) {
			$config['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
		} else {
			$config['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		return $config;
	}



	/**
	 * Initial Search Filter
	 */
	public function searchFilter($query) {
	    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
	        $query->is_search = true;
	        $query->is_home = false;
	    }
		return $query;
	}

	public function removeThumbnailDimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}

	/**
	 * Initial Most Popular
	 */
	public function setPostViews() {
	    global $post;

	    if('post' == get_post_type() && is_single()) {
	        $postID = $post->ID;
	        if(!empty($postID)) {
	            $count_key = 'wpo_post_views_count';
	            $count = get_post_meta($postID, $count_key, true);
	            if($count == '') {
	                $count = 0;
	                delete_post_meta($postID, $count_key);
	                add_post_meta($postID, $count_key, '0');
	            } else {
	                $count++;
	                update_post_meta($postID, $count_key, $count);
	            }
	        }
	    }
	}

	/**
	 * Initial Custom Code
	 */
	public function initCustomCode(){
		if(function_exists('of_get_option')){
			$str = $this->renderCode(of_get_option('snippet-close-body',''),of_get_option('snippet-js-body',''));
			echo $str;
		}
	}

	private function renderCode($css,$js){
		$str ='';
		if($css!=''){
			$str.='
			<style type="text/css">
				'.$css.'
			</style>';
		}
		if($js!=''){
			$str.='
			<script type="text/javascript">
				'.$js.';
			</script>
			';
		}
		$str = htmlspecialchars_decode($str);
		return $str;
	}

	/**
	 * Initial Sidebars
	 */
	public function initSetup(){
		
		$this->initThemeSupport();
		$this->initRegisterMenu();
		$this->initImageSize();
		$this->setPostThumbnailSize();
	}

	/**
	 * Initial Shortcode Actions
	 */
	public function initShortcodes(){
		$shortcodes = glob( WPO_FRAMEWORK_SHORTCODE.'*.php' );
		foreach($shortcodes as $sc){
			require_once($sc);
		}
	}

	

	/**
	 * Initial Widgets Actions
	 */
	public function initWidgets( ){
		foreach( $this->widgets as $wg ){
			$wg = WPO_FRAMEWORK_WIDGETS.$wg.'/'.$wg.'.php';
			if( is_file($wg) ){
				require_once($wg);
			}
		}
	}

	/**
	 * Initial Post type Actions
	 */
	public function initPostType(){
		foreach( $this->posttype as $pt ){
			$pt = WPO_FRAMEWORK_POSTTYPE.$pt.'.php';
			if( is_file($pt) ){
				require_once($pt);
			}
		}
	}

	/**
	 * Initial FrontEnd Actions
	 */
	public function initRequiredPlugin(){  
		if(count($this->requiredPlugins)>0){
			tgmpa( $this->requiredPlugins  );
		}
	}


	/**
	 * Initial Sidebars
	 */
	public function initSidebars(){
		foreach ($this->sidebars as $key => $sidebar) {
			register_sidebar($sidebar);
		}
	}

	public function initImageSize(){
		foreach ($this->imagesSize as $key => $image) {
			add_image_size($key,$image['width'],$image['height'],$image['crop']);
		}
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

		wp_enqueue_script( 'base_wpo_plugin_js',WPO_FRAMEWORK_STYLE_URI.'js/wpo-plugin.js',array(),false,true);
		wp_enqueue_script( 'base_wpo_megamenu_js',WPO_FRAMEWORK_STYLE_URI.'js/megamenu.js',array(),false,true);
		wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
		// Add default CSS */
		if(function_exists('of_get_option')){
			for($i=1;$i<=3;$i++){
				$google_font = trim(of_get_option('google-font'.$i,''));
				if($google_font!=''){
					wp_enqueue_style('base_google_font'.$i,$google_font);
				}
			}
		}


		$currentSkin = str_replace( '.css','',of_get_option('skin','default') ); 
		// Check RTL
		if( is_rtl() ){
			if( file_exists(WPO_THEME_CSS_DIR.'skins/'.$currentSkin.'/bootstrap-rtl.css') ){
				wp_enqueue_style( 'bootstrap-rtl-'.$currentSkin, WPO_THEME_URI.'/css/skins/'.$currentSkin.'/bootstrap-rtl.css' );
			}else {
				wp_enqueue_style( 'bootstrap-rtl-default',WPO_THEME_URI.'/css/bootstrap-rtl.css' );
			}
		}else{
			if( file_exists(WPO_THEME_CSS_DIR.'skins/'.$currentSkin.'/bootstrap.css') ){
				wp_enqueue_style( 'bootstrap-'.$currentSkin, WPO_THEME_URI.'/css/skins/'.$currentSkin.'/bootstrap.css' );
			}else {
				wp_enqueue_style( 'bootstrap-default', WPO_THEME_URI.'/css/bootstrap.css' );
			}
		}

		if( $currentSkin == 'template' || empty($currentSkin) || $currentSkin == 'default' ){
			wp_enqueue_style( 'template-default',WPO_THEME_URI.'/css/template.css' );
		}else {
			wp_enqueue_style('template-'.$currentSkin,WPO_THEME_URI.'/css/skins/'.$currentSkin.'/template.css' );
		}

		wp_enqueue_style( 'base-animation',WPO_FRAMEWORK_STYLE_URI.'css/animation.css' );
		wp_enqueue_style( 'base-fonticon',WPO_THEME_URI.'/css/font-awesome.min.css' );

		/* add styles files */
		foreach( $this->styles as $key => $file ) {
			wp_register_style( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_style( $key );
		}
		if( is_rtl() ){
			wp_enqueue_style('base-style-rtl',WPO_THEME_URI.'/css/rtl/template.css');
		}
		if( of_get_option('customize-theme','')!='' ){
			wp_enqueue_style('customize-style',WPO_FRAMEWORK_CUSTOMZIME_STYLE_URI.of_get_option('customize-theme').'.css');
		}
	}

	/**
	 * Initial Ajax Url
	 */
	public function initAjaxUrl() {
	?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
		<?php
	}

	/**
	 * Initial Theme Support
	 */
	private function initThemeSupport(){
		add_theme_support( 'automatic-feed-links' );
		foreach ($this->themesSupports as $key => $value) {
			if($value!=null){
				add_theme_support($key,$value);
			}
			else{
				add_theme_support($key);
			}
		}
	}

	/**
	 * Initial Register Menu
	 */
	public function initRegisterMenu(){
		//register_nav_menu('wpo_megamenu','Megamenu');
		foreach ($this->menus as $key => $menu) {
			register_nav_menu( $key, $menu );
		}
	}

	/**
	 *
	 */
	public function registerHead(){
		global $wp_query;
		$seo_fields = get_post_meta($wp_query->get_queried_object_id(),'wpo_seo',true);
		if($seo_fields==""){
			$seo_fields = array('title'=>'','keywords'=>'','description'=>'');
		}
		if(isset($seo_fields['title']) && trim($seo_fields['title'])!="" && of_get_option('is-seo',true) ){
			$seo_fields['title']= get_bloginfo('name').' | '.$seo_fields['title'];
		}else{
			$seo_fields['title']= get_bloginfo('name').(is_front_page() ? ((get_bloginfo('description')!="")?' | '.get_bloginfo('description'):'') :'');
		}
		if(!isset($seo_fields['keywords']) && trim($seo_fields['keywords'])==""){
			if(function_exists('of_get_option')){
				$seo_fields['keywords']= of_get_option('seo-keywords','');
			}else{
				$seo_fields['keywords']= '';
			}
		}
		if(!isset($seo_fields['description']) && trim($seo_fields['description'])==""){
			if(function_exists('of_get_option')){
				$seo_fields['description']= of_get_option('seo-description','');
			}else{
				$seo_fields['description']= '';
			}
		}
		$output='
<meta charset="'.get_bloginfo( 'charset' ).'">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
if(of_get_option('is-seo',true)){
$output.='<!-- For SEO -->
<meta name="description" content="'.$seo_fields['description'].'">
<meta name="keywords" content="'.$seo_fields['keywords'].'">
<!-- End SEO--> ';
}
$output.='<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'">';

		echo $output;
	}

	public function checkHTML5(){
		?>
<!--[if lt IE 9]>
    <script src="<?php echo WPO_FRAMEWORK_STYLE_URI; ?>js/html5.js"></script>
    <script src="<?php echo WPO_FRAMEWORK_STYLE_URI; ?>js/respond.js"></script>
<![endif]-->
		<?php
	}

	/**
	 *
	 */
	public function registerGoogleAnalytics(){
		$output='';
		$google_analytics='';
		if(function_exists('of_get_option')){
			$google_analytics = of_get_option('google-analytics','');
		}
		if($google_analytics!=''){
			$output.='
				<script type="text/javascript">
				    var _gaq = _gaq || [];
				    _gaq.push([\'_setAccount\', \''.$google_analytics.'\']);
				    _gaq.push([\'_trackPageview\']);

				    (function() {
				        var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
				        ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
				        var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
				    })();
				</script>
			';
		}
		echo $output;
	}
	
}
}
?>