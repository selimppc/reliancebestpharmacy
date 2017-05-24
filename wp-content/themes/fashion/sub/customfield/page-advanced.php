<?php
/* $Desc
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

    $object = new WPO_Template();

?>
<div id="wpo-portfolio">
    <p class="wpo_section ">
        <?php $mb->the_field('count'); ?>
        <label for="pf_number"><?php echo __('Pages show at most:', 'fashion'); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" id="pf_number" value="<?php $mb->the_value(); ?>" />
    </p>
    <p class="wpo_section ">
        <?php $mb->the_field('layout_page'); ?>
        <label for="pf_number"><?php echo __('Layout Skin:', 'fashion'); ?></label>
        <select  name="<?php $mb->the_name(); ?>">
	    	<option value="" <?php $mb->the_select_state(''); ?>><?php echo __('Use Global', 'fashion'); ?></option>
	    	<option value="box" <?php $mb->the_select_state('box'); ?>><?php echo __('Box', 'fashion'); ?></option>
	    	<option value="full" <?php $mb->the_select_state('full'); ?>><?php echo __('Full', 'fashion'); ?></option>
	    </select>
    </p>
    <p class="wpo_section ">
        <?php $mb->the_field('header_skin'); ?>
        <label for="pf_number"><?php echo __('Header Skin:', 'fashion'); ?></label>
        <select  name="<?php $mb->the_name(); ?>">
            <option value="global" <?php $mb->the_select_state('1'); ?>><?php echo __('Use Global', 'fashion'); ?></option>
            <option value="default" <?php $mb->the_select_state('2'); ?>><?php echo __('Skin 1', 'fashion'); ?></option>
            <option value="style2" <?php $mb->the_select_state('3'); ?>><?php echo __('Skin 2', 'fashion'); ?></option>
        </select>
    </p>
</div>

