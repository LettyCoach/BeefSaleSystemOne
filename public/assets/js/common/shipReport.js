$(document).ready(function () {
    getShipReportList();
 });
function getShipReportList(pageNumber) {
    $.get('/common/getShipReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#shipReportData").html(str);
            return;
        }
        $("#shipReportData").html(data);
    });
}