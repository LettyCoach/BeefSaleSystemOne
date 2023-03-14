@extends('layouts.commonUser')
@section('content')
<h2 class="text-center text-3xl font-bold mt-4 mb-4">運送（買った牛を運び込みと積み下ろしの報告）</h2>
<div class="max-w-6xl mx-auto flex justify-center navbar">

<div class="panel mt-5 pt-5" style="margin:0 50px">
    <h2 class="text-center font-bold mt-5 fw-bold">仕入リスト</h2>
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
        if($('#loadDate'+id).val() == ""){
         
            return ;
        }
            
        if(confirm("登録してもよろしいですか？") == true){
            
                $.post(
                "{{ route('transports.list')}}",
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
            alert("正常に登録されました。")
        }else{
            return;
        }
        
    }
    function cancel(id){
        if (confirm("登録を取り消しますか?") == true) {
            $.post(
                    "{{ route('transports.list')}}",
                    {'ox_id':id,'loadDate':'1900-01-01'},
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
    
    function unloadDateregister(id){
        if($('#unloadDate'+id).val() == ""){
         
            return ;
        }
            
        if(confirm("登録してもよろしいですか？") == true){
            
                $.post(
                "{{ route('transports.list')}}",
                $('#unloadDateForm'+id).serialize(),
                function( data ){
                    alert(data)
                    $('#content').html( data );
                },

            )
            .fail(function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
            });
            selectCompany();
            alert("正常に登録されました。")
        }else{
            return;
        }
        
    }
    function unloadDatecancel(id){
        if (confirm("登録を取り消しますか?") == true) {
            $.post(
                    "{{ route('transports.list')}}",
                    {'ox_id':id,'unloadDate':'1900-01-01'},
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
           "{{ route('transports.list')}}",
            $('#navForm').serialize(),
            //data:"SelectCompany=8 & statu=1",
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
           "{{ route('transports.list')}}",
            $('#navForm').serialize(),
            //data:"SelectCompany=8 & statu=1",
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
            "{{ route('transports.list')}}",
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
    
        function verifyFunction(){
            var date = new Date();
            var month = (date.getMonth()+1)<10 ? '0'+(date.getMonth()+1): (date.getMonth()+1)
            var day = date.getDate()<10 ? '0'+date.getDate() :date.getDate()
	        var current_date = date.getFullYear()+"-"+month+"-"+day;
            var select_date = $('#loadDate').val();
            if(select_date > current_date){
                toastr.warning('日付入力時にエラーが発生しました。<br>もう一度お試しください。');
                event.preventDefault();
                return;
            }
        }
    
</script>

<link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/common/ship.js') }}"></script>

    <script>
        $(document).ready(function () {
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }
        });
    </script>
@endsection