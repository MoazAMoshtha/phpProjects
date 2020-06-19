$(function (){

	'user strict';
	// Tigger The SelectBoxIt

	 $("select").selectBoxIt({
		 autoWidth:false
	 });

	// Hide Placeholder On Form Focus

	$('[Placeholder]').focus(function (){

		$(this).attr('data-text', $(this).attr('Placeholder'));
		$($this).attr('Placeholder','');
	}).blur(function (){
		$(this).attr('Placeholder', $(this).attr('data-text'));
	});

	// Add Asterisk On Requrired Field

	$('input').each (function() {

		if ($(this).attr ('requrired') === 'requrired') {
			$(this).after('<span class = "asterisk">*</span>');

		}
	});

		// Convert Password Field To Text Filed  On Hover
		var passField = $('.password');
		$('.show-Pass').hover(function(){
			passField.attr('type','text');
		},function(){
			passField.attr('type', 'text');
		});

		// Confirmation Massage On Button

		$('.confirm').click(function(){
			return confirm('Are You  Sure ?');
		});

		// Category View Option
		$('.cat h3').clike(function(){
			$(this).next('.full-view').fadeToggle(200);
		});
		$('.option span').click(function(){

			$(this).addClass('active').siblings('span').removeClass('active');
			if($(this).data('view') === 'full'){
				$('.cat .full-view').fadeIn(200);
			} else {
				$('.vat .full-view').fadeOut(200);
			}
		});
});
