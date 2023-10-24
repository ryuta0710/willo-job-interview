// Get all video elements on the page
const videoElements = document.getElementsByTagName('video');

// Loop over the video elements and create a new Plyr instance for each one
for (let i = 0; i < videoElements.length; i++) {
    const videoElement = videoElements[i];
    const player = new Plyr(videoElement, {
        muted: false,
        volume: 1,
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
    });
}
function select_field(obj, id){
    $("#fields button, .dropdown-item, #other .dropdown-toggle").removeClass("bg-active");
    $(obj).addClass("bg-active");
    if($(obj).hasClass("dropdown-item")){
        $("#other .dropdown-toggle").addClass("bg-active");
    }
    $("#field_id").val(id);
    search();
}

$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll > 75) {
        $("#header").addClass("active");
    }

    else {
        $("#header").removeClass("active");
    }
});

$('#show-toggle-menu').on('click', function () {
    $('.sp-menu').addClass('active');
});

$('#hide-toggle-menu').on('click', function () {
    $('.sp-menu').removeClass('active');
});


//Call jQuery before below code
$('.main-btn').click(function () {
    $('.search-description').slideToggle(100);
});

$('#main-submit-mobile').click(function () {
    $('#main-submit').trigger('click');
});