$(document).ready(function(){
	var pageWidth = $(window).width();
		pageHeight = $(window).height();
	
	$('.page').width(pageWidth).height(pageHeight);
	$('#toContact').click(function(){
		$('#contact').animate({'top': 0}, 'slow');
	});
	$('#cancel, #toHome').click(function(){
		$('#form_wrap').css({'height': 446,	'top': 0});
		$('#contact').animate({'top': -1 * pageHeight}, 'slow');
	});
	$(window).resize(function(){
		pageWidth = $(window).width();
		pageHeight = $(window).height(),
		$('#toHome','#toContact').css({'width': pageWidth, 'height': pageHeight});
	});
});