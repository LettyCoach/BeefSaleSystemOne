@extends('layouts.commonUser')
@section('content')
<div class="mx-auto p-4 pt-5 mt-5">
    <h2 class="text-center mt-5 mb-4 fw-bold">運送レポート</h2>    
    <div class="container panel panel-primary mx-auto" style="min-height: 500px; overflow-y: auto">
        <div class="panel-heading d-flex justify-content-between mb-2">
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive" id="transportToSlaughterHouseReportData">
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/common/transportToSlaughterHouseReport.js')}}"></script>
@endsection