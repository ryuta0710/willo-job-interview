$(document).ready(function () {
	$(".nav-link").click(function () {
		$(".nav-link").removeClass("active");
		$(this).addClass("active");
		let id = $(this).attr("href");
		$(".tab-pane").removeClass("active");
		$(id).addClass("active");
	})

	// answer item clicked    
	var player = new Plyr('video', {
		muted: false,
		volume: 1,
		controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
	});

	//slick 
	$('.slider-for').slick({
	});
	

})