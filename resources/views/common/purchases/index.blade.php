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

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<div class="mx-auto p-4 pt-5 mt-5">
    <h2 class="text-center mt-5 fw-bold">仕入リスト</h2>
    
    @if($message = Session::get('updateSuccess'))
    <div class="alert alert-success alert-dismissible container mx-auto">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('registerSuccess'))
    <div class="alert alert-success alert-dismissible container mx-auto">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('deleteSuccess'))
    <div class="alert alert-success alert-dismissible container mx-auto">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('deleteError'))
    <div class="alert alert-warning alert-dismissible container mx-auto">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    
    <div class="container panel panel-primary mx-auto" style="min-height: 500px; overflow-y: auto">
        <div class="panel-heading">
            <div class="d-flex justify-content-end items-center mb-2">
                <div class="rounded-md">
                    <a type="button" href="{{ route('purchases.create') }}" class="btn btn-success" style="background-color: #f05656; border: 0;"><i class="fa fa-plus"></i> 添加</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
                        <thead >
                            <tr>
                                <th class="text-center">番号</th>
                                <th class="text-center">個体識別番号</th>
                                <th class="text-center">和牛登録名</th>
                                <th class="text-center">生年月日</th>
                                <th class="text-center">性別</th>
                                <th class="text-center">購入場所</th>
                                <th class="text-center">運送会社</th>
                                <th class="text-center">搬送先</th>
                                <th class="text-center">購入金額</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach ($oxen as $ox)
                            <tr>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$counter++}}</span>
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
                                    <span class="text-gray-800 break-all">{{$ox->market->name}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->purchaseTransportCompany->name}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{$ox->purchasePrice}}</span>
                                </td>

                                <td class="text-center">
                                    <a href="{{route('purchases.edit', $ox)}}" class="p-2 text-center">
                                        <i class="fas fa-edit text-green-700" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" id="deleteForm{{ $ox->id }}" action="{{route('purchases.destroy',$ox->id)}}">
                                        @csrf
                                        @method('delete')
                                        <a href="javascript:;showConfirmModal({{ $ox->id }})" class="p-2 mx-auto">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>
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

<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
<script type="text/javascript">
    window.onload = function() {
        var today = getTodayDate();
        document.getElementById("inline-birthday").setAttribute('max', today);
    }
    function getTodayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        return today;
    }
    function showConfirmModal(id) {
        $('#confirmModal').modal('show');
        $('#oxIdConfirmModal').html(id);
    }

    function trashPurchase() {
        var id = $('#oxIdConfirmModal').html();
        $('#deleteForm' + id).submit();
    }
</script>
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