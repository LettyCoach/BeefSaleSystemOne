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
    <div class="alert alert-success alert-dismissible container mx-autoss">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    
    <div class="container panel panel-primary container mx-auto" style="margin: 50px;">
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
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1200px; overflow-x: scroll; width:100%">
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
                                <td>
                                    <span class="text-gray-800 break-all">{{$counter++}}</span>
                                </td>
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
                                    <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌
                                        @endif</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->market->name}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->purchaseTransportCompany->name}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 break-all">{{$ox->purchasePrice}}</span>
                                </td>

                                <td>
                                    <a href="{{route('purchases.edit', $ox)}}" class="p-2 text-center">
                                        <i class="fas fa-edit text-green-700" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" id="deleteForm" action="{{route('purchases.destroy',$ox->id)}}">
                                        @csrf
                                        @method('delete')
                                        <a href="" onclick="deleteFunction()" class="p-2 mx-auto">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <script>
                                            function deleteFunction() {
                                                let text = "本当に削除しますか?";
                                                if (confirm(text) == true) {
                                                    event.preventDefault();
                                                    document.getElementById('deleteForm').submit();
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
</div>

<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endsection