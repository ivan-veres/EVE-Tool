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

(function($){

    var button = $('#btn-verify'),
        keyid, verCode;

    keyid = $('#keyid').val();
    verCode = $('#verCode').val();

    button.click(function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'https://api.eveonline.com/account/APIKeyInfo.xml.aspx',
            data: {keyID: keyid, vCode: verCode},
            beforeSend: function() {
                button.attr('disabled', true);
            },
            success: function(xml){
                var am = $(xml).find('key').attr('accessMask');
                console.log(am);

                if (am) {
                    alert('OK!');
                    button.attr('disabled', false);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                button.attr('disabled', false);
                alert('Nop!');
            }
        });
    });
})($);

(function($){

    var flash = $('.flash');

    flash.delay(3000).fadeOut('slow');
})($);