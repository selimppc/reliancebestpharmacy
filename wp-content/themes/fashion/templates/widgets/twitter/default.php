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
if( $title )
	echo $before_title . $title . $after_title;
?>
<div class="widget-twitter block">
	<div class="block_content">
		<div id="wpo-twitter<?php echo $twitter_id; ?>" class="wpo-twitter">
			<a class="twitter-timeline" data-dnt="true"   data-link-color="<?php echo $link_color; ?>" width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" data-chrome="<?php echo $chrome; ?>" data-border-color="<?php echo $border_color; ?>"  data-tweet-limit="<?php echo $limit; ?>" data-link-color="<?php echo $link_color; ?>"  data-show-replies="<?php echo $show_replies; ?>" href="https://twitter.com/<?php echo $user; ?>"  data-widget-id="<?php echo $twitter_id; ?>"  >Tweets by @<?php echo $user; ?></a>
			<?php echo $js; ?>
		</div>	
	</div>
</div>
<script type="text/javascript">
// Customize twitter feed
var hideTwitterAttempts = 0;
function hideTwitterBoxElements() {
 setTimeout( function() {
  if ( $('[id*=wpo-twitter<?php echo $user; ?>]').length ) {
   $('#wpo-twitter<?php echo $user; ?> iframe').each( function(){
    var ibody = $(this).contents().find( 'body' );
	var show_scroll = <?php echo $show_scrollbar; ?>; 
	var height =  <?php echo $height; ?>+'px'; 
    if ( ibody.find( '.timeline .stream .h-feed li.tweet' ).length ) {
		ibody.find( '.e-entry-title' ).css( 'color', '<?php echo $text_color; ?>' );
		ibody.find( '.header .p-nickname' ).css( 'color', '<?php echo $mail_color; ?>' );
		ibody.find( '.p-name' ).css( 'color', '<?php echo $name_color; ?>' );
		if(show_scroll == 1){
			ibody.find( '.timeline .stream' ).css( 'max-height', height );
			ibody.find( '.timeline .stream' ).css( 'overflow-y', 'auto' );	
			ibody.find( '.timeline .twitter-timeline' ).css( 'height', 'inherit !important' );	
		}
    } else {
     $(this).hide();
    }
   });
  }
  hideTwitterAttempts++;
  if ( hideTwitterAttempts < 3 ) {
   hideTwitterBoxElements();
  }
 }, 1500);
}
// somewhere in your code after html page load
hideTwitterBoxElements();
</script>

