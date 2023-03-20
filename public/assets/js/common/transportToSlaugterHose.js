$(document).ready(function () {
    getExportTransportCompanyList();
});
function getExportTransportCompanyList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
     var SelectCompany = $('#SelectCompany').val();
     var transportState = $('#transportState').val();
     var pastoral = $('#pastoral').val();
     var slaughterHouse = $('#slaughterHouse').val();
    $.get('/common/getExportTransportCompanyList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
         'SelectCompany':SelectCompany,
         'transportState':transportState,
         'pastoral':pastoral,
         'slaughterHouse':slaughterHouse,    
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#exportTransportCompanyList").html(str);
            return;
        }
        $("#exportTransportCompanyList").html(data);
    });
}

function register(pageNumber,ox_id) {

    if(pageNumber == undefined) {
        pageNumber = 1;
    }   
    var pageSize = $('#pageSize').val();
     var SelectCompany = $('#SelectCompany').val();
     var pastoral = $('#pastoral').val();
     var slaughterHouse = $('#slaughterHouse').val();
     var transportState = $('#transportState').val();
     var acceptedDateSlaughterHouse = $('#acceptedDateSlaughterHouse'+ox_id).val();
     if(acceptedDateSlaughterHouse == ""){
        toastr.warning('受付日が選択されていません。');
        return ;
     }
    $.get('/common/getExportTransportCompanyList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'SelectCompany':SelectCompany,
        'transportState':transportState,
        'pastoral':pastoral,
        'slaughterHouse':slaughterHouse, 
         'acceptedDateSlaughterHouse':acceptedDateSlaughterHouse,
         'ox_id':ox_id,
    }, function(data){
        
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#exportTransportCompanyList").html(str);
            return;
        }
        $("#exportTransportCompanyList").html(data);
    });
}
function cancel(ox_id) {
    $.post('/common/transportToSlaughterCancel', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'acceptedDateSlaughterHouse':"1900-01-01",
        'ox_id':ox_id,
    }, function(data){   
        if(data == "CannotDelete"){
            toastr.warning('すでに牛が屠殺されているのでキャンセルできません。');
        } else{
            toastr.success('正常にキャンセルされました。');
            getExportTransportCompanyList();
        }
    });
}