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
                                    <small class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌
                                        @endif</small>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;openMeatModal({{ $ox->id }})"><i
                                            class="p-2 fa fa-floppy-o text-green-700" aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('meats.show', $ox->id)}}"><i class="p-2 fa fa-info text-green-700"
                                            aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" id="deleteForm{{$ox->id}}"
                                        action="{{route('meats.destroy',$ox->id)}}" class="inline-block">
                                        @csrf
                                        @method('delete')


                                        <a onclick="deleteFunction({{$ox->id}})"><i
                                                class="p-2 fas fa-trash text-red-700"></i></a>

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
                            <input type="text" id="oxRegisterId" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="col">
                            <label for="">和牛登録名</label>
                            <input type="text" id="oxName" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">生年月日</label>
                            <input type="text" id="oxBirth" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="col">
                            <label for="">性別</label>
                            <input type="text" id="oxSex" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
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
                                    <input type="text" size='12' name="PartName{{$part->id}}" class=""
                                        value="{{$part->name}}" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" size='12' name="Weight{{$part->id}}" class="ml-2 mr-2">
                                </div>
                                <div class="col">
                                    <input type="text" size='12' name="Price{{$part->id}}" class="">
                                </div>
                            </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center ">
                            <button type="button" class="btn btn-primary m-2" onclick="saveAppendInfo()"><i class="fas fa-plus"></i> セーブ</button>
                            <button type="button" class="btn btn-secondary m-2" onclick="closeModal()"><i class="fas fa-times"></i> 取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- The Modal -->
<div class="modal fade" id="successModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-4xl">正常に更新されました!</h2>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="btn btn-primary"
                        onclick="closeModal()"><i class="fas fa-check"></i> いいよ</button>
                </div>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                if (data.msg == "register") {
                    $("#successModal").modal('show');
                    $("#meatModal").modal('hide');
                }else{
                    $("#successModal").modal('show');
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
@endsection