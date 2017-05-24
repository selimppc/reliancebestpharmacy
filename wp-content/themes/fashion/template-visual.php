<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
  * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/support/forum.html
  */

/*
*Template Name: Visual Composer
*
*/

$config = $wpo->getPageConfig();

get_header( get_header_layout() );

if($config['breadcrumb']){ ?>
    <?php wpo_breadcrumb(); ?>
<?php } ?>
<section id="wpo-mainbody" class=" wpo-mainbody">

        <!-- MAIN CONTENT -->
        <div id="wpo-content" class="wpo-content">
            <?php if($config['showtitle']){ ?>
            <h1 class="page-title"><span><?php the_title(); ?></span></h1>
            <?php } ?>
            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                    <?php the_content(); ?>
                </article><!-- #post -->
                <?php //comments_template(); ?>
            <?php endwhile; ?>
        </div>

</section>
<?php get_footer(); ?>