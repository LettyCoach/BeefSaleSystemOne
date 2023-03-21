$(document).ready(function() {
    getTransportCompaniesList();
});

function getTransportCompaniesList(pageNumber) {
    if(pageNumber == undefined) {
        pageNumber = 1;
    }
    var pageSize = $('#pageSize').val();
    var transportCompanyName = $('#transportCompanyName').val();
    var transportCompanyPosition = $('#transportCompanyPosition').val();
    $.get('/admin/getTransportCompaniesList',{
        'pageNumber': pageNumber,
        'pageSize': pageSize,
        'transportCompanyName':transportCompanyName,
        'transportCompanyPosition':transportCompanyPosition,
    },
     function(data){
        $('#transportCompaniesList').html(data);
    });
}

function showConfirmModal(id) {
    $('#confirmModal').modal('show');
    $('#transportCompany_id').html(id);
    
}

function trashTransportCompany() {
    id=$('#transportCompany_id').html();
    
    $('#deleteForm'+id).submit();
    $('#confirmModal').modal('hide');
}