<x-app-layout>
    <div class="container mt-5 pt-5 mb-4" style="min-height: calc(100vh - 350px)">
        <nav aria-label="breadcrumb" class="mt-4 pt-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">屠殺場</li>
            </ol>
        </nav>
        <h2 class="text-center fw-bold">屠殺場リスト</h2>
        <div class="container d-flex justify-content-between mt-4 mb-2 p-0">
            <div class="rounded">
                <select name="" id="pageSize" class="form-select" onchange="getSlaughtersList()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="rounded">
                <input type="text" class="form-control" id="slaughterHouseName" placeholder="屠殺場名" onkeyup="getSlaughtersList()">
            </div>
            <div class="rounded">
                <input type="text" class="form-control" id="slaughterHousePosition" placeholder="屠殺場場所" onkeyup="getSlaughtersList()">
            </div>
            <div class="rounded">
                <a href="{{ route('slaughterHouses.create') }}" class="btn btn-primary" style="background-color:#f05656;">
                    <i class="fa fa-plus" aria-hidden="true"></i> 追加
                </a>
            </div>
        </div>
        <div class="panel panel-primary container mx-auto p-0">
            <div class="panel-body">
                <div class="table-responsive" id="slaughterHousesList">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="slaughterHouse_id" class="d-none"></div>
                    <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">本当に削除しますか？</h2>
                    <p class="text-center">この食肉処理場のすべてのデータを失う可能性があります</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                        onclick="trashSlaughterHouse()"><i class="fas fa-check"></i> はい</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i>
                        取消</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/admin/slaughterHouseMana.js') }}"></script>

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
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

    @if($message = Session::get('updateSuccess'))
    <script>
        toastr.success('{{ $message }}');
    </script>
    @endif @if($message = Session::get('registerSuccess'))
    <script>
        toastr.success('{{ $message }}');
    </script>
    @endif @if($message = Session::get('deleteSuccess'))
    <script>
        toastr.success('{{ $message }}');
    </script>
    @endif
</x-app-layout>