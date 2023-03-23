$(document).ready(function () {
    getPurchaseReportList();
 });
function getPurchaseReportList(pageNumber) {
    $.get('/common/getPurchaseReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#purchaseReportData").html(str);
            return;
        }
        $("#purchaseReportData").html(data);
    });
}