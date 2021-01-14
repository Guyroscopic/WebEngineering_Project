
//jQuery for page scrolling feature - requires jQuery Easing plugin
//when any of the button is clicked from the side bar the scrolling occurs is provided through it
$(function() {

    $('a.page-scroll[href*="#"]:not([href="#"])').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top -70)
                }, 1200, "easeInOutExpo");
                return false;
            }
        }
    });

});

