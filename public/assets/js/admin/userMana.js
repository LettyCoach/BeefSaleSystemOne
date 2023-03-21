$(document).ready(function() {
    getUserList();
});

function getUserList(pageNumber) {

    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    
    var pageSize = $('#pageSize').val();
    var userName = $('#userName').val();
    var userEmail = $('#userEmail').val();

    $.get('/admin/getUserList', {
        'pageSize': pageSize,
        'pageNumber': pageNumber,
        'userName': userName,
        'userEmail': userEmail
    }, function(data){
        $('#userData').html(data);
    });
}

function showAddRoleModal(userId) {
    $('#userIdAddModal').html(userId);
    $('#userNameAddModal').html($('#userName'+userId).html());
    let userRoleMaxCount = $('#userRoleMaxCount').html();
       $.get('/admin/users/getUserById', {
        "userId": userId
    }, function(data){
        var roleLen = data.length;
        for(j = 0; j < userRoleMaxCount; j ++) {
            $('.form-check-input')[j].checked = false;
        }
        for(i = 0; i < roleLen; i ++) {
            $('.form-check-input')[data[i].id - 2].checked = true;
        }
    });
    $('#addRoleModal').modal('show');
}

function storeUserRole() {
    
    userId = $('#userIdAddModal').html();
    userRoleMaxCount = $('#userRoleMaxCount').html();
    let roleArray = [];
    let cnt = 0;
    for(i = 0; i < userRoleMaxCount; i ++) {
        if($('.form-check-input')[i].checked == true) {
            roleArray[cnt] = i + 1;
            cnt ++;
        }
    }
    if(roleArray.length == 0) {
        $.post('/admin/userRoleAdd', {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'userId': userId,
            'userRoleArray': 'noRole'
        }, function(data){
            if(data == "OK") {
                $('#addRoleModal').modal('hide');
                toastr.success('正常に削除されました。');
            }
        });
    } else {
        $.post('/admin/userRoleAdd', {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'userId': userId,
            'userRoleArray': roleArray
        }, function(data){
            if(data == "OK") {
                $('#addRoleModal').modal('hide');
                toastr.success('成果的に登録されました。。');
            }
        });
    }
}

function showConfirmModal(userId) {
    $('#userIdConfirmModal').html(userId);
    $('#confirmModal').modal('show');
}

function deleteUser() {
    userId = $('#userIdConfirmModal').html();
    
    $.get('/admin/userDestroy', {
        'userId': userId
    }, function(data){
        if(data == "OK") {
            $('#confirmModal').modal('hide');
            toastr.success('正常に削除されました。');
            getUserList();
        }
    });
}