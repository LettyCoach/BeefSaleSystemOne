@extends('layouts.commonUser')
@section('content')
<div class="mt-5 pt-5 container mx-auto">
    <h2 class="text-center pt-5 fw-bold">屠殺（牛の価格の報告）</h2>
    <div class="panel-body d-flex justify-content-between">
        <div class="rounded-md  ">
            <select name="pageSize" class="form-select" id="pageSize" onchange="slaughterList()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="rounded-md ">
            <select name="slaughterState" class="form-select" id="slaughterState" onchange="slaughterList()">
                <option value="">全て(状態)</option>
                <option value="1">完了</option>
                <option value="0">未</option>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <div class="rounded-md">
                <select name="SlaughterHouse" id="SlaughterHouse" class="form-select mb-2" onchange="slaughterList()">
                    <option value="">全て(屠殺場)</option>
                    @foreach($slaughterHouses as $slaughterHouse)
                    <option value="{{$slaughterHouse->id}}">{{$slaughterHouse->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="mt-2 mb-4">
    <div class="panel panel-primary container mx-auto" style="min-height: 500px; overflow-y: auto">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive"  id="slaughterList">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/common/slaughterList.js')}}"></script>
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
        })
    </script>
@if (session('status'))
<script>
    $(document).ready(function(){
        toastr.warning('アクセス権はありません。');
    })
</script>
@endif
@endsection