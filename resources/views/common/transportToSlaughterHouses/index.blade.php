@extends('layouts.commonUser')
@section('content')

<div class="container mx-auto mt-5 pt-5">
    <h2 class="mt-5 text-center mb-4">運搬（運送済みの牛の報告）</h2>
    <form action="navForm" id="navForm" method="post" class="text-center mb-2">
        @csrf
        <div class="">
            <label for="SelectCompany">運送会社選択</label>
            <select name="SelectCompany" id="SelectCompany" onchange="selectCompany()">
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
@endsection