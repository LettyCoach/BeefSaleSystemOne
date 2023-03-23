$(document).ready(function () {
    getFattenReportList();
 });
function getFattenReportList(pageNumber) {
    $.get('/common/getFattenReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#fattenReportData").html(str);
            return;
        }
        $("#fattenReportData").html(data);
    });
}