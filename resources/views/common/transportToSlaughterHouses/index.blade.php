@extends('layouts.commonUser')
@section('content')

<div class="container mx-auto mt-5 pt-5">
    <h2 class="mt-5 text-center mb-4 fw-bold">運搬（運送済みの牛の報告）</h2>
    <div class="d-flex justify-content-between">
        <div class="rounded-md">
            <select name="pageSize" class="form-select" id="pageSize" onchange="getExportTransportCompanyList()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="rounded-md ">
            <select name="transportState" class="form-select" id="transportState" onchange="getExportTransportCompanyList()">
                <option value="">全て(状態)</option>
                <option value="0">未</option>
                <option value="1">完了</option>
            </select>
        </div>
        
        <div class="rounded-md">
            <select name="pastoral" id="pastoral" class="form-select mb-2" onchange="getExportTransportCompanyList()">
                <option value="">全て(牧場)</option>
                @foreach($pastorals as $pastoral)
                <option value="{{$pastoral->id}}">{{$pastoral->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="rounded-md">
            <select name="SelectCompany" id="SelectCompany" class="form-select mb-2" onchange="getExportTransportCompanyList()">
                <option value="">全て(運送会社)</option>
                @foreach($transportCompanies as $transportCompany)
                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="rounded-md">
            <select name="slaughterHouse" id="slaughterHouse" class="form-select mb-2" onchange="getExportTransportCompanyList()">
                <option value="">全て(屠殺場)</option>
                @foreach($slaughterHouses as $slaughterHouse)
                <option value="{{$slaughterHouse->id}}">{{$slaughterHouse->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="panel panel-primary container mx-auto mb-4" style="min-height: 500px; overflow-y: auto">
    <div class="panel-body">
        <div style="width: 100%; padding-left: -10px;">
            <div class="table-responsive" id="exportTransportCompanyList">
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/common/transportToSlaugterHose.js')}}"></script>
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