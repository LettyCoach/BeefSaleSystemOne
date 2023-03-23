$(document).ready(function () {
    getSlaughterReportList();
 });
function getSlaughterReportList(pageNumber) {
    $.get('/common/getSlaughterReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#slaughterReportData").html(str);
            return;
        }
        $("#slaughterReportData").html(data);
    });
}