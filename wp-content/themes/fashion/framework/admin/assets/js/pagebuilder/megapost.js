!function($) {
	$('.layout_images img').click(function(){
		$this = $(this);
		if(!$this.hasClass('active')){
			$('.layout_images img').removeClass('active');
			$this.addClass('active');
			$this.parent().next().val($this.data('layout'));
		}
	});
	$layout = $('.layout_image_field').val();
	if($layout!=""){
		$('.layout_images img').removeClass('active');
		$('.layout_images img[data-layout="'+$layout+'"]').addClass('active');
	}
}(window.jQuery);