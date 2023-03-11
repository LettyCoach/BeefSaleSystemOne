@extends('layouts.commonUser')
@section('content')

<div class="max-w-6xl mx-auto py-12 flex justify-center navbar">
    <form action="navForm" id="navForm" method="post" class="flex">
        @csrf
        <div class="">
            <label for="SelectCompany">運送会社選択</label>
            <select name="SelectCompany" id="SelectCompany" onchange="selectCompany()">
                @foreach($transportCompanies as $transportCompany)
                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- <div class="ml-4">
            <label for="Statu">活動</label>
            <select name="statu" id="statu" onchange="status()">
                <option value="0">全て</option>
                <option value="1">未</option>
                <option value="2">完了</option>
            </select>
        </div> -->
    </form>
</div>
<div class="max-w-6xl m-auto flex flex-col mt-6 justify-center" id="content">
    

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