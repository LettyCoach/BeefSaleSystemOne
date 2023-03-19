$(document).ready(function () {
    getFattenList();
});

function getFattenList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var pastoralId = $("#selectPastoral").val();
    $.get('/common/getFattenList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        "pastoralId": pastoralId
    }, function(data){
        $("#FattenData").html(data);
    });
}

function showAppendInfoAddModal(id) {
    var sex;
    $.get( "/common/getAppendInfoByOxId", {
        'id': id,
    }, function(data) {
        if(data['sex'] == 0) { sex = "雌"; }
        if(data['sex'] == 1) { sex = "雄"; }
        $("#oxIdAddModal").html(data['id']);
        $("#oxRegisterIdAddModal").val(data['registerNumber']);
        $("#oxNameAddModal").val(data['name']);
        $("#oxBirthAddModal").val(data['birthday']);
        $("#oxSexAddModal").val(sex);
        $("#appendInfoAddModal").val(data['appendInfo']);
        $("#appendAddModal").modal('show');
    });
}

function saveAppendInfo() {
    var oxId = $("#oxIdAddModal").html();
    var appendInfo = $("#appendInfoAddModal").val();
    if(appendInfo == "") {
        toastr.warning("入力された情報はありません。");
        return;
    }
    $.post("/common/saveAppendInfo", {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        "oxId": oxId,
        "appendInfo": appendInfo
    }, function(data){
        if(data == "OK") {
            toastr.success("正常に更新されました。");
            $("#appendAddModal").modal('hide');
        }
    });
}

function showAppendInfoViewModal(id) {
    var sex;
    $.get( "/common/getAppendInfoByOxId", {
        'id': id,
    }, function(data) {
        if(data['sex'] == 0) { sex = "雌"; }
        if(data['sex'] == 1) { sex = "雄"; }
        $("#oxIdViewModal").html(data['id']);
        $("#oxRegisterIdViewModal").val(data['registerNumber']);
        $("#oxNameViewModal").val(data['name']);
        $("#oxBirthViewModal").val(data['birthday']);
        $("#oxSexViewModal").val(sex);
        $("#appendInfoViewModal").val(data['appendInfo']);
        $("#appendViewModal").modal('show');
    });
}