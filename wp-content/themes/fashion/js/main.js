(function($){

	var _menu_action = $('#wpo-mainnav').offset().top;
	var _is_menu_action = $('#wpo-mainnav').hasClass('no-fixed');
	var _enable_menu_fixed = $('body').hasClass('main-menu-fixed');

	var WPO_CartDropDown = function(){
		"use strict";
		jQuery('#cart a.cart-link').toggle(function() {
			jQuery(this).next().show(300);
		}, function() {
			jQuery(this).next().hide(300);
		});
		
	}

	var WPO_Newsletter = function(){
		"use strict";
		var $item = $('.footer-newsletter');
		var $copy = $('.wpo-copyright');
		var $action = $('#newsletter-action');
		if($item.length>0){
			WPO_switch_Newsletter($action.data('position'));
			
			$action.find('input[type="radio"]').on('change', function() {
				var $position = $(this).val();
				console.log($position);
				WPO_AjaxSetPosition_Newsletter($position);
				WPO_switch_Newsletter($position);
			});
		}
	}

	var WPO_switch_Newsletter = function( position ){
		"use strict";
		var $item = $('.footer-newsletter');
		var $copy = $('.wpo-copyright');
		if(position=='show'){
			$item.addClass('open');
			$copy.addClass('newsletter-fix');
			$item.removeClass('bottom');
		}else{
			$item.removeClass('open');
			$copy.removeClass('newsletter-fix');
			$item.addClass('bottom');
		}
	}

	var WPO_AjaxSetPosition_Newsletter = function(value){
		"use strict";
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			// dataType: 'JSON',
			data: {
				position: value,
				action: 'wpo_newsletter'
			},
			success: function(response){
				//$('#newsletter-action').data('postion',response);	
			}
		});
	}

	var WPO_Menu_Fixed = function(){
		"use strict";
		if(_enable_menu_fixed){
			var $mainmenu =  $('#wpo-mainnav');
			if(!_is_menu_action){
				if( $(document).scrollTop() > _menu_action ){
					$mainmenu.addClass('menu_fixed');
				}else{
					$mainmenu.removeClass('menu_fixed');
				}
			}
		}
	}

	jQuery(document).ready(function() {
		if(jQuery().isotope){
			jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				jQuery('.isotope').isotope('reLayout');
			});
			jQuery('[id*="accordion-"]').on('shown.bs.collapse', function(e){
				jQuery('.isotope').isotope('reLayout');
			});
		}
		
		WPO_CartDropDown();
		WPO_Newsletter();

		$('body').bind('showNoty', function(){
            var text_success = woocommerce_localize.cart_success;
            var n = noty({
                text        : '<div class="notification-alerts-cart"><i class="fa fa-shopping-cart"></i>&nbsp' + text_success + ' </div>',
                type        : 'success',
                dismissQueue: true,
                layout      : 'center',
                theme       : 'defaultTheme',
                timeout     : 2000,
            });
            console.log('html: ' + n.options.id);
	   });
	});
    jQuery(window).load(function(){

    });

    $(window).scroll(function(event) {
    	WPO_Menu_Fixed();
    });

})(jQuery);
