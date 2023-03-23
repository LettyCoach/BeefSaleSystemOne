<x-app-layout>
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center fw-bold pt-5">市場情報リスト</h2>
        <div class="d-flex justify-content-between mt-4 mb-2">
            <div class="rounded">
                <select name="" id="pageSize" class="form-select" onchange="getMarketsList()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="rounded">
                <input type="text" class="form-control" id="marketName" placeholder="市場名" onkeyup="getMarketsList()">
            </div>
            <div class="rounded">
                <input type="text" class="form-control" id="marketPosition" placeholder="市場場所" onkeyup="getMarketsList()">
            </div>
            <div class="rounded">
                <a href="{{ route('markets.create') }}" class="btn btn-primary" style="background-color:#f05656;">
                    <i class="fa fa-plus" aria-hidden="true"></i> 添加
                </a>
            </div>
        </div>

        <div class="panel panel-primary container mx-auto p-0" style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div class="table-responsive" id="marketsList">
                    
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="market_id" class="d-none"></div>
                        <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">本当に削除しますか？</h2>
                        <p class="text-center">このマーケットで購入したすべての素材を失う可能性があります。</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                            onclick="trashMarket()"><i class="fas fa-check"></i> いいよ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i> 取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('assets/js/admin/marketMana.js') }}"></script>

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