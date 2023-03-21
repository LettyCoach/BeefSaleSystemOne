getSlaughtersList();

function getSlaughtersList(pageNumber) {

    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var slaughterHouseName = $('#slaughterHouseName').val();
    var slaughterHousePosition = $('#slaughterHousePosition').val();
    
    $.get('/admin/getSlaughterHousesList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'slaughterHouseName': slaughterHouseName,
        'slaughterHousePosition': slaughterHousePosition
    }, function(data){
        $("#slaughterHousesList").html(data);
    });
}

function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#slaughterHouse_id').html(id);
}

function trashSlaughterHouse() {
    id = $('#slaughterHouse_id').html();
    $('#deleteForm' + id).submit();
    $('#confirmModal').modal('hide');
}