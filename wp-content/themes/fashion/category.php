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
$template = new WPO_Template();
$config = $template->configLayout(of_get_option('single-layout','0-1-0'));

?>
<?php get_header( get_header_layout() ); ?>

<?php //wpo_breadcrumb();
    wpo_breadcrumb();
?>
    <div class="wpo-main">
        <div id="wpo-mainbody" class="container category-blogs wpo-mainbody <?php echo $config['container']; ?>">
            <div class="row">
                <!-- MAIN CONTENT -->
                <div class="col-sm-12 cat-top clearfix">
                    <h1 class="name-cat">
                        <?php single_cat_title();?>
                    </h1><!--End.Name-Category-->

                </div><!--END.Title Category-->
                <div id="wpo-content" class="wpo-content <?php echo $config['main']['class']; ?>">
                    <?php  if ( have_posts() ) : ?>
                            <div class="cat-area">
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'templates/blog/blog'); ?>
                                <?php endwhile; ?>
                            </div>
                            <?php wpo_pagination($prev = '<i class="fa fa-long-arrow-left"></i> '.__('Prev', 'fashion'), $next = __('Next', 'fashion').' <i class="fa fa-long-arrow-right"></i>'); ?>
                    <?php else : ?>
                        <?php get_template_part( 'templates/none' ); ?>
                    <?php endif; ?>
                </div>
                <!-- //MAIN CONTENT -->
                <?php /******************************* SIDEBAR LEFT ************************************/ ?>
                <?php if($config['left-sidebar']['show']){ ?>
                    <div class="wpo-sidebar wpo-sidebar-1 <?php echo $config['left-sidebar']['class']; ?>">
                        <?php if(is_active_sidebar(of_get_option('left-sidebar'))): ?>
                            <div class="sidebar-inner">
                                <?php dynamic_sidebar(of_get_option('left-sidebar')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php /******************************* END SIDEBAR LEFT *********************************/ ?>

                <?php /******************************* SIDEBAR RIGHT ************************************/ ?>
                <?php if($config['right-sidebar']['show']){ ?>
                    <div class="wpo-sidebar wpo-sidebar-2 <?php echo $config['right-sidebar']['class']; ?>">
                        <?php if(is_active_sidebar(of_get_option('right-sidebar'))): ?>
                            <div class="sidebar-inner">
                                <?php dynamic_sidebar(of_get_option('right-sidebar')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php /******************************* END SIDEBAR RIGHT *********************************/ ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>