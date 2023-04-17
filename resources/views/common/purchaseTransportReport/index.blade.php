@extends('layouts.commonUser')
@section('content')
<div class="mx-auto p-4 pt-5 mt-5">
    <div class="container panel panel-primary mx-auto" style="min-height:calc(100vh - 350px)">
        <nav aria-label="breadcrumb" class="mt-4 pt-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">仕入輸送レポート</li>
            </ol>
        </nav>
        <h2 class="text-center mb-4 fw-bold">仕入輸送レポート</h2> 
        <div class="panel-heading d-flex justify-content-between mb-2">
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <div class="container mt-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home">牧場統計資料</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#menu1">運送会社統計資料</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#menu2">市場統計資料</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#menu3">日付統計資料</a>
                          </li>
                        </ul>
                      
                        <!-- Tab panes -->
                        <div class="tab-content" id="purchaseTransportReportData">
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/common/purchaseTransportReport.js')}}"></script>
@endsection