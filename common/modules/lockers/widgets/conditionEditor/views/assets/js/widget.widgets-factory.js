(function($){
    /**
     * OnePress Widget Factory.
     * Supports:
     * - creating a jquery widget via the standart jquery way
     * - call of public methods.
     */
    $.widgetsFactory = function (pluginName, pluginObject) {
        var factory = {
            createWidget: function (element, options) {
                var widget = $.extend(true, {}, pluginObject);
                widget.element = $(element);
                widget.options = $.extend(true, widget.options, options);
                if (widget._init) widget._init();
                if (widget._create) widget._create();
                $.data(element, 'plugin_' + pluginName, widget);
            },
            callMethod: function (widget, methodName) {
                return widget[methodName] && widget[methodName]();
            }
        };
        $.fn[pluginName] = function () {
            var args = arguments;
            var argsCount = arguments.length;
            var toReturn = this;
            this.each(function () {
                var widget = $.data(this, 'plugin_' + pluginName);
                // a widget is not created yet
                if (!widget && argsCount <= 1) {
                    factory.createWidget(this, argsCount ? args[0] : false);
                    // a widget is created, the public method with no args is being called
                } else if (argsCount == 1) {
                    toReturn = factory.callMethod(widget, args[0]);
                }
            });
            return toReturn;
        };
    };
})(jQuery);