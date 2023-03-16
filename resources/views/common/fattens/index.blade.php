@extends('layouts.commonUser')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/components/datatable.css')}}">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>

<div class="mx-auto p-4 pt-5 mt-5" >
    <h2 class="text-center font-bold mt-5 fw-bold">肥育（牛の生育状況の登録）</h2>
    <div class="container panel panel-primary mx-auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-end items-center mb-2">
                <div class="rounded-md">
                    <select name="selectPastoral" class="form-select" id="selectPastoral" onchange="getOxListByPastoral()">
                        <option value="0">全て(牧場)</option>
                        @foreach($Pastorals as $Pastoral)
                        <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body" style="min-height: 500px; overflow-y: auto">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive" id="FattenData">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">生育状況の登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="oxId" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" id="oxRegisterId" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" id="oxName" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">生年月日</label>
                        <input type="text" id="oxBirth" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">性別</label>
                        <input type="text" id="oxSex" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">新規登録</label>
                        <textarea name="" id="appendInfo" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #6ea924; border: 0;" onclick="saveAppendInfo()"><i class="fa fa-check"></i> セーブ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> 閉じる</button>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script src="{{ asset('assets/js/common/fatten.js') }}"></script>
@endsection