$(function () {
    $('#example5').Tabledit({
        url: '/record',
        dataType: 'json',
        rowIdentifier: 'data-id',
        editButton: false,
        restoreButton: false,
        buttons: {
            delete: {
                class: 'btn btn-sm btn-danger',
                html: '<span class="glyphicon glyphicon-trash"></span> &nbsp DELETE',
                action: 'delete'
            },
            confirm: {
                class: 'btn btn-sm btn-default',
                html: 'Are you sure?'
            }
        },
        columns: {
            identifier: [0, 'id'],
            editable: [[5, 'testone'], [6, 'testtwo'], [7, 'testthree'], [8, 'exam']]
        },
        onSuccess: function (data, textStatus, jqXHR) {

        },
        onFail: function (jqXHR, textStatus, errorThrown) {

        },
        onAjax: function (action, serialize) {

            console.log("on Ajax");
            console.log("action : ", action);
            console.log("data : ", serialize);
        }
    });
})
