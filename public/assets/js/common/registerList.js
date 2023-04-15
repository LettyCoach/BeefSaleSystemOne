$(document).ready(function () {
    getRegisterList();
});
function getRegisterList() {
    var ox_id = $('#ox_id').val();
    var part_id = $('#part_id').val();
    $.get('/common/getRegisterList', {
        'ox_id':ox_id,
        'part_id':part_id,
    }, function(data){
        if(data == "DateError"){
            toastr.warning('アクセス権はありません。');
            var str = "<tr><td colspan='11'></td></tr>";
            $("#registerList").html(str);
            return;
        }
        $("#registerList").html(data);
    });
}

function addPartRegister() {
    var ox_id = $('#ox_id').val();
    var part_id = $('#part_id').val();
    var weight = $('#weight').val();
    var price = $('#price').val();
    if(weight == "" || price == "")
        toastr.warning('重量と価格を入力してください。');
    $.get('/common/addPartRegister', {
        'ox_id':ox_id,
        'part_id':part_id,
        'weight':weight,
        'price':price,
    }, function(data){
        if(data == "Duplicate"){
            toastr.warning('すでに登録されています。');
            return;
        }
        toastr.warning('成果的に登録されました。');
        $("#registerList").html(data);
    });
}


function showUpdateModal(part_id,ox_id){
    $('#part_idModal').val(part_id);
    $('#ox_idModal').val(ox_id);
    partName = $('#partName'+part_id).text();
    $('#PartNameModal').val($.trim(partName));
    weight = $('#weight'+part_id).text();
    $('#WeightModal').val($.trim(weight));
    price = $('#price'+part_id).text();
    $('#PriceModal').val($.trim(price));
    $('#updateModal').modal('show');
}
function updatePartRegister() {
    var ox_id = $('#ox_idModal').val();
    var part_id = $('#part_idModal').val();
    var partName = $('#PartName').val();
    var weight = $('#WeightModal').val();
    var price = $('#PriceModal').val();
    $.get('/common/updatePartRegister', {
        'ox_id':ox_id,
        'part_id':part_id,
        'partName':partName,
        'weight':weight,
        'price':price,
    }, function(data){
        toastr.warning('成果的に更新されました。');
        $("#registerList").html(data);
        $('#updateModal').modal('hide');
    });
}

function deletePartRegister(part_id,ox_id) {
    $.get('/common/deletePartRegister', {
        'ox_id':ox_id,
        'part_id':part_id,
    }, function(data){
        toastr.warning('成果的に削除されました。');
        $("#registerList").html(data);
    });
}