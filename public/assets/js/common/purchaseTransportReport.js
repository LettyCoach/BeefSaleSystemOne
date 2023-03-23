$(document).ready(function () {
    getPurchaseTransportReportList();
});
function getPurchaseTransportReportList(pageNumber) {
    $.get('/common/getPurchaseTransportReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#purchaseTransportReportData").html(str);
            return;
        }
        $("#purchaseTransportReportData").html(data);
    });
}