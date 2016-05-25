(function() {
	var target = $('#buttonFilters');
	var element = $('.exp_content');
	var up = '<i class="caret pull-right rotate" style="margin-top: 20px"></i>';
	var down = '<i class="caret pull-right" style="margin-top: 20px"></i>';
	var dropdown = $('.dropdown.custom');
	var caret = $('.dropdown.custom').find('.caret');

	$('.dropdown-toggle').click(function() {
		$(this).next('.dropdown-menu').slideToggle(200, function() {
			if(dropdown.hasClass('open')) {
				caret.addClass('rotate');
			}else {
				caret.removeClass('rotate');
			}
		});
	});

	$(window).resize(function() {
        ellipses1 = $("#bc1 :nth-child(2)");
        if ($("#bc1 a:hidden").length >0) {ellipses1.show()} else {ellipses1.hide()}
    });

    target.click(function() {
    	element.slideToggle(100, function() {
	    	if(target.text() == 'Hide filters') target.text('Show filters').append(down);
	    	else target.text('Hide filters').append(up);
    	});
    });

})();