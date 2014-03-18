(function ($) {
	
	'use strict';
	
	$(document).ready(function(){
	
		$(document).veuseToggle({ speed: 300 });
		$(document).veuseAccordion({ speed: 300 });
		$(document).veuseVerticaltab({ speed: 300 });
		$(document).veuseHorisontaltab({ speed: 300 });
		
	});
	
	
	$.fn.veuseToggle = function(options) {
	
		var defaults = {
			speed: 2000
		}
			
		var options = $.extend({}, defaults,options);
		
		$('.veuse-toggle .veuse-toggle-title').toggle(function() {
			$(this).toggleClass('active').next(':hidden').slideDown(options.speed);
		}, function(){
			$(this).toggleClass('active').next(':visible').slideUp(options.speed);
		});
	
	}
	
	$.fn.veuseAccordion = function(options) {
	
		var defaults = {
			speed: 2000
		}
			
		var options = $.extend({}, defaults,options);
	
		var allToggles = $('.veuse-accordion > .veuse-toggle > .veuse-toggle-inner').hide();
		
		$('.veuse-accordion .veuse-toggle .veuse-toggle-title').click(function() {
			allToggles.slideUp(options.speed);
			$(this).toggleClass('active').next().stop().slideDown(options.speed);
			return false;
		});

	}
	
	
	$.fn.veuseHorisontaltab = function(options) {
		
		var defaults = {
			speed: 2000
		}
			
		var options = $.extend({}, defaults,options); 
				
		/* Show the first widget */
		
		$('.widget_veuse_tab_widget:first').show();
		
		/* Build tab navigation */
		
		var $tab = $('.widget_veuse_tab_widget:first');
		
		$('<ul class="tab-navigation"></ul>').insertBefore('.widget_veuse_tab_widget:first');
		
		var widgetCount = $('.widget_veuse_tab_widget').parent().find('.widget').length;
		var tabwidgetCount = $('.widget_veuse_tab_widget').parent().find('.widget_veuse_tab_widget').length;
		var tabcount = widgetCount - tabwidgetCount + 1;
		var tabContent;
		var count;
		
		$('.widget_veuse_tab_widget').each(function(){
			tabcount++;
			tabContent = $(this).find('.veuse-tab-title').html();
			$('.tab-navigation').append('<li data-number="' + tabcount + '">'+ tabContent+'</li>');
			$('ul.tab-navigation li:first').addClass('active');
		});
		
		$('.tab-navigation li').click(function() {
			count = $(this).attr('data-number');
			$('.tab-navigation li').removeClass('active');
			$(this).addClass('active');
			$('.widget_veuse_tab_widget').hide();
			$(this).parent().parent().find('.widget_veuse_tab_widget:nth-child(' + count + ')').fadeIn(options.speed);
			
		});
		
	};
	
	
	$.fn.veuseVerticaltab = function(optios) {
	
		var defaults = {
			speed: 2000
		}
			
		var options = $.extend({}, defaults,options); 
		
		/* Show the first widget */
		
		$('.widget_veuse_verticaltab_widget:first').show();
		
		/* Build tab navigation */
		
		var $tab = $('.widget_veuse_verticaltab_widget:first');
		
		$('<ul class="verticaltab-navigation"></ul>').insertBefore('.widget_veuse_verticaltab_widget:first');
		
		var widgetCount = $('.widget_veuse_verticaltab_widget').parent().find('.widget').length;
		var tabwidgetCount = $('.widget_veuse_verticaltab_widget').parent().find('.widget_veuse_verticaltab_widget').length;
		var tabcount = widgetCount - tabwidgetCount + 1;
		var tabContent;
		var count;
		
		$('.widget_veuse_verticaltab_widget').each(function(){
			tabcount++;
			tabContent = $(this).find('.veuse-verticaltab-title').html();
			$('.verticaltab-navigation').append('<li data-number="' + tabcount + '">'+ tabContent+'</li>');
			$('ul.verticaltab-navigation li:first').addClass('active');
		});
		
		$('.verticaltab-navigation li').click(function() {
			count = $(this).attr('data-number');
			$('.verticaltab-navigation li').removeClass('active');
			$(this).addClass('active');
			$('.widget_veuse_verticaltab_widget').hide();
			$(this).parent().parent().find('.widget_veuse_verticaltab_widget:nth-child(' + count + ')').fadeIn(options.speed);
		});
		
	};  
	
	
	
}( jQuery ));


		