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

<?php get_header( get_header_layout() );?>
<?php wpo_breadcrumb(); ?>

<div id="wpo-mainbody" class="container wpo-mainbody">
	<div class="row">
		<!-- MAIN CONTENT -->
		<div id="wpo-content" class="wpo-content <?php echo $config['main']['class']; ?> clearfix">
			<?php  if ( have_posts() ) : ?>
                    <div class="wrapper large-padding post-area">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'templates/blog/blog'); ?>
                        <?php endwhile; ?>
                    </div>
                    <?php global $wp_query; ?>
                    <?php wpo_pagination($prev = '&laquo;', $next = '&raquo;'); ?>
            <?php else : ?>
                <?php get_template_part( 'templates/none' ); ?>
            <?php endif; ?>
		</div>
		<!-- //END MAINCONTENT -->

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

<?php get_footer(); ?>