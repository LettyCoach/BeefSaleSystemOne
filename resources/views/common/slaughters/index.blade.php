@extends('layouts.commonUser')
@section('content')
<div class="mt-5 pt-5 container mx-auto">
    <h2 class="text-center pt-5 fw-bold">屠殺（牛の価格の報告）</h2>
    <form action="navForm" id="navForm" method="post" class="d-flex justify-content-end">
        @csrf
        <div class="rounded-md">
            <select name="SlaughterHouse" id="SlaughterHouse" class="form-select mb-2" onchange="selectSlaughterHouses()">
                @foreach($slaughterHouses as $slaughterHouse)
                <option value="{{$slaughterHouse->id}}">{{$slaughterHouse->name}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<div class="mt-2 mb-4" id="content">
</div>
<script>
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function register(id){
            var slaughterFinishedDate = $('#slaughterFinishedDate'+id).val();
            var acceptedWeight = $('#acceptedWeight'+id).val();
            var acceptedLevel = $('#acceptedLevel'+id).val();
            if($('#acceptedWeight'+id).val()=="")
            {
                alert("重量を設定してください。")
                return ;
            }
            if($('#acceptedLevel'+id).val()=="")
            {
                alert("格付を設定してください")
                return ;
            }   
            if($('#slaughterFinishedDate'+id).val()=="")
            {
                alert("日付を設定してください。")
                return ;
            }   
            $.post(
                "{{ route('slaughters.list')}}",
                {
                    'ox_id':id,
                    'slaughterFinishedDate':slaughterFinishedDate,
                    'acceptedWeight':acceptedWeight,
                    'acceptedLevel':acceptedLevel,
                },
                function( data ){
                   
                    $('#content').html( data );
                },

            )
            .fail(function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
            });
            selectSlaughterHouses();
       
               
    }
    function cancel(id){
        if (confirm("登録を取り消しますか?") == true) {
            $.post(
                    "{{ route('slaughters.list')}}",
                    {'ox_id':id,'slaughterFinishedDate':'1900-01-01'},
                    function( data ){
                        $('#content').html( data );
                    },

                )
                .fail(function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                });
                selectSlaughterHouses();
                alert("登録はキャンセルされました。")
        } else {
            return;
        }
    }
    
    function selectSlaughterHouses(){

        $.post(
           "{{ route('slaughters.list')}}",
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
           "{{ route('slaughters.list')}}",
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
            "{{ route('slaughters.list')}}",
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

@if (session('status'))
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': true,
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
            toastr.warning('アクセス権はありません。');
        })
        
    </script>
@endif
@endsection