$(document).ready(function () {
    getMeatList();
});
function getMeatList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var meatState = $('#meatState').val();
    $.get('/common/getMeatList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,    
        'meatState':meatState,
    }, function(data){
       
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#getMeatList").html(str);
            return;
        }
        $("#getMeatList").html(data);
    });
}
