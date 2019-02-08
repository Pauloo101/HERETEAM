$(function () {
    $('#example5').Tabledit({
        url: '/student&subject',
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
            editable: [[3, 'testone'], [4, 'testtwo'], [5, 'testthree'],[6,'exam']]
        },
        onDraw: function() {
            console.log('onDraw()');
        },
        onSuccess: function(data, textStatus, jqXHR) {
            console.log('onSuccess(data, textStatus, jqXHR)');
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
        },
        onFail: function(jqXHR, textStatus, errorThrown) {
            console.log('onFail(jqXHR, textStatus, errorThrown)');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        onAlways: function() {
            console.log('onAlways()');
        },
        onAjax: function(action, serialize) {
            console.log('onAjax(action, serialize)');
            console.log(action);
            console.log(serialize);
        }
    });
});