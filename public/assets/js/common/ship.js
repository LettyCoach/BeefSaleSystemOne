getShipList();

function getShipList() {
    var pastoralId = $("#pastoralId").val();
    var transportCompanyId = $("#transportCompanyId").val();
    $.get('../common/ship/show', {
        'pastoralId': pastoralId,
        'transportCompanyId': transportCompanyId
    }, function(data){
        $("#shipData").html(data);
    });
}

function showAddShipModal() {
    $('#AddShipModal').fadeIn();
    getOxRegisterNumberListByPastoral();
}

function closeAddShipModal() {
    $('#AddShipModal').fadeOut();
}

function getOxRegisterNumberListByPastoral() {
    var pastoralId = $("#pastoralAddShip").val();
    $.get('../common/oxs/getOxRegisterNumberListByPastoral', {
        'pastoralId': pastoralId
    }, function(data){
        $("#oxRegisterNumberByPastoral").html(data);
        getOxNameById();
    });
}

function getOxNameById() {
    var oxId = $("#oxRegisterNumberByPastoral").val();
    $.get('../common/oxs/getOxNameById', {
        'oxId': oxId
    }, function(data){
        $("#oxNameById").val(data);
    });
}