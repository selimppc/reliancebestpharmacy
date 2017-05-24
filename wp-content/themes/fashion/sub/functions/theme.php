<?php

function fashion_fnc_import_remote_demos() { 
  return array(
    'fashion' => array( 'name' => 'fashion',  'source'=> 'http://wpsampledemo.com/fashion/fashion.zip' ),
  );
}

add_filter( 'pbrthemer_import_remote_demos', 'fashion_fnc_import_remote_demos' );



function fashion_fnc_import_theme() {
  return 'fashion';
}
add_filter( 'fashion_import_theme', 'fashion_fnc_import_theme' );

function fashion_fnc_import_demos() {
  $folderes = glob( get_template_directory().'/inc/import/*', GLOB_ONLYDIR ); 

  $output = array(); 

  foreach( $folderes as $folder ){
    $output[basename( $folder )] = basename( $folder );
  }
  
  return $output;
}
add_filter( 'pbrthemer_import_demos', 'fashion_fnc_import_demos' );

function fashion_fnc_import_types() {
  return array(
      'all' => 'All',
      'content' => 'Content',
      'widgets' => 'Widgets',
      'page_options' => 'Theme + Page Options',
      'menus' => 'Menus',
      'rev_slider' => 'Revolution Slider',
      'vc_templates' => 'VC Templates'
    );
}
add_filter( 'pbrthemer_import_types', 'fashion_fnc_import_types' );



/**
 * Matching and resizing images with url.
 *
 *  $ouput = array(
 *        'allowed' => 1, // allow resize images via using GD Lib php to generate image
 *        'height'  => 900,
 *        'width'   => 800,
 *        'file_name' => 'blog_demo.jpg'
 *   ); 
 */
function fashion_import_attachment_image_size( $url ){  

   $name = basename( $url );   
 
   $ouput = array(
         'allowed' => 0
   );     
   
   if( preg_match("#product#", $name) ) {
      $ouput = array(
         'allowed' => 1,
         'height'  => 1000,
         'width'   => 823,
         'file_name' => 'product_demo.jpg'
      ); 
   }
   elseif( preg_match("#blog#", $name) || preg_match("#news-#", $name) || preg_match("#612YntpjodL#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 780,
         'width'   => 1170,
         'file_name' => 'blog_demo.jpg'
      ); 
   }
   elseif( preg_match("#portfolio#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 800,
         'width'   => 1170,
         'file_name' => 'portfolio_demo.png'
      ); 
   }
   elseif( preg_match("#team#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 680,
         'width'   => 570,
         'file_name' => 'team_demo.jpg'
      ); 
   }

   elseif( preg_match("#slider-#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 680,
         'width'   => 1224,
         'file_name' => 'slider_demo.jpg'
      ); 
   }

   elseif( preg_match("#testimonial#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 900,
         'width'   => 900,
         'file_name' => 'testimonial_demo.jpg'
      ); 
   }

   return $ouput;
}

//add_filter( 'pbrthemer_import_attachment_image_size', 'adela_import_attachment_image_size' , 1 , 999 );



///// Define  list of function processing theme logics.
function wpo_vc_shortcode_render( $atts, $m='' , $tag='' ){
	$output = ''; 
	if(is_file( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER. $tag.'.php')){
		ob_start();
		require( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER.$tag.'.php' );
		$output .= ob_get_clean();
	}
	return $output;
}
/// // 
if(of_get_option('is-effect-scroll','1')=='1'){
    add_filter('body_class', 'wpo_animate_scroll');
    function wpo_animate_scroll($classes){
    $classes[] = 'wpo-animate-scroll';
        return $classes;
    }
}


if(!function_exists('wpo_cartdropdown')){
 function wpo_cartdropdown(){
	if(WPO_WOOCOMMERCE_ACTIVED){
		global $woocommerce; 
		?>
		<div id="cart">
		         <span class=" fa fa-shopping-cart pull-left"></span>
		         <div class="media-body heading">
		             <a class="cart-link dropdown-toggle" data-toggle="dropdown" >
		                 <span class="cart-title hidden-xs">CART:</span> <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'fashion'), $woocommerce->cart->cart_contents_count); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
		             </a>
		             <div class="content dropdown-menu">
		                 <?php woocommerce_mini_cart(); ?>
		             </div>
		         </div>
		     </div>
		<?php
		}
	}
}

function get_header_layout(){
    global $wp_query;
    $layout = get_post_meta($wp_query->get_queried_object_id(),'wpo_template',true);
    $layout = wp_parse_args( $layout, array(
        'header_skin'   => 'global'
    ) );
    switch ($layout['header_skin']) {
        case 'global':
            return of_get_option('header','');
        case 'default':
            return '';
        case 'style2':
            return 'style2';
    }
}


function wpo_single_addthis_share(){
?>
	<div class="addthis">
	     <!-- AddThis Button BEGIN -->
	     <div class="addthis_toolbox addthis_default_style">
	         <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	         <a class="addthis_button_tweet"></a>
	         <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
	         <a class="addthis_counter addthis_pill_style"></a>
	     </div>
	     <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-533e342d186e8c37"></script>
	     <!-- AddThis Button END -->
	 </div>
<?php
}
add_action('woocommerce_single_product_summary','wpo_single_addthis_share',45);



function wpo_renderButton_switch_layout(){
 global $wp_query;
 $stringquery = base64_encode(json_encode($wp_query->query_vars)) ;
    if (isset($_COOKIE['wpo_cookie_layout']) && $_COOKIE['wpo_cookie_layout']=='list') {
        $layout = 'list';
    }else{
        $layout = 'grid';
    }
?>
 <div class="display">
        <span class="pull-left"><?php echo __('View', 'fashion'); ?></span>
     <a class="list<?php echo (($layout=='list')?' active':''); ?>" style="position:relative;" data-query='<?php echo $stringquery; ?>' data-type="list" href="#">
      <span class="text-hide"><?php echo __('List', 'fashion'); ?></span>
     </a>
     <a class="grid<?php echo (($layout=='grid')?' active':''); ?>" style="position:relative;" data-query='<?php echo $stringquery; ?>' data-type="grid" href="#">
   <span class="text-hide"><?php echo __('Grid', 'fashion'); ?></span>
  </a>
    </div>
<?php
}
remove_action( 'wpo_button_display',array('WPO_Woocommerce','renderButton'),20 );
add_action( 'wpo_button_display','wpo_renderButton_switch_layout',20 );

// Ajax Newletter
add_action( 'wp_ajax_wpo_newsletter', 'wpo_ajax_newsletter' );
add_action( 'wp_ajax_nopriv_wpo_newsletter', 'wpo_ajax_newsletter' );

function wpo_ajax_newsletter(){
	$position = $_POST['position'];
	// echo $position;
	// die;
	setcookie('wpo_cookie_newsletter', $position , time()+3600*24*100,'/');
	echo $_COOKIE['wpo_cookie_newsletter'];
	exit();
}

function wpo_show_hide_newsletter(){
	$check = (isset($_COOKIE['wpo_cookie_newsletter'])) ? $_COOKIE['wpo_cookie_newsletter'] : 'show';
?>
	<div class="button-group">
        <div class="close">
            <i class="fa fa-angle-left"></i>
            <div id="newsletter-action" class="show-button" data-position="<?php echo $check; ?>">
            	<label class="checkbox-inline">
					<input type="radio" name="action" value="show" <?php checked( $check,'show' ); ?>><?php echo __('Always show', 'fashion'); ?>
				</label>
                <label class="checkbox-inline">
					<input type="radio" name="action" value="hide" <?php checked( $check, 'hide' ); ?>><?php echo __('Keep footer', 'fashion'); ?>
				</label>
            </div>
        </div>
    </div>
<?php
}

function wpo_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'fashion' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'wpo_wp_title', 10, 2 );








