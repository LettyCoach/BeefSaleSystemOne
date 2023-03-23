$(document).ready(function () {
    getTransportToSlaughterHouseReportList();
 });
function getTransportToSlaughterHouseReportList(pageNumber) {
    $.get('/common/getTransportToSlaughterHouseReportList', {
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#transportToSlaughterHouseReportData").html(str);
            return;
        }
        $("#transportToSlaughterHouseReportData").html(data);
    });
}