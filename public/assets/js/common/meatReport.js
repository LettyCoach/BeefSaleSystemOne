$(document).ready(function () {
    getMeatReportList();
 });
function getMeatReportList(pageNumber) {
    $.get('/common/getMeatReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#meatReportData").html(str);
            return;
        }
        $("#meatReportData").html(data);
    });
}