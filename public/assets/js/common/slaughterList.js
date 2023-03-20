$(document).ready(function () {
    slaughterList();
});
function slaughterList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var SlaughterHouse = $('#SlaughterHouse').val();
    var slaughterState = $('#slaughterState').val();
    $.get('/common/slaughterList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,    
        'slaughterState':slaughterState,
        'SlaughterHouse':SlaughterHouse,
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#slaughterList").html(str);
            return;
        }
        $("#slaughterList").html(data);
    });
}

function register(pageNumber,ox_id) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }   
    var pageSize = $('#pageSize').val();
     var SlaughterHouse = $('#SlaughterHouse').val();
     var acceptedWeight = $('#acceptedWeight'+ox_id).val();
     var acceptedLevel = $('#acceptedLevel'+ox_id).val();
     var slaughterFinishedDate = $('#slaughterFinishedDate'+ox_id).val();
     var slaughterState = $('#slaughterState').val();
     if(slaughterFinishedDate == ""){
        toastr.warning('アクセス権はありません。');
        return ;
     }
     alert()
    $.get('/common/slaughterList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'SlaughterHouse':SlaughterHouse,
        'acceptedWeight':acceptedWeight,
        'acceptedLevel':acceptedLevel, 
        'slaughterFinishedDate':slaughterFinishedDate,
        'ox_id':ox_id,
        'slaughterState':slaughterState,
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#slaughterList").html(str);
            return;
        }
        $("#slaughterList").html(data);
    });
}