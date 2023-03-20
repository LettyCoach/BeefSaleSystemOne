@extends('layouts.commonUser')
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="mx-auto p-4 pt-5 mt-5" >
    <h2 class="text-center font-bold mt-5 fw-bold">肥育（牛の生育状況の登録）</h2>
    <div class="container panel panel-primary mx-auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-between items-center mb-2">
                <div class="rounded-md">
                    <select name="pageSize" class="form-select" id="pageSize" onchange="getFattenList()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="selectPastoral" class="form-select" id="selectPastoral" onchange="getFattenList()">
                        <option value="0">全て(牧場)</option>
                        @foreach($Pastorals as $Pastoral)
                        <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div style="min-height: calc(100vh - 400px);">
                <div class="table-responsive" id="FattenData">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="appendAddModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">生育状況の登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="oxIdAddModal" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" id="oxRegisterIdAddModal" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" id="oxNameAddModal" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">生年月日</label>
                        <input type="text" id="oxBirthAddModal" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">性別</label>
                        <input type="text" id="oxSexAddModal" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">新規登録</label>
                        <textarea name="" id="appendInfoAddModal" cols="30" rows="10" class="form-control"></textarea>
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

<div class="modal fade" id="appendViewModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">生育状況の登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="oxIdViewModal" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">個体識別番号</label>
                        <input type="text" id="oxRegisterIdViewModal" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" id="oxNameViewModal" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">生年月日</label>
                        <input type="text" id="oxBirthViewModal" class="form-control" placeholder="First name" aria-label="First name" disabled>
                    </div>
                    <div class="col">
                        <label for="">性別</label>
                        <input type="text" id="oxSexViewModal" class="form-control" placeholder="Last name" aria-label="Last name" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">新規登録</label>
                        <textarea name="" id="appendInfoViewModal" cols="30" rows="10" class="form-control" disabled></textarea>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> 閉じる</button>
            </div>

        </div>
    </div>
</div>

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
        });
    </script>
@endif
<script src="{{ asset('assets/js/common/fatten.js') }}"></script>
@endsection
