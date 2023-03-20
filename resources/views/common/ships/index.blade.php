@extends('layouts.commonUser')
@section('content')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="mx-auto p-4 pt-5 mt-5">
    <h2 class="text-center mt-5 fw-bold">出荷指示</h2>
    <div class="container panel panel-primary mx-auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-between items-center mb-2 mt-4">
                <div class="rounded-md">
                    <select name="pageSize" class="form-select" id="pageSize" onchange="getShipList()">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>    
                <div class="rounded-md">
                    <select name="" class="form-select" id="pastoralId" onchange="getShipList()">
                        <option value="0" selected>全て(牧場)</option>
                        @foreach($Pastorals as $Pastoral)
                        <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="" class="form-select" id="transportCompanyId" onchange="getShipList()">
                        <option value="0" selected>全て(運送会社)</option>
                        @foreach($TransportCompanies as $TransportCompany)
                        <option value="{{$TransportCompany->id}}">{{$TransportCompany->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="rounded-md">
                    <select name="" class="form-select" id="slaughterHouseId" onchange="getShipList()">
                        <option value="0" selected>全て(屠殺場)</option>
                        @foreach($SlaughterHouses as $SlaughterHouse)
                        <option value="{{$SlaughterHouse->id}}">{{$SlaughterHouse->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="rounded-md d-flex justify-content-center align-items-center">
                    <input type="date" name="" id="firstDate" class="form-control form-input-disable" onchange="getShipList()" value="{{ $firstDate }}">
                    <label for="" class="mx-2">~</label>
                    <input type="date" name="" id="lastDate" class="form-control form-input-disable" onchange="getShipList()" value="{{ $todayDate }}">
                </div>
                <button class="rounded btn btn-danger" onclick="showAddShipModal()">
                    <i class="fas fa-plus"></i>&nbsp;
                    出荷指示追加
                </button>
            </div>
        </div>
        <div class="panel-body" style="min-height: 500px; overflow-y: auto">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive" id="shipData">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddShipModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">出荷指示追加</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="oxId" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">牧場選択</label>
                        <select class="form-select rounded" id="pastoralAddShip"
                            onchange="getOxRegisterNumberListByPastoral()">
                            @foreach($Pastorals as $Pastoral)
                            <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="">運送会社選択</label>
                        <select class="form-select rounded" id="transportCompanyAddShip">
                            @foreach($TransportCompanies as $TransportCompany)
                            <option value="{{$TransportCompany->id}}">{{$TransportCompany->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">牛選択</label>
                        <select class="form-select rounded" id="oxRegisterNumberByPastoral" onchange="getOxNameById()">

                        </select>
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" id="oxNameById" class="form-control rounded" disabled />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">日付選択</label>
                        <input type="date" id="exportDateAddShip" class="form-control rounded" value="{{$todayDate}}"
                            placeholder="" />
                    </div>
                    <div class="col">
                        <label for="">行き先選択</label>
                        <select class="form-select rounded" id="slaughterHouseAddShip">
                            @foreach($SlaughterHouses as $SlaughterHouse)
                            <option value="{{$SlaughterHouse->id}}">{{$SlaughterHouse->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #6ea924; border: 0;"
                    onclick="addShip()"><i class="fa fa-check"></i> セーブ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    閉じる</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="EditShipModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">出荷指示追加</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="oxIdEditShip" class="d-none"></p>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">牧場選択</label>
                        <select class="form-select rounded" id="pastoralEditShip"
                            onchange="getOxRegisterNumberListByPastoral()">
                            @foreach($Pastorals as $Pastoral)
                            <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="">運送会社選択</label>
                        <select class="form-select rounded" id="transportCompanyEditShip">
                            @foreach($TransportCompanies as $TransportCompany)
                            <option value="{{$TransportCompany->id}}">{{$TransportCompany->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">牛選択</label>
                        <input type="text" id="oxIdEditModal" class="form-control rounded" disabled />
                    </div>
                    <div class="col">
                        <label for="">和牛登録名</label>
                        <input type="text" id="oxNameEditModal" class="form-control rounded" disabled />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="">日付選択</label>
                        <input type="date" id="exportDateEditShip" class="form-control rounded" value="{{$todayDate}}"
                            placeholder="" />
                    </div>
                    <div class="col">
                        <label for="">行き先選択</label>
                        <select class="form-select rounded" id="slaughterHouseEditShip">
                            @foreach($SlaughterHouses as $SlaughterHouse)
                            <option value="{{$SlaughterHouse->id}}">{{$SlaughterHouse->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #6ea924; border: 0;"
                    onclick="updateShip()"><i class="fa fa-check"></i> セーブ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    閉じる</button>
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
                <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;" onclick="trashShip()"><i class="fas fa-check"></i> いいよ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> 取消</button>
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
    });
</script>

@if (session('status'))
    <script>
        $(document).ready(function(){
            toastr.warning('アクセス権はありません。');
        });
    </script>
@endif

<script src="{{ asset('assets/js/common/ship.js') }}"></script>
@endsection