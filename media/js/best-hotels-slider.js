function bestHotelsPrev() {	
	var active = $('#best-hotels .active');
	var prev = active.prev();
	
	if(active.index() == 0) {
		var prev = $('#best-hotels .item').last();
	}
	
	active.stop().animate({
		'left' : '210px'
	});
	
	prev.css({
		'left' : '-210px',
		'top' : '0'
	}).stop().animate({
		'left' : '0'
	}, function() {
		active.removeClass('active');
		$(this).addClass('active');
	});
	
	clearInterval(slideInterval);
	setSlideTimer();
} 

function bestHotelsNext() {	
	var active = $('#best-hotels .active');
	var next = active.next();
	
	if(active.index() == $('#best-hotels .item').length-1) {
		var next = $('#best-hotels .item').first();
	}
	
	active.stop().animate({
		'left' : '-210px'
	});
	
	next.css({
		'left' : '210px',
		'top' : '0'
	}).stop().animate({
		'left' : '0'
	}, function() {
		active.removeClass('active');
		$(this).addClass('active');
	});
	
	clearInterval(slideInterval);
	setSlideTimer();	
}

function setSlideTimer() {
	slideInterval = setInterval(function() {
		bestHotelsNext();
	}, 7000);
}

$(function() {
	setSlideTimer();
});
