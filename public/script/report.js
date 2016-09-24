

$('.delete').click(function(e) {
    var $delete = $(this);
    showDeleteDialog($delete);
});


function showDeleteDialog(icon) {
    $('<div></div>').appendTo('body')
    .html('<div><h6>Do you want to delete this report? ' +
        'Note that all records associated with this report will be removed as well</h6></div>')
    .dialog({
        modal: true,
        title: 'Delete Report',
        zIndex: 10000,
        autoOpen: true,
        width: 'auto',
        resizable: false,
        buttons: {
            Yes: function () {
                // $(obj).removeAttr('onclick');                                
                // $(obj).parents('.Parent').remove();
                var id = icon.attr('id');
                window.location.href = "/report/delete/" + id;
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