function descriptionModal(id) {
    var sex;
    $.get( "../common/oxs/select", {
        'id': id,
    }, function(data) {
        if(data['sex'] == 0) { sex = "雌"; }
        if(data['sex'] == 1) { sex = "雄"; }
        $("#oxId").html(data['id']);
        $("#oxRegisterId").val(data['registerNumber']);
        $("#oxName").val(data['name']);
        $("#oxBirth").val(data['birthday']);
        $("#oxSex").val(sex);
        $("#appendInfo").val(data['appendInfo']);
        $("#modal").fadeIn();
    });
}

function closeModal() {
    $("#modal").fadeOut();
    $("#successModal").fadeOut();
}

function saveAppendInfo() {
    var oxId = $("#oxId").html();
    var appendInfo = $("#appendInfo").val();
    $.get("../common/oxs/saveAppendInfo", {
        "oxId": oxId,
        "appendInfo": appendInfo
    }, function(data){
        if(data == "OK") {
            $("#successModal").fadeIn();
        }
    });
}

function selectPastoral() {
    var pastoralId = $("#selectPastoral").val();
    $.get('../common/oxs/bypastoralId', {
        "pastoralId": pastoralId
    }, function(data){
        $("#FattenData").html(data);
    });
}