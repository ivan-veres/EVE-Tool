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

    var verify = $('#btn-verify');
    var submit = $('#btn-submit');
    var input = $('input');
    var keyid, verCode;

    verify.click(function(e){
        e.preventDefault();
        keyid = $('#keyid').val();
        verCode = $('#verCode').val();
        $.ajax({
            type: 'GET',
            url: 'https://api.eveonline.com/account/APIKeyInfo.xml.aspx',
            data: {keyID: keyid, vCode: verCode},
            beforeSend: function() {
                verify.attr('disabled', true);
            },
            success: function(xml){
                var error = $(xml).find('error');

                if (!error.length > 0) {
                    var charId = $(xml).find('row').attr('characterID');
                    var charName = $(xml).find('row').attr('characterName');

                    input.eq(2).val(charId)
                    input.eq(3).val(charName)

                    alert('Api key OK!');

                    verify.attr('disabled', false);
                    submit.attr('disabled', false);
                }
            },
            error: function() {
                verify.attr('disabled', false);
                alert('Wrong Api key!');
            }
        });
    });
})($);

(function($){

    var flash = $('.flash');

    flash.delay(3000).fadeOut('slow');
})($);