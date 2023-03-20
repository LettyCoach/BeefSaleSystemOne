$(document).ready(function() {
    getPastoralsList();
});

function getPastoralsList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var pastoralName = $('#pastoralName').val();
    var pastoralPosition = $('#pastoralPosition').val();
    $.get('/admin/getPastoralsList',{
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'pastoralName':pastoralName,
        'pastoralPosition':pastoralPosition,
    },
     function(data){
        $('#pastoralsList').html(data);
    });
}

function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#pastoral_id').html(id);
}
function trashPastoral() {
    id=$('#pastoral_id').html();
    $('#deleteForm'+id).submit();
    $('#confirmModal').modal('hide');
}
