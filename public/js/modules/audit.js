var centralalarme = centralalarme || {};

centralalarme.audit = (function() {

    let info = function(getModified) {

        let textModal = [];

        $.each(getModified, function(attribute, modified) {
            textModal += '<b>- Atributo:</b> '+attribute+'<br />';
            if(modified.old)
                textModal += '<b>-- Antigo:</b> '+modified.old+'<br />';
            if(modified.new)
                textModal += '<b>-- Novo:</b> '+modified.new+'<br />';
            textModal += '<br />';
        });

        $('#textModal').html(textModal);
        $('.modal').modal('toggle');

    };

    return {
        info
    }

}());
