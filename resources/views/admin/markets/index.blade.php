<x-app-layout>
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center fw-bold pt-5">市場情報リスト</h2>
        <div class="m-2 p-1 rounded-md d-flex justify-content-end">
            <a href="{{ route('markets.create') }}" class="btn btn-primary" style="background-color:#f05656;">
                <i class="fa fa-plus" aria-hidden="true"></i> 添加
            </a>
        </div>

        <div class="panel panel-primary container mx-auto" style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="" class="table table-striped table-fixed table-bordered"
                        cellspacing="0" style="min-width: 1000px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">番号</th>
                                <th class="text-center">名前</th>
                                <th class="text-center">場所</th>
                                <th class="text-center">メモ</th>
                                <th class="text-center">時間</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach ($markets as $market)
                            <tr>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{ $counter++;}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{ $market->name }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{ $market->position }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 break-all">{{ $market->note }}</span>
                                </td>
                                <td class="text-center">
                                    <small class="ml-2 break-all text-gray-600">{{ $market->created_at->format('Y-m-d') }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('markets.edit', $market)}}" class="p-2"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" id="deleteForm{{$market->id}}"
                                        action="{{ route('markets.destroy', $market) }}" class="inline-block ">
                                        @csrf
                                        @method('delete')
                                        <a href="javascript:;showConfirmModal({{$market->id}})">
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
    })
</script>
        <script type="text/javascript">
        function showConfirmModal(id) {
            $('#confirmModal').modal('show');
            $('#market_id').html(id);
        }

        function trashMarket() {
            id = $('#market_id').html();
            $('#deleteForm' + id).submit();
            $('#confirmModal').modal('hide');
        }
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