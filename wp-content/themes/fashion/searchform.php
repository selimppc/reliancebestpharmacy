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

<div class="wpo_search pull-right">
    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
        <input type="text" name="s" placeholder="<?php echo __('Search...', 'fashion'); ?>" />
        <span class="button-search">
        	<input type="submit" value="&nbsp;">
         	<input type="hidden" name="post_type" value="product" />
         </span>
    </form>
</div>


