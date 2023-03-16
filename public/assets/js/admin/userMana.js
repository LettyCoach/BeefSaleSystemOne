$(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

function showAddRoleModal(userId) {
    $('#userIdAddModal').html(userId);
    $('#userNameAddModal').html($('#userName'+userId).html());
    $('#userEmailAddModal').html($('#userEmail'+userId).html());
    $.get('/admin/users/getUserById', {
        "userId": userId
    }, function(data){
        var roleLen = data.length;
        for(j = 0; j < 6; j ++) {
            $('.form-check-input')[j].checked = false;
        }
        for(i = 0; i < roleLen; i ++) {
            $('.form-check-input')[data[i].role_id - 2].checked = true;
        }
    });
    $('#addRoleModal').modal('show');
}

function storeUserRole() {
    userId = $('#userIdAddModal').html();
    let roleArray = [];
    let cnt = 0;
    for(i = 0; i < 6; i ++) {
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
                alert('noRole');
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
                // toastr.success('正常に更新されました。');
                alert(data);
            }
        });
    }
}