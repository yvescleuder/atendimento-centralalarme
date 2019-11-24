var centralalarme = centralalarme || {};
centralalarme.attendance = centralalarme.attendance || {};

centralalarme.attendance.create = (function() {

    var messageError = function(message) {
        swal(message, {
            icon : "error",
            buttons: {
                confirm: {
                    className : 'btn btn-error'
                }
            },
        });
    };

    var timepicker = function() {
        $('.timepicker').datetimepicker({
            format: 'HH:mm',
        });
    };

    var select2 = function() {
        $(".requester").select2({
            tags: true,
            theme: "bootstrap",
            placeholder: "Quem fez a solicitação de atendimento?"
        });
    };

    return {
        messageError,
        timepicker,
        select2
    };

}());
