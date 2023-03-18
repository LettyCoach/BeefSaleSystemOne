@extends('layouts.commonUser')
@section('content')

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

<link rel="stylesheet" href="{{ asset('assets/css/components/datatable.css')}}">
<div class="container mx-auto mt-5 pt-5">
    <h2 class="text-center pt-5 fw-bold">精肉管理（牛の選択と価格の入力)</h2>

    @if($message = Session::get('updateSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('registerSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('deleteSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="panel panel-primary my-4" style="min-height: 500px; overflow-y: auto">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                        style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">番号</th>
                                <th>state</th>
                                <th class="text-center">個体識別番号</th>
                                <th class="text-center">和牛登録名</th>
                                <th class="text-center">生年月日</th>
                                <th class="text-center">性別</th>
                                <th class="text-center">登録</th>
                                <th class="text-center">詳細</th>
                                <th class="text-center">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach($oxen as $ox)
                            <tr>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$counter++}}</span>
                                </td>
                                <td class="text-center">
                                <span class="@if($ox->meats()->count()>0) text-success @endif">@if($ox->meats()->count()>0) 完了 @else 未 @endif</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->name}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌
                                        @endif</span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;openMeatModal({{ $ox->id }})"><i
                                            class="p-2 fa fa-plus" aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('meats.show', $ox->id)}}"><i class="p-2 fa fa-info text-green-700"
                                            aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" id="deleteForm{{$ox->id}}"
                                        action="{{route('meats.destroy',$ox->id)}}" class="inline-block" role="button">
                                        @csrf
                                        @method('delete')
                                        <a onclick="deleteFunction({{$ox->id}})"><i
                                                class="p-2 fas fa-trash"></i></a>

                                        <script>
                                        function deleteFunction(id) {
                                            let text = "本当に削除しますか?";
                                            if (confirm(text) == true) {
                                                event.preventDefault();
                                                document.getElementById('deleteForm' + id).submit();
                                            } else
                                                event.preventDefault();
                                        }
                                        </script>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="meatModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">精肉価格入力</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="">個体識別番号</label>
                            <input type="text" id="oxRegisterId" class="w-full form-control p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="col">
                            <label for="">和牛登録名</label>
                            <input type="text" id="oxName" class="w-full form-control p-2 mt-2 mb-3" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">生年月日</label>
                            <input type="text" id="oxBirth" class="w-full form-control p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="col">
                            <label for="">性別</label>
                            <input type="text" id="oxSex" class="w-full form-control p-2 mt-2 mb-3" disabled />
                        </div>
                    </div>

                    <div class="row">
                        <form action="" id="dataForm" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="ox_id" name='ox_id'>
                            <div class="row">
                                <div class="col">
                                    <p class="text-center">部位</p>
                                </div>
                                <div class="col">
                                    <p class="text-center ml-2 mr-2">重さ</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">値段</p>
                                </div>
                            </div>
                            @foreach($parts as $part)
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" size='12' name="PartName{{$part->id}}" class="form-control"
                                        value="{{$part->name}}" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" size='12' name="Weight{{$part->id}}" class="form-control ml-2 mr-2">
                                </div>
                                <div class="col">
                                    <input type="text" size='12' name="Price{{$part->id}}" class="form-control">
                                </div>
                            </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center ">
                            <button type="button" class="btn btn-primary m-2" style="background-color: #6ea924; border: 0;" onclick="saveAppendInfo()"><i class="fas fa-check"></i> セーブ</button>
                            <button type="button" class="btn btn-secondary m-2" onclick="closeModal()"><i class="fas fa-times"></i> 取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<div class="modal fade" id="successModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="oxIdConfirmModal" class="d-none"></div>
                <h5 class="modal-title" id="staticBackdropLabel">情報ダイアログ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center">正常に更新されました!</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-check"></i> わかった</button>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('assets/js/components/datatable.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    function openMeatModal(id) {
        var sex;
        $.get("{{route('meats.create')}}", {
            'id': id,
        }, function(data) {
            if (data['sex'] == 0) {
                sex = "雌";
            }
            if (data['sex'] == 1) {
                sex = "雄";
            }
            $("#ox_id").val(data['id']);
            $("#oxRegisterId").val(data['registerNumber']);
            $("#oxName").val(data['name']);
            $("#oxBirth").val(data['birthday']);
            $("#oxSex").val(sex);
            $("#meatModal").modal('show');
        });
    }

    function closeModal() {
        $("#meatModal").modal('hide');
        $("#successModal").modal('hide');
    }

    function saveAppendInfo() {

        $.post(
            "{{route('meats.store')}}",
            $('#dataForm').serialize(),
            function(data) {
                if (data.msg == "already register") {
                    $("#meatModal").modal('hide');
                    toastr.warning('すでに登録されています。');
                }else{
                    $("#meatModal").modal('hide');
                    toastr.success('登録に成功しました。');
                }
            });
    }

    function selectPastoral() {
        var pastoralId = $("#selectPastoral").val();
        $.get('../common/oxs/bypastoralId', {
            "pastoralId": pastoralId
        }, function(data) {
            $("#FattenData").html(data);
        });
    }
    </script>
</div>

@if (session('status'))
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
            toastr.warning('アクセス権はありません。');
        })
        
    </script>
@endif
@endsection