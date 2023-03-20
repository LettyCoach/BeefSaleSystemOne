$(document).ready(function() {
    getPartsList();
});

function getPartsList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var partName = $('#partName').val();
    $.get('/admin/getPartsList',{
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'partName':partName,
    },
     function(data){
        $('#partsList').html(data);
    });
}


function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#part_id').html(id);
}

function trashPart() {
    id=$('#part_id').html();
    $('#deleteForm'+id).submit();
    $('#confirmModal').modal('hide');
}