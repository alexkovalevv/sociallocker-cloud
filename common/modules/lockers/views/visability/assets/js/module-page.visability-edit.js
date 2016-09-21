(function($){
	$(function(){
		var el = $('.control-way-lock').find('.wt-switch');

		checkWayLock();

		el.change(function() {
			checkWayLock();
		});

		function checkWayLock() {
			var waylock = el.find('input[type="radio"]:checked').val();

			var selector = $('#editconditions-lock_selector'),
				buffer = selector.val();

			if( waylock == 'css' ) {
				selector.val('');
				return;
			}

			selector.val(buffer);
		}
	});
})(jQuery);
