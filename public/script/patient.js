var number;

$('#generate_passcode').click(function(e) {

    // define parameters to send
    var $btn = $(this).button('loading');

    var code = generateNumber();

    $('#passcode').val(code);

    $btn.button('reset');

});

function generateNumber() {
    number = Math.floor((Math.random() * 999998) + 1);
    if (number < 100000) {
        generateNumber();
    }
    return number;
}


$('.delete').click(function(e) {
    var $delete = $(this);
    showDeleteDialog($delete);
});


function showDeleteDialog(icon) {
    $('<div></div>').appendTo('body')
    .html('<div><h6>Do you want to delete this patient? ' +
        'Note that all records associated with this patient will be removed as well</h6></div>')
    .dialog({
        modal: true,
        title: 'Delete Patient',
        zIndex: 10000,
        autoOpen: true,
        width: 'auto',
        resizable: false,
        buttons: {
            Yes: function () {
                // $(obj).removeAttr('onclick');                                
                // $(obj).parents('.Parent').remove();
                var unique_id = icon.attr('id');
                window.location.href = "/patient/delete/" + unique_id;
                $(this).dialog("close");
            },
            No: function () {
                $(this).dialog("close");
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
}