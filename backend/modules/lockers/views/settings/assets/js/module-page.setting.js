(function($){
	$(function(){
		var hash = window.location.hash;
		hash && $('ul.nav a[href="' + hash + '"]').tab('show');

		$('.nav-tabs a').click(function (e) {
			$(this).tab('show');
			var scrollmem = $('body').scrollTop() || $('html').scrollTop();
			window.location.hash = this.hash;
			$('html,body').scrollTop(scrollmem);
		});

		$('input[name="SubscribeSetting[subscription_to_service]').change(
			function() {
				var serviceName = $(this).val();

				$( '.fieldset-hidden' ).hide();
				$( '.' + serviceName + '-fieldset' ).fadeIn(300);
			}
		);
	});
})(jQuery);
