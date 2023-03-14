@extends('layouts.commonUser')
@section('content')

<script src="{{ asset('assets/js/common/fatten.js') }}"></script>
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

<div class="mx-auto p-4 pt-5 mt-5">
    <h2 class="text-center font-bold mt-5 fw-bold">肥育（牛の生育状況の登録）</h2>
    <div class="container panel panel-primary" style="margin: 50px;">
        <div class="panel-heading">
            <div class="d-flex justify-content-end items-center mb-2">
                <div class="rounded-md">
                    <select name="selectPastoral" class="form-select" id="selectPastoral" onchange="selectPastoral()">
                        <option value="0">全て</option>
                        @foreach($Pastorals as $Pastoral)
                        <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                        style="min-width: 1000px; width: 100%; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th>個体識別番号</th>
                                <th>和牛登録名</th>
                                <th>生年月日</th>
                                <th>性別</th>
                                <th>記載</th>
                            </tr>
                        </thead>
                        <tbody id="FattenData">
                            @foreach ($oxen as $ox)
                            <tr>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->name}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                                </td>
                                <td>
                                    <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all"><a
                                            href="javascript:;descriptionModal({{ $ox->id }})"
                                            class="text-sm">記入</a></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">生育状況の登録</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
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


<div class="mx-auto p-4 pt-5 mt-5">
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal1">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <p id="oxId" class="hidden"></p>
                    <div class="d-flex">
                        <div class="d-flex flex-col w-1/2 pr-1">
                            <p>個体識別番号</p>
                            <input type="text" id="oxRegisterId" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="d-flex flex-col w-1/2 pl-1">
                            <p>和牛登録名</p>
                            <input type="text" id="oxName" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-col w-1/2 pr-1">
                            <p>生年月日</p>
                            <input type="text" id="oxBirth" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                        <div class="d-flex flex-col w-1/2 pl-1">
                            <p>性別</p>
                            <input type="text" id="oxSex" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
                        </div>
                    </div>
                    <label>新規登録</label>
                    <textarea name="" class="w-full bg-gray-100 p-2 mt-2 mb-3" id="appendInfo" cols="30"
                        rows="5"></textarea>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"
                        onclick="saveAppendInfo()"><i class="fas fa-plus"></i> セーブ</button>
                    <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
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
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-4xl">正常に更新されました!</h2>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-gray-700 mr-2"
                        onclick="closeModal()"><i class="fas fa-check"></i> いいよ</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endsection