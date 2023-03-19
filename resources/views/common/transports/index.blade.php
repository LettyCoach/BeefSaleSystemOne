@extends('layouts.commonUser')
@section('content')
<div class="mx-auto p-4 pt-5 mt-5" >
    <h2 class="text-center font-bold mt-5 fw-bold">運送(買った牛を運び込みと積み下ろしの報告)</h2>
    <div class="container panel panel-primary mx-auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-between items-center mb-2 mt-4">
                <div class="rounded-md">
                    <select name="pageSize" class="form-select" id="pageSize" onchange="getPurchaseTransportList()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="transportCompany" class="form-select" id="transportCompany" onchange="getPurchaseTransportList()">
                        <option value="0">全て(運送会社)</option>
                        @foreach($TransportCompanies as $TransportCompany)
                        <option value="{{$TransportCompany->id}}">{{ $TransportCompany->name }}</option>
                        @endforeach
                    </select>
                </div>    
                <div class="rounded-md d-flex justify-content-center align-items-center">
                    <input type="date" name="" id="firstDate" class="form-control form-input-disable" onchange="getPurchaseTransportList()" value="{{ $firstDate }}">
                    <label for="" class="mx-2">~</label>
                    <input type="date" name="" id="lastDate" class="form-control form-input-disable" onchange="getPurchaseTransportList()" value="{{ $todayDate }}">
                </div>
                <div class="rounded-md">
                    <select name="pastoral" class="form-select" id="pastoral" onchange="getPurchaseTransportList()">
                        <option value="0">全て(牧場)</option>
                        @foreach($Pastorals as $Pastoral)
                        <option value="{{ $Pastoral->id }}">{{ $Pastoral->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="loadType" class="form-select" id="loadType" onchange="getPurchaseTransportList()">
                        <option value="0">積み込み</option>
                        <option value="1">積み下ろし</option>
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="loadState" class="form-select" id="loadState" onchange="getPurchaseTransportList()">
                        <option value="0">全て(状態)</option>
                        <option value="1">未</option>
                        <option value="2">完了</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div style="min-height: calc(100vh - 400px);">
                <div class="table-responsive" id="purchaseTransportData">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PurchaseTransLoadModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">積み込み状態登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="OxIdLoadModal" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" name="" class="form-control" id="OxRegisterNumberLoadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" name="" class="form-control" id="OxNameLoadModal" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">購入場所</label>
                        <input type="text" name="" class="form-control" id="MarketNameLoadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">運送会社</label>
                        <input type="text" name="" class="form-control" id="TransportNameLoadModal" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">搬送先</label>
                        <input type="text" name="" class="form-control" id="PastoralNameLoadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">積み込み日</label>
                        <input type="date" id="LoadDate" class="form-control rounded" value="{{$todayDate}}" placeholder="" />
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #6ea924;" onclick="registerDate('load')"><i class="fa fa-check"></i> セーブ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    閉じる</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="PurchaseTransUnloadModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">積み下ろし状態登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="OxIdUnloadModal" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" name="" class="form-control" id="OxRegisterNumberUnloadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" name="" class="form-control" id="OxNameUnloadModal" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">購入場所</label>
                        <input type="text" name="" class="form-control" id="MarketNameUnloadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">運送会社</label>
                        <input type="text" name="" class="form-control" id="TransportNameUnloadModal" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">搬送先</label>
                        <input type="text" name="" class="form-control" id="PastoralNameUnloadModal" disabled>
                    </div>
                    <div class="col">
                        <label for="">積み込み日</label>
                        <input type="date" id="UnloadDate" class="form-control rounded" value="{{$todayDate}}" placeholder="" />
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #6ea924;" onclick="registerDate('unload')"><i class="fa fa-check"></i> セーブ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    閉じる</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="PurchaseTransViewModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">購入輸送情報詳細を見る</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" name="" class="form-control" id="OxRegisterNumberInfo" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" name="" class="form-control" id="OxNameInfo" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">生年月日</label>
                        <input type="text" name="" class="form-control" id="OxBirthInfo" disabled>
                    </div>
                    <div class="col">
                        <label for="">性別</label>
                        <input type="text" name="" class="form-control" id="OxSexInfo" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="">購入場所</label>
                        <input type="text" name="" class="form-control" id="MarketNameInfo" disabled>
                    </div>
                    <div class="col-4">
                        <label for="">運送会社</label>
                        <input type="text" name="" class="form-control" id="TransportCompanyNameInfo" disabled>
                    </div>
                    <div class="col-4">
                        <label for="">搬送先</label>
                        <input type="text" name="" class="form-control" id="PastoralNameInfo" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">積み込み状態</label>
                        <input type="text" name="" class="form-control" id="LoadStateInfo" disabled>
                    </div>
                    <div class="col">
                        <label for="">積み込み日</label>
                        <input type="text" id="LoadDateInfo" class="form-control rounded" value="" placeholder="" disabled/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">積み下ろし状態</label>
                        <input type="text" name="" class="form-control" id="UnloadStateInfo" disabled>
                    </div>
                    <div class="col">
                        <label for="">積み下ろし日</label>
                        <input type="text" id="UnloadDateInfo" class="form-control rounded" value="" placeholder="" disabled/>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> 閉じる
                </button>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/js/common/purchaseTransport.js') }}"></script>
@endsection