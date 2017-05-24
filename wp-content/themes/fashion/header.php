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

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<!-- OFF-CANVAS MENU SIDEBAR -->
<div id="wpo-off-canvas" class="wpo-off-canvas">
    <div class="wpo-off-canvas-body">
        <div class="wpo-off-canvas-header">
            <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <nav  class="navbar navbar-offcanvas navbar-static" role="navigation">
            <?php
            $args = array(  'theme_location' => 'mainmenu',
                'container_class' => 'navbar-collapse',
                'menu_class' => 'wpo-menu-top nav navbar-nav',
                'fallback_cb' => '',
                'menu_id' => 'main-menu-offcanvas',
                'walker' => new Wpo_Megamenu_Offcanvas()
            );
            wp_nav_menu($args);
            ?>
        </nav>
    </div>
</div>
<!-- //OFF-CANVAS MENU SIDEBAR -->
<?php global $fashion_option; ?>
<!-- START Wrapper -->
<div class="wpo-wrapper">
    <header id="header">
        <section id="topbar">
            <?php echo $fashion_option['topbar']; ?>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="pull-left customer-links">
                            <?php if(WPO_WOOCOMMERCE_ACTIVED){ ?>
                                    <?php if ( is_user_logged_in() ) { ?>
                                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','fashion'); ?>"><?php _e('My Account','fashion'); ?></a>
                                    <?php }
                                    else { ?>
                                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','fashion'); ?>"><?php _e('Login / Register','fashion'); ?></a>
                                    <?php } ?> 
                            <?php }else{ ?>
                                 <?php if( !is_user_logged_in() ){ ?>
                                    <a href="<?php echo home_url('/wp-login.php') ?>"><?php echo __('Login', 'fashion'); ?></a> <?php echo __('or', 'fashion'); ?> <a href="<?php echo home_url('/wp-login.php?action=register'); ?>"><?php echo __('Register', 'fashion'); ?></a>
                                <?php }else{ ?>
                                    <?php $current_user = wp_get_current_user(); ?>
                                    <?php echo __('Welcome', 'fashion'); ?> <?php echo $current_user->display_name; ?> !
                                <?php } ?>
                            <?php } ?>
                            </div> 

							<div class="pull-left">
							<?php 
								// WPML - Custom Languages Menu
								if( function_exists( 'icl_get_languages' ) ){
									$languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
									if( is_array( $languages ) ){
										
										foreach( $languages as $lang_k=>$lang ){
											if( $lang['active'] ){
												$active_lang = $lang;
												unset( $languages[$lang_k] );
											}
										}
			
										// disabled
										if( count( $languages ) ){
											$lang_status = 'enabled';
										} else {
											$lang_status = 'disabled';
										}
										
										echo '<div class="select-wrapper language btn-group pull-right '. esc_attr( $lang_status ).'">';
										
												echo '<a href="#" class="btn btn-link btn-switcher dropdown-toggle" data-toggle="dropdown"><img src="'. esc_url( $active_lang['country_flag_url'] ) .'" alt="'. esc_attr( $active_lang['translated_name'] ) .'"/><span>&nbsp;&nbsp;</span>';
												echo esc_attr( $active_lang['translated_name'] );
												if( count( $languages ) ) echo '<span class="caret"></span>';
												echo '</a>';
											
											if( count( $languages ) ){
												echo '<ul class="wpml-lang-dropdown dropdown-menu list">';
													foreach( $languages as $lang ){
														echo '<li><a href="'. esc_url( $lang['url'] ) .'"><img src="'. esc_url( $lang['country_flag_url'] ).'" alt="'. esc_attr( $lang['translated_name'] ).'"/><span>&nbsp;&nbsp;</span>'. esc_attr( $lang['translated_name'] ).'</a></li>';
													}
												echo '</ul>';
											}
											
										echo '</div>';
									}
								}
							?>
							 <!--language-->
                            <?php if( of_get_option('enable_language', true) ) : ?>             
								<div class="select-wrapper language btn-group pull-right">                  
									<a href="#" class="btn btn-link btn-switcher dropdown-toggle" data-toggle="dropdown"><?php _e('Language', 'fashion'); ?><span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#"><span class="img flag1"></span>English</a></li>
										<li><a href="#"><span class="img flag2"></span>Arabic</a></li>                                                                 
									</ul>
								</div>
                            <?php endif; ?>  
							</div>

                           
							
		
							
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="pull-right header-right">
                                <?php wpo_cartdropdown(); ?>
                            </div>
                            <div class="hidden-sm hidden-xs search-form pull-right"><?php get_search_form(); ?></div>     
                           
                            
                            


                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="header-main">
            <div class="container">
                <div class="row header-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inner">
                        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>           
                    </div>
                </div>
            </div>
        </section>

        <section id="wpo-mainnav">
            <?php echo $fashion_option['mainmenu']; ?>
                    <div class="navbar navbar-inverse"> 
                        <nav class="wpo-megamenu" role="navigation"> 
                                <div class="navbar-header pull-left visible-xs visible-sm">
                                    <?php wpo_renderButtonToggle(); ?>    
                                </div><!-- //END #navbar-header -->
                                <div class="visible-xs visible-sm search-mobile">
                                    <?php get_search_form(); ?>
                                </div>
                                <?php
                                $args = array(  'theme_location' => 'mainmenu',
                                                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
                                                'menu_class' => 'nav navbar-nav megamenu',
                                                'fallback_cb' => '',
                                                'menu_id' => 'main-menu',
                                                'walker' => new Wpo_Megamenu());
                                wp_nav_menu($args);
                            ?> 
                        </nav>
                    </div>
                </div>
            </div>      
        </section>

    </header>



