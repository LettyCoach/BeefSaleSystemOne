$(document).ready(function () {
    getPurchaseList();
    var today = getTodayDate();
    document.getElementById("startDate").setAttribute('max', today);
    document.getElementById("endDate").setAttribute('max', today);
});
function getTodayDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}
function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#oxIdConfirmModal').html(id);
}

function trashPurchase() {
    var id = $('#oxIdConfirmModal').html();
    $('#deleteForm' + id).submit();
}

function getPurchaseList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var market_id = $('#market_id').val();
    var transportCompany_id = $('#transportCompany_id').val();
    var pastoral_id = $('#pastoral_id').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    $.get('/common/getPurchaseList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'market_id':market_id,
        'transportCompany_id':transportCompany_id,
        'pastoral_id':pastoral_id,
        'startDate':startDate,
        'endDate':endDate,
    
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#purchaseData").html(str);
            return;
        }
        $("#purchaseData").html(data);
    });
}
