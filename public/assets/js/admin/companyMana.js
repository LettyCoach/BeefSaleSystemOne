getCompaniesList();

function getCompaniesList(pageNumber) {

    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var companyName = $('#companyName').val();
    var companyPosition = $('#companyPosition').val();
    
    $.get('/admin/getCompaniesList', {
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'companyName': companyName,
        'companyPosition': companyPosition
    }, function(data){
        $("#companiesList").html(data);
    });
}

function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#company_id').html(id);
}

function trashCompany() {
    id = $('#company_id').html();
    $('#deleteForm' + id).submit();
    $('#confirmModal').modal('hide');
}