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
        toastr.warning('資料を入力してください。');
        return ;
     }
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

function cancel(ox_id) {
     var acceptedWeight = $('#acceptedWeight'+ox_id).val();
     var acceptedLevel = $('#acceptedLevel'+ox_id).val();
    $.post('/common/slaughterCancel', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'acceptedWeight':acceptedWeight,
        'acceptedLevel':acceptedLevel, 
        'slaughterFinishedDate':"1900-01-01",
        'ox_id':ox_id,
    }, function(data){
        if(data == "CannotDelete"){
            toastr.warning('すでに牛が屠殺されているのでキャンセルできません。');
        } else{
            toastr.success('正常にキャンセルされました。');
            slaughterList();
        }
    });
}
