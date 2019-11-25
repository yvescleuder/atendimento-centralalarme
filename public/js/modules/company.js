var centralalarme = centralalarme || {};

centralalarme.company = (function() {

    var colpick = function() {
        $('.demo').each( function() {
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: 'lowercase',
                opacity: false,

                theme: 'bootstrap'
            });
        });
    };

    return {
        colpick
    }

}());
