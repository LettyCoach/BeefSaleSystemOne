<script>
 
 function register(id){
        alert($('#loadDateForm'+id).serialize())
        $.post(
            "{{ route('transports.list')}}",
            $('#loadDateForm'+id).serialize(),
            function( data ){
                $('#content').html( data );
            },

        )
        .fail(function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
        });
    }

    

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("change", "#SelectCompany", function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('transports.list')}}",
            type: "POST",
            data: $('#navForm').serialize(),
            //data:"SelectCompany=8 & statu=1",
            success: function(data) {

                $('#content').html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
    $(document).on("change", "#statu", function(e) {

        e.preventDefault();
        $.ajax({
            url: "{{ route('transports.list')}}",
            type: "POST",
            data: $('#navForm').serialize(),
            //data:"SelectCompany=8 & statu=1",
            success: function(data) {

                $('#content').html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
    
        $.ajax({
            url: "{{ route('transports.list')}}",
            type: "POST",
            data: $('#navForm').serialize(),
            //data:"SelectCompany=8 & statu=1",
            success: function(data) {

                $('#content').html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })();
   
 
});
</script>

function saveAppendInfo() {
    var oxId = $("#oxId").html();
    var appendInfo = $("#appendInfo").val();
    $.get("../admin/oxs/saveAppendInfo", {
        "oxId": oxId,
        "appendInfo": appendInfo
    }, function(data){
        if(data == "OK") {
            $("#successModal").fadeIn();
        }
    });
}