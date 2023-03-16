@extends('layouts.commonUser')
@section('content')

<div class="container mx-auto mt-5 pt-5">
    <h2 class="mt-5 text-center mb-4 fw-bold">運搬（運送済みの牛の報告）</h2>
    <form action="navForm" id="navForm" method="post" class="d-flex justify-content-end">
        @csrf
        <div class="rounded-md">
            <select name="SelectCompany" id="SelectCompany" class="form-select mb-2" onchange="selectCompany()">
                @foreach($transportCompanies as $transportCompany)
                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<div class="" id="content">
</div>
<script>
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function register(id){                      
            $.post(
                "{{ route('transportToSlaughterHouses.list')}}",
                $('#loadDateForm'+id).serialize(),
                function( data ){
                    alert(data)
                    $('#content').html( data );
                },

            )
            .fail(function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
            });
            selectCompany(); 
    }
    function cancel(id){
        if (confirm("登録を取り消しますか?") == true) {
            $.post(
                    "{{ route('transportToSlaughterHouses.list')}}",
                    {'ox_id':id,'acceptedDateSlaughterHouse':'1900-01-01'},
                    function( data ){
                        $('#content').html( data );
                    },

                )
                .fail(function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                });
                selectCompany();
                alert("登録はキャンセルされました。")
        } else {
            return;
        }
    }
    
    function selectCompany(){

        $.post(
           "{{ route('transportToSlaughterHouses.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);

            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }); 
    }
    function status(){
      
        $.post(
           "{{ route('transportToSlaughterHouses.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);
            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }); 
    }
    function initFunction(){
        $.post(
            "{{ route('transportToSlaughterHouses.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);
            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }); 
    }
    initFunction();

</script>

<script>
    $(document).ready(function () {
      
        $('#dtBasicExample1').DataTable();
        $('.dataTables_length').addClass('bs-select');

        var today = getTodayDate();
        var length = document.getElementsByClassName("acceptedDateSlaughterHouse").length;
        for(i = 0; i < length; i ++) {
            document.getElementsByClassName("acceptedDateSlaughterHouse")[i].setAttribute('max', today);
        }

        function getTodayDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            return today;
        }
    });
</script>
@endsection