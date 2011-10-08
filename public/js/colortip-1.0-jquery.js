(function($){
	$.fn.colorTip = function(settings){
		var defaultSettings = {
			color		: 'yellow',
			timeout		: 50
		}		
		var supportedColors = ['red','green','blue','white','yellow','black'];		
		settings = $.extend(defaultSettings,settings);
		return this.each(function(){
			var elem = $(this);
			if(!elem.attr('title')) return true;
			var scheduleEvent = new eventScheduler();
			var tip = new Tip(elem.attr('title'));
			elem.append(tip.generate()).addClass('colorTipContainer');
			var hasClass = false;
			for(var i=0;i<supportedColors.length;i++)
			{
				if(elem.hasClass(supportedColors[i])){
					hasClass = true;
					break;
				}
			}
			if(!hasClass){
				elem.addClass(settings.color);
			}
			elem.hover(function(){

				tip.show();
				scheduleEvent.clear();
			},function(){
				scheduleEvent.set(function(){
					tip.hide();
				},settings.timeout);

			});
			elem.removeAttr('title');
		});		
	}
	function eventScheduler(){}	
	eventScheduler.prototype = {
		set	: function (func,timeout){
			this.timer = setTimeout(func,timeout);
		},
		clear: function(){
			clearTimeout(this.timer);
		}
	}
	function Tip(txt){
		this.content = txt;
		this.shown = false;
	}
	Tip.prototype = {
		generate: function(){
			return this.tip || (this.tip = $('<span class="colorTip">'+this.content+
											 '<span class="pointyTipShadow"></span><span class="pointyTip"></span></span>'));
		},
		show: function(){
			if(this.shown) return;		
			this.tip.css('margin-left',-this.tip.outerWidth()/2).fadeIn('fast');
			this.shown = true;
		},
		hide: function(){
			this.tip.fadeOut();
			this.shown = false;
		}
	}
	
})(jQuery);
