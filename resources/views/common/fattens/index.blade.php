@extends('layouts.commonUser')
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="mx-auto p-4 pt-5 mt-5" >
    <h2 class="text-center font-bold mt-5 fw-bold">肥育（牛の生育状況の登録）</h2>
    <div class="container panel panel-primary mx-auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-between items-center mb-2">
                <div class="rounded-md">
                    <select name="" class="form-select" id="" onchange="getOxListByPastoral()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
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
        <div class="panel-body">
            <div style="min-height: calc(100vh - 400px); overflow-y: auto;">
                <div class="table-responsive">
                    <table id="" class="table table-bordered" style="min-width: 1000px; width: 100%; overflow-x: scroll;">
                        <thead class="bg-light">
                            <tr>
                                <th>番号</th>
                                <th>個体識別番号</th>
                                <th>和牛登録名</th>
                                <th>生年月日</th>
                                <th>性別</th>
                                <th>記載</th>
                            </tr>
                        </thead>
                        <tbody id="FattenData">

                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">2</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
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
