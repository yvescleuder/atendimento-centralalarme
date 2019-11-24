var centralalarme = centralalarme || {};

centralalarme.message = (function() {

    var success = function(message) {
        swal(message, {
            icon : "success",
            buttons: {
                confirm: {
                    className : 'btn btn-success'
                }
            },
        });
    };

    var error = function(message) {
        swal(message, {
            icon : "error",
            buttons: {
                confirm: {
                    className : 'btn btn-error'
                }
            },
        });
    };

    return {
        success,
        error
    };

}());
