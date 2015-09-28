(function($) {

    var body = $('body'),
        menu, button;

    menu = $('.main-nav');
    button = $('#main-btn');

    /**
     *  Menu toggle
     */
    button.click(function() {
        menu.toggleClass('toggle-on');
        button.toggleClass('menu-btn-active');
    });
})($);