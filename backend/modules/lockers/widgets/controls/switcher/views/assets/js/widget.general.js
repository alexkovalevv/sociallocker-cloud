/**
 * Created by ПКПК on 01.08.2016.
 */

(function($){
    $(function(){
        $('.wt-switch').each(function() {
            if( $(this).data('events') ) {
                var self = $(this),
                    events = $(this).data('events');

                function trackControl() {
                    for (var selector in events) {
                        if( !events.hasOwnProperty(selector) )
                            continue;

                        for (var e in events[selector]) {
                            if( !events[selector].hasOwnProperty(e) )
                                continue;

                            if( self.find('input[type="radio"]:checked').val() == e ) {
                                if( events[selector][e] == 'hide' ) {
                                    $(selector).fadeOut();
                                } else if( events[selector][e] == 'show' ) {
                                    $(selector).fadeIn(200);
                                }
                            }
                        }
                    }
                }

                trackControl();

                $(this).find('input[type="radio"]').change(function() {
                    trackControl();
                });
            }
        });
    });
})(jQuery);
