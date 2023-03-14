@extends('layouts.commonUser')
@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
    <h2 class="text-center text-3xl font-bold mt-4 mb-4">精肉管理（牛の選択と価格の入力)</h2>

    @if($message = Session::get('updateSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    @if($message = Session::get('registerSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif

    @if($message = Session::get('deleteSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif

    <div class="max-w-7xl flex justify-between items-center">
        <div class="rounded-md">

            <!-- <i class="fa fa-plus" style="color:white"></i> -->
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-full m-auto text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 ">番号</th>
                                <th scope="col" class="px-6 py-4 ">個体識別番号</th>
                                <th scope="col" class="px-6 py-4 ">和牛登録名</th>
                                <th scope="col" class="px-6 py-4 ">生年月日</th>
                                <th scope="col" class="px-6 py-4 ">性別</th>
                                <th scope="col" class="py-4 w-10">登録</th>
                                <th scope="col" class="py-4 w-10">詳細</th>
                                <th scope="col" class="py-4 w-10">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach ($oxen as $ox)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
                                <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                    <span class="text-gray-800 break-all">{{$counter++}}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                    <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
                                </td>
                                <td class="hitespace-nowrap px-6 py-2 font-medium ">
                                    <span class="text-gray-800 break-all">{{$ox->name}}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                                    <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                                    <small class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌
                                        @endif</small>
                                </td>
                                <td  class="whitespace-nowrap py-2 font-medium text-center">
                                <a href="javascript:;openMeatModal({{ $ox->id }})"><i class="p-2 fa fa-floppy-o text-green-700" aria-hidden="true"></i></a>
                                </td>
                                <td  class="whitespace-nowrap  py-2 font-medium text-center ">
                                <a href="{{route('meats.show', $ox->id)}}" ><i class="p-2 fa fa-info text-green-700" aria-hidden="true"></i></a>
                                </td >
                                <td class="whitespace-nowrap py-2 font-medium w-10">
                                    <form method="POST" id="deleteForm{{$ox->id}}" action="{{route('meats.destroy',$ox->id)}}"
                                        class="inline-block p-2">
                                        @csrf
                                        @method('delete')
                                       
                                        
                                        <a  onclick="deleteFunction({{$ox->id}})" ><i class="p-2 fas fa-trash text-red-700"></i></a>
                                        
                                        <script>
                                        function deleteFunction(id) {
                                            let text = "本当に削除しますか?";
                                            if (confirm(text) == true) {
                                                event.preventDefault();
                                                document.getElementById('deleteForm'+id).submit();
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
                    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="meatModal">
                        <div
                            class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-900 opacity-75" />
                            </div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="d-flex">
                                        <div class="d-flex flex-col w-1/2 pr-1" >
                                            <p>個体識別番号</p>
                                            <input type="text" id="oxRegisterId"
                                                class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled/>
                                        </div>
                                        <div class="d-flex flex-col w-1/2 pl-1">
                                            <p>和牛登録名</p>
                                            <input type="text" id="oxName" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex flex-col w-1/2 pr-1">
                                            <p>生年月日</p>
                                            <input type="text" id="oxBirth" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled/>
                                        </div>
                                        <div class="d-flex flex-col w-1/2 pl-1">
                                            <p>性別</p>
                                            <input type="text" id="oxSex" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled/>
                                        </div>
                                    </div>
                                    <div class="d-flex flex flex-col ">
                                        <form action="" id="dataForm" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" id="ox_id" name='ox_id'>
                                        <div class="w-full flex flex-row mb-2 ">
                                            <p class="w-1/3 text-center">部位</p><p class="w-1/3 text-center ml-2 mr-2">重さ</p><p class="w-1/3 text-center">値段</p>
                                        </div>
                                        @foreach($parts as $part)
                                        <div class="w-full flex flex-row mb-2">
                                            <input type="text" name="PartName{{$part->id}}" class="w-1/3" value="{{$part->name}}" onkeydown="return false" >
                                            <input type="text" name="Weight{{$part->id}}" class="w-1/3 ml-2 mr-2">
                                            <input type="text" name="Price{{$part->id}}" class="w-1/3" >
                                        </div>
                                        @endforeach
                                        </form>
                                  </div>
                                </div>
                                <div class="bg-gray-200 px-4 py-3 text-right">
                                    <button type="button"
                                        class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"
                                        onclick="saveAppendInfo()"><i class="fas fa-plus"></i> セーブ</button>
                                    <button type="button"
                                        class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                                        onclick="closeModal()"><i class="fas fa-times"></i> 取消</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="successModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-4xl">正常に更新されました!</h2>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-gray-700 mr-2" onclick="closeModal()"><i class="fas fa-check"></i> いいよ</button>
                </div>
            </div>
        </div>
    </div>
                    <script>
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
                            $("#meatModal").fadeIn();
                        });
                    }

                    function closeModal() {
                        $("#meatModal").fadeOut();
                        $("#successModal").fadeOut();
                    }

                    function saveAppendInfo() {
                                                
                        $.post(
                            "{{route('meats.store')}}",                             
                            $('#dataForm').serialize(),
                         function(data) {
                            if(data.msg=="register"){
                                alert("already registerd");
                                $("#meatModal").fadeOut();
                            }                                
                            $("#successModal").fadeIn();  
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
            </div>
        </div>
    </div>

</div>
@endsection