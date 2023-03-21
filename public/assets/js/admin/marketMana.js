getMarketsList();

function getMarketsList(pageNumber) {

    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var marketName = $('#marketName').val();
    var marketPosition = $('#marketPosition').val();
    
    $.get('/admin/getMarketsList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'marketName': marketName,
        'marketPosition': marketPosition
    }, function(data){
        $("#marketsList").html(data);
    });
}

function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#market_id').html(id);
}

function trashMarket() {
    id = $('#market_id').html();
    $('#deleteForm' + id).submit();
    $('#confirmModal').modal('hide');
}