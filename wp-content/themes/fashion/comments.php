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

if ( post_password_required() ){
    return;
}
?>
<div id="comments">
    <div class="title">
        <h4><?php comments_number( __('0 Comment', 'fashion'), __('1 Comment', 'fashion'), __('% Comments', 'fashion') ); ?></h4>
    </div>
    <?php if ( have_comments() ) { ?>
        <div class="wpo-commentlists">
    	    <ol class="commentlists">
    	        <?php wp_list_comments('callback=wpo_theme_comment'); ?>
    	    </ol>
    	    <?php
    	    	// Are there comments to navigate through?
    	    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    	    ?>
    	    <footer class="navigation comment-navigation" role="navigation">
    	        <div class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'fashion' ) ); ?></div>
    	        <div class="next right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'fashion' ) ); ?></div>
    	    </footer><!-- .comment-navigation -->
    	    <?php endif; // Check for comment navigation ?>

    	    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    	        <p class="no-comments"><?php _e( 'Comments are closed.' , 'fashion' ); ?></p>
    	    <?php endif; ?>
        </div>
    <?php } ?>

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> '<div class="title"><h4>'.__('Leave a Comment', 'fashion').'</h4></div>',
                        'comment_field' => '<div class="form-group">
                                                <label class="field-label" for="comment">'.__('Comment:', 'fashion').'</label>
                                                <textarea rows="8" id="comment" class="form-control"  name="comment"'.$aria_req.'></textarea>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
                    		array(
                                'author' => '<div class="form-group">
                                            <label for="author">'. __('Name:', 'fashion').'</label>
                                            <input type="text" name="author" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'email' => ' <div class="form-group">
                                            <label for="email">'.__('Email:', 'fashion').'</label>
                                            <input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'url' => '<div class="form-group">
                                            <label for="url">'.__('Website:', 'fashion').'</label>
                                            <input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                            </div>',
                            )),
                        'label_submit' => __('Post Comment', 'fashion'),
						'comment_notes_before' => '<p class="h-info">'.__('Your email address will not be published.', 'fashion').'</p>',
						'comment_notes_after' => '',
                        );
    ?>
	<?php global $post; ?>
	<?php if('open' == $post->comment_status){ ?>
	<div class="commentform row">
    	<div class="col-sm-12">
			<?php wpo_comment_form($comment_args); ?>
    	</div>
    </div><!-- end commentform -->
	<?php } ?>
</div><!-- end comments -->