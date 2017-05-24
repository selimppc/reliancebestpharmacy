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
global $fashion_option;
$footer = of_get_option('footer-style','default');
?>
	<footer id="wpo-footer" class="wpo-footer">

        <?php if($footer=='default'){ ?>

        <div class="wpo-footer-center">
			<div class="container">
                <div class="inner">
                    <div class="row container">
                        <div class="column col-xs-12 col-sm-6 col-lg-3 col-md-3">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-lg-2 col-md-2">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-lg-2 col-md-2">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-lg-2 col-md-2">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-lg-3 col-md-3">
                            <?php dynamic_sidebar('footer-5'); ?>
                        </div>
                    </div>
                </div>
			</div>
		</div>
        <?php }else{
            echo $fashion_option['footer'];
            echo do_shortcode( get_post( $footer )->post_content );
            echo '</div>';
        }
        ?>

		<section class="wpo-copyright">
			<?php echo $fashion_option['copyright']; ?>                    
    				<div class="col-sm-12">
                        <div class="copyright">
    						<?php echo of_get_option('copyright','Fashion &amp; Store &copy; POWERED BY <a href="http://themeforest.net/user/Opal_WP/?ref=dancof">OpalTheme</a> All Rights Reserved.'); ?>
    					</div>
    			    </div>
                </div>
			</div>
		</section>
        
        <?php if(of_get_option('footer-is-sticky',true)){ ?>
        <section class="footer-newsletter bottom hidden-xs">
            <?php wpo_show_hide_newsletter(); ?>
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar('footer-sticky'); ?>
                </div>
            </div>  
        </section>
        <?php } ?>
	</footer>
</div>
	<?php wp_footer(); ?>
</body>
</html>