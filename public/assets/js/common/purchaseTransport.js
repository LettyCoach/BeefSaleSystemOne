$(document).ready(function(){
    today = getTodayDate();
    document.getElementById("firstDate").setAttribute('max', today);
    document.getElementById("lastDate").setAttribute('max', today);
    getPurchaseTransportList();
});

function getPurchaseTransportList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }

    var transportCompanyId = $("#transportCompany").val();
    var firstDate = $("#firstDate").val();
    var lastDate = $("#lastDate").val();
    var pastoralId = $("#pastoral").val();
    var pageSize = $('#pageSize').val();
    var loadType = $('#loadType').val();
    var loadState = $('#loadState').val();

    if(firstDate > lastDate) {
        toastr.warning('最初の日付は最後の日付より大きくてはいけません。');
        return;
    }

    $.get('/common/getPurchaseTransportList', {
        'transportCompanyId': transportCompanyId,
        'firstDate': firstDate,
        'lastDate': lastDate,
        'pastoralId': pastoralId,
        'pageSize': pageSize,
        'loadType': loadType,
        'loadState': loadState,
        'pageNumber': pageNumber
    }, function(data){
        $("#purchaseTransportData").html(data);
    });
}

function showPurchaseTransLoadModal(OxId) {

    var marketName = $('#marketName_' + OxId).html();
    var transportCompanyName = $('#transportCompanyName_' + OxId).html();
    var pastoralName = $('#pastoralName_' + OxId).html();

    $.get('/common/getPurchaseTransDataByOxId', {
        'OxId': OxId
    }, function(data){
        $('#OxIdLoadModal').html(OxId);

        $('#OxRegisterNumberLoadModal').val(data['registerNumber']);
        $('#OxNameLoadModal').val(data['name']);
        $('#MarketNameLoadModal').val(marketName);
        $('#TransportNameLoadModal').val(transportCompanyName);
        $('#PastoralNameLoadModal').val(pastoralName);
        
        $('#PurchaseTransLoadModal').modal('show');
    });
}

function registerDate(registerType) {
    if(registerType == 'load') {
        OxId = $('#OxIdLoadModal').html();
        LoadDate = $('#LoadDate').val();
    }

    if(registerType == 'unload') {
        OxId = $('#OxIdUnloadModal').html();
        LoadDate = $('#UnloadDate').val();
    }
    

    $.post('/common/transports', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'OxId': OxId,
        'LoadDate': LoadDate,
        'registerType': registerType
    }, function(data){
        if(data == "OK") {
            toastr.success('成果的に登録されました。');
            $('#PurchaseTransLoadModal').modal('hide');
            $('#PurchaseTransUnloadModal').modal('hide');
            getPurchaseTransportList();
        }
    });
}

function showPurchaseTransUnloadModal(OxId) {

    var marketName = $('#marketName_' + OxId).html();
    var transportCompanyName = $('#transportCompanyName_' + OxId).html();
    var pastoralName = $('#pastoralName_' + OxId).html();

    $.get('/common/getPurchaseTransDataByOxId', {
        'OxId': OxId
    }, function(data){
        $('#OxIdUnloadModal').html(OxId);

        $('#OxRegisterNumberUnloadModal').val(data['registerNumber']);
        $('#OxNameUnloadModal').val(data['name']);
        $('#MarketNameUnloadModal').val(marketName);
        $('#TransportNameUnloadModal').val(transportCompanyName);
        $('#PastoralNameUnloadModal').val(pastoralName);
        
        $('#PurchaseTransUnloadModal').modal('show');
    });
}

function showPurchaseTransViewModal(OxId) {
    
    var marketName = $('#marketName_' + OxId).html();
    var transportCompanyName = $('#transportCompanyName_' + OxId).html();
    var pastoralName = $('#pastoralName_' + OxId).html();

    $.get('/common/getPurchaseTransDataByOxId', {
        'OxId': OxId
    }, function(data){

        if(data['sex'] == 0) {
            sex = '雄';
        } else {
            sex = '雌';
        }

        if(data['loadDate'] != null) {
            loadDate = data['loadDate'];
            loadState = "完了";
        } else {
            loadDate = "mm/dd/yyyy";
            loadState = "未";
        }

        if(data['unloadDate'] == null) {
            unloadDate = "mm/dd/yyyy";
            unloadState = "未";
        } else {
            unloadDate = data['unloadDate']
            unloadState = "完了";
        }

        $('#OxRegisterNumberInfo').val(data['registerNumber']);
        $('#OxNameInfo').val(data['name']);
        $('#OxBirthInfo').val(data['birthday']);
        $('#OxSexInfo').val(sex);
        $('#MarketNameInfo').val(marketName);
        $('#TransportCompanyNameInfo').val(transportCompanyName);
        $('#PastoralNameInfo').val(pastoralName);
        $('#LoadStateInfo').val(loadState);
        $('#LoadDateInfo').val(loadDate);
        $('#UnloadStateInfo').val(unloadState);
        $('#UnloadDateInfo').val(unloadDate);
        $('#PurchaseTransViewModal').modal('show');
    });
}

function getTodayDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}
