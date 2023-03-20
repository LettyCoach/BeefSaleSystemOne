@extends('layouts.commonUser')
@section('content')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<div class="mx-auto p-4 pt-5 mt-5">
    <h2 class="text-center mt-5 mb-4 fw-bold">仕入リスト</h2>    
    <div class="container panel panel-primary mx-auto" style="min-height: 500px; overflow-y: auto">
        <div class="d-flex justify-content-between items-center mb-2">
            
        </div>
        <div class="panel-heading d-flex justify-content-between mb-2">
            <div class="rounded-md  ">
                <select name="pageSize" class="form-select" id="pageSize" onchange="getPurchaseList()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="rounded-md">
                <select name="" class="form-select" id="market_id" onchange="getPurchaseList()">
                    <option value="">全て(購入場所)</option>
                    @foreach ($markets as $market)
                        <option value="{{$market->id}}">{{$market->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="rounded-md">
                <select name="" class="form-select" id="transportCompany_id" onchange="getPurchaseList()">
                    <option value="" selected>全て(運送会社)</option>
                    @foreach ($transportCompanies as $transportCompany)
                        <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="rounded-md d-flex align-items-center">
                <input type="date" id="startDate" class="form-control" onchange="getPurchaseList()" value="{{$startDate}}">
                <label for="" class="mx-2">~</label>
                <input type="date" id="endDate" class="form-control" onchange="getPurchaseList()" value = "{{date('Y-m-d')}}"> 
            </div>
            <div class="rounded-md">
                <select name="" class="form-select" id="pastoral_id" onchange="getPurchaseList()">
                    <option value="" selected>全て(搬送先)</option>
                    @foreach ($pastorals as $pastoral)
                        <option value="{{$pastoral->id}}">{{$pastoral->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class=" ">
                <div class="rounded-md">
                    <a type="button" href="{{ route('purchases.create') }}" class="btn btn-success" style="background-color: #f05656; border: 0;"><i class="fa fa-plus"></i> 添加</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive" id="purchaseData">
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="oxIdConfirmModal" class="d-none"></div>
                <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center">本当に削除しますか？</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;" onclick="trashPurchase()"><i class="fas fa-check"></i> いいよ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> 取消</button>
            </div>
        </div>
    </div>
</div>
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('assets/js/common/purchase.js')}}"></script>
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

@if($message = Session::get('updateSuccess'))
    <script>
        toastr.success("{{$message}}");
    </script>
    @endif @if($message = Session::get('registerSuccess'))
    <script>
        toastr.success("{{$message}}");
    </script>
    @endif @if($message = Session::get('deleteSuccess'))
    <script>
        toastr.success("{{$message}}");
    </script>
    @endif @if($message = Session::get('deleteError'))
    <script>
        toastr.warning("{{$message}}");
    </script>
    @endif
@endsection