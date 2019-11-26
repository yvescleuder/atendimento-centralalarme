var centralalarme = centralalarme || {};

centralalarme.attendance = (function() {

    var index = (function() {

        var modalNote = function(message) {
            $('#modal-note-text').html(message);
            $('#modal-note').modal('toggle');
        };

        return {
            modalNote
        }
    });

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

    var textareaNotEnter = function() {
        $("textarea").keydown(function(e) {
            if (e.keyCode == 13)
            {
                // prevent default behavior
                e.preventDefault();
            }
        });
    };


    return {
        index,
        timepicker,
        select2,
        textareaNotEnter
    }

}());
