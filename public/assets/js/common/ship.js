$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    getShipList();
});

function getShipList() {
    var pastoralId = $("#pastoralId").val();
    var transportCompanyId = $("#transportCompanyId").val();
    $.get('../common/ship/show', {
        'pastoralId': pastoralId,
        'transportCompanyId': transportCompanyId
    }, function (data) {
        $("#shipData").html(data);
    });
}

function showAddShipModal() {
    $('#AddShipModal').modal('show');
    getOxRegisterNumberListByPastoral();
}

function closeAddShipModal() {
    $('#AddShipModal').fadeOut();
}

function getOxRegisterNumberListByPastoral() {
    var pastoralId = $("#pastoralAddShip").val();
    $.get('../common/oxs/getOxRegisterNumberListByPastoral', {
        'pastoralId': pastoralId
    }, function (data) {
        $("#oxRegisterNumberByPastoral").html(data);
        getOxNameById();
    });
}

function getOxNameById() {
    var oxId = $("#oxRegisterNumberByPastoral").val();
    $.get('../common/oxs/getOxNameById', {
        'oxId': oxId
    }, function (data) {
        $("#oxNameById").val(data);
    });
}

function addShip() {
    var pastoralId = $("#pastoralAddShip").val();
    var transportCompanyId = $("#transportCompanyAddShip").val();
    var oxId = $("#oxRegisterNumberByPastoral").val();
    var exportDate = $("#exportDateAddShip").val();
    var slaughterHouseId = $("#slaughterHouseAddShip").val();

    if (oxId == 0) {
        toastr.warning('牛が選択されていない。<br>牛を選択してもう一度やり直してください。');
        return;
    }
    
    if(exportDate > getTodayDate()) {
        toastr.warning('日付入力時にエラーが発生しました。<br>もう一度お試しください。');
        return;
    }

    $.post('/common/ship', {
        _token: $('meta[name="csrf-token"]').attr('content'),
        'pastoralId': pastoralId,
        'transportCompanyId': transportCompanyId,
        'oxId': oxId,
        'exportDate': exportDate,
        'slaughterHouseId': slaughterHouseId
    }, function(data){
        if(data == "OK") {
            toastr.success('操作に成功しました。');
            $('#AddShipModal').modal('hide');
            getShipList();
        } else {
            toastr.error('サーバーでエラーが発生しました。');
        }
    });
}

function editShip(id) {
    oxId = id;
    $.get('/common/oxs/getOxById', {
        'oxId': oxId
    }, function(data){
        // alert(data['pastoral_id'])
        const selectPastoral = document.querySelector('#pastoralEditShip');
        const selectTransportCompany = document.querySelector('#transportCompanyEditShip');
        const selectSlaughterHouse = document.querySelector('#slaughterHouseEditShip');

        $("#oxIdEditShip").html(oxId);
        selectPastoral.value = data['pastoral_id'];
        selectTransportCompany.value = data['slaughterTransport_Company_id'];
        $("#oxIdEditModal").val(data['registerNumber']);
        $("#oxNameEditModal").val(data['name']);
        $("#exportDateEditShip").val(data['exportDate']);
        selectSlaughterHouse.value = data['slaughterHouse_id'];
        $('#EditShipModal').modal('show');
    });
}

function closeEditShipModal() {
    $('#EditShipModal').modal('hide');
}


function updateShip() {
    var pastoralId = $("#pastoralEditShip").val();
    var transportCompanyId = $("#transportCompanyEditShip").val();
    var oxId = $("#oxIdEditShip").html();
    var exportDate = $("#exportDateEditShip").val();
    var slaughterHouseId = $("#slaughterHouseEditShip").val();

    $.post('/common/ship', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'pastoralId': pastoralId,
        'transportCompanyId': transportCompanyId,
        'oxId': oxId,
        'exportDate': exportDate,
        'slaughterHouseId': slaughterHouseId
    }, function(data){
        if(data == "OK") {
            toastr.success('操作に成功しました。');
            $('#EditShipModal').modal('hide');
            getShipList();
        } else {
            toastr.error('サーバーでエラーが発生しました。');
            return;
        }
    });
}

function deleteShip(id) {
    $("#oxIdConfirmModal").html(id);
    $("#confirmModal").modal('show');
}

function closeConfirmModal() {
    $("#confirmModal").modal('hide');
}

function trashShip() {
    oxId = $("#oxIdConfirmModal").html();
    $.get('/common/shipDestroy', {
        'oxId': oxId
    }, function(data){
        if(data == "OK") {
            toastr.success('操作に成功しました。');
            $('#confirmModal').modal('hide');
            getShipList();
        } else {
            toastr.error('サーバーでエラーが発生しました。');
        }
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