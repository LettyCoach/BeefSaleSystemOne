@extends('layouts.commonUser')
@section('content')
<div class="mx-auto p-4 pt-5 mt-5">
    <div class="container panel panel-primary mx-auto" style="min-height:calc(100vh - 350px)">
        <nav aria-label="breadcrumb" class="mt-4 pt-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">出荷レポート</li>
            </ol>
        </nav>
        <h2 class="text-center mb-4 fw-bold">出荷レポート</h2> 
        <div class="panel-heading d-flex justify-content-between mb-2">
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive" id="shipReportData">
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/common/shipReport.js')}}"></script>
@endsection