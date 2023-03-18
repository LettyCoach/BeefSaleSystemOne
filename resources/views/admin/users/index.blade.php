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

        <div class="panel panel-primary container mx-auto" style="min-height: 500px; overflow-y: auto" id="userData">
            
        </div>

        <div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="userIdConfirmModal" class="d-none"></div>
                        <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">本当に削除しますか？</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                            onclick="deleteUser()"><i class="fas fa-check"></i> いいよ</button>
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