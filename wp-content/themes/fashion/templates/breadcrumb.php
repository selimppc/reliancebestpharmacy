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
global $post;
?>
<div id="breadcrumbs">
    <div class="container">        
        <?php
        if(in_array("search-no-results",get_body_class())){ ?>
           <div class="breadcrumb" class="col-sm-12">
           <a href="<?php get_template_directory_uri().'/'; ?>"><?php echo __('Home', 'fashion'); ?></a>
           <span class="delimiter">/</span>
           <span class="current"><?php echo __('Search results for', 'fashion'); ?> "<?php echo get_search_query(); ?>"</span> </div>
        <?php
            }else{
            	$delimiter = '<span class="delimiter">/</span>';
		        $home = esc_html__('Home', 'fashion');
		        $before = '<span class="current">';
		        $after = '</span> ';
		        echo '<div id="breadcrumb" class="breadcrumb">';
		        global $post;
		        global $wp_query;
		        $homeLink = esc_url( home_url() );
		        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
		        if ( is_category() ) {
			        global $wp_query;
			        $cat_obj = $wp_query->get_queried_object();
			        $thisCat = $cat_obj->term_id;
			        $thisCat = get_category($thisCat);
			        $parentCat = get_category($thisCat->parent);
			        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			        echo $before . '' . single_cat_title('', false) . '' . $after;
		        } elseif ( is_day() ) {
			        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			        echo $before . esc_html__('Archive by date "', 'fashion') . get_the_time('d') . '"' . $after;
		        } elseif ( is_month() ) {
			        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			        echo $before . esc_html__('Archive by month "', 'fashion') . get_the_time('F') . '"' . $after;
		        } elseif ( is_year() ) {
		        	echo $before . esc_html__('Archive by year "', 'fashion') . get_the_time('Y') . '"' . $after;
		        } elseif ( is_single() && !is_attachment() ) {
			        if ( get_post_type() != 'post' ) {
				        $post_type = get_post_type_object(get_post_type());
				        $slug = $post_type->rewrite;
				        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . ' ';
				        echo $before . get_the_title() . $after;
			        } else {
				        $cat = get_the_category(); $cat = $cat[0];
				        echo ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
				        echo $before . '' . get_the_title() . '' . $after;
			        }
		        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			        $post_type = get_post_type_object(get_post_type());
			        echo $before . $post_type->labels->singular_name . $after;
		        } elseif ( is_attachment() ) {
			        $parent_id  = $post->post_parent;
			        $breadcrumbs = array();
			        while ($parent_id) {
				        $page = get_page($parent_id);
				        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				        $parent_id    = $page->post_parent;
			        }
			        $breadcrumbs = array_reverse($breadcrumbs);
			        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
			        echo $before . '' . get_the_title() . '' . $after;
		        } elseif ( is_page() && !$post->post_parent ) {
		        	echo $before . '' . get_the_title() . '' . $after;
		        } elseif ( is_page() && $post->post_parent ) {
			        $parent_id  = $post->post_parent;
			        $breadcrumbs = array();
			        while ($parent_id) {
				        $page = get_page($parent_id);
				        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				        $parent_id    = $page->post_parent;
			        }
			        $breadcrumbs = array_reverse($breadcrumbs);
			        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
		        	echo $before . '' . get_the_title() . '"' . $after;
		        } elseif ( is_search()) {
		            echo $before . esc_html__( 'Search results for "', 'fashion') . get_search_query() . '"' . $after;
		        } elseif ( is_tag() ) {
		        	echo $before . esc_html__( 'Archive by tag "', 'fashion') . single_tag_title('', false) . '"' . $after;
		        } elseif ( is_author() ) {
		        global $author;
		        $userdata = get_userdata($author);
		        	echo $before . esc_html__( 'Articles posted by "', 'fashion') . $userdata->display_name . '"' . $after;
		        } elseif ( is_404() ) {
		        	echo $before . esc_html__('You got it Error 404 not Found', 'fashion') . '"&nbsp;' . $after;
		        }
		        if ( get_query_var('paged') ) {
			        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' ';
			        //echo ('Page') . ' ' . get_query_var('paged');
			        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
		        }
		        echo '</div>';
            }
        ?>
        </div>
</div>