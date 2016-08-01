/**
 * Created by Александр on 25.07.2016.
 */
(function($) {
  $(function() {
	  var widget = $('.wt-dropdown-select');
		  widget.each(function() {
			 var self = $(this);

			 if(self.data('item-hints') && self.data('item-hints')[self.val()]) {
				 self.closest('.form-group').find('.help-block')
					 .text(self.data('item-hints')[self.val()]);
			 }

			 if( self.hasClass('wt-dropdown-ajax') ) {
				 var ajaxUrl = self.data('ajax-url');

				 if( ajaxUrl ) {
					$.ajax({
						 url: ajaxUrl,
						 type: 'post',
						 dataType: 'json',
						 success: function(data, textStatus, jqXHR) {

							 if( !data ) return;

							 if( data.error ) {
								 console.log('[Error]:' + data.error);
								 return;
							 }

							 if( !data.items ) return;

							 self.html('');

							 var output = '',
								 selected,
								 value = self.data('value');

								 for( i in data.items ) {
									 selected = value && value == data.items[i]['value']
										 ? 'selected'
										 : '';

									 output += '<option value="' + data.items[i]['value'] + '"' + selected + '>' + data.items[i]['title'] + '</option>';
								 }

								 self.append(output);

								 self.selectpicker('refresh');
						 },
                         error: function(m) {
                            console.log(m);
                         }
					 });
				 }
			 }
		  });

		  widget.change(function(e) {
			  var el = $(e.target);
			  if(el.data('item-hints') && el.data('item-hints')[el.val()]) {
				  el.closest('.form-group').find('.help-block')
					  .text(el.data('item-hints')[el.val()]);
			  }
		  });
  });
})(jQuery);