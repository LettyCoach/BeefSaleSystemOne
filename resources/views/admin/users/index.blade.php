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
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/components/datatable.css')}}">
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center fw-bold pt-5">利用者管理</h2>
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

        <div class="panel panel-primary container mx-auto" style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div style="width: 100%; padding-left: -10px;">
                    <div class="table-responsive">
                        <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm"
                            cellspacing="0" style="min-width: 1000px; overflow-x: scroll; width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">番号</th>
                                    <th class="text-center">名前</th>
                                    <th class="text-center">Eメール</th>
                                    <th class="text-center">権限設定</th>
                                    <th class="text-center">削除</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $counter++;}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all" id = "userName{{ $user->id }}">{{ $user->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all" id = "userEmail{{ $user->id }}">{{ $user->email }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">
                                            <a href="javascript:;showAddRoleModal({{ $user->id }})"><i class="fa fa-plus"></i></a>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" id="deleteForm{{$user->id}}"
                                            action="{{ route('users.destroy', $user) }}" class="inline-block ">
                                            @csrf
                                            @method('delete')
                                            <a href="javascript:;showConfirmModal({{$user->id}})">
                                                <i class="fa fa-trash"></i>
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
        
        <div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="user_id" class="d-none"></div>
                        <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">本当に削除しますか？</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                            onclick="trashuser()"><i class="fas fa-check"></i> いいよ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i> 取消</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addRoleModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="userIdAddModal" class="d-none"></div>
                        <h5 class="modal-title" id="staticBackdropLabel">ユーザー権限設定</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <span class="form-control" id="userNameAddModal"></span>
                            </div>
                            <div class="col-lg-6">
                                <span class="form-control" id="userEmailAddModal"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="purchase">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Purchase
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="transport">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Transport
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="fatten">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Fatten
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="ship">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ship
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="slaughter">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Slaughter
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="" id="meat">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Meat
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;" onclick="storeUserRole()">
                            <i class="fas fa-check"></i> 設定
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> 取消</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/components/datatable.js') }}"></script>
        <script src="{{ asset('assets/js/admin/userMana.js') }}"></script>
    </div>
</x-app-layout>