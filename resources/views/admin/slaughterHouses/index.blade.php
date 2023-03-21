<x-app-layout>
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center fw-bold pt-5">屠殺場リスト</h2>
<<<<<<< HEAD
        <div class="d-flex justify-content-between mt-4 mb-2">
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
                    <i class="fa fa-plus" aria-hidden="true"></i> 添加
                </a>
            </div>
        </div>
        <div class="panel panel-primary container mx-auto p-0" style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div class="table-responsive" id="slaughterHousesList">
                    
=======
        <div class="m-2 rounded-md d-flex justify-content-end">
            <a href="{{ route('slaughterHouses.create') }}" class="btn btn-primary" style="background-color:#f05656;"><i
                    class="fa fa-plus" aria-hidden="true"></i> 添加</a>
        </div>
        <div class="panel panel-primary container mx-auto"  style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div style="width: 100%; padding-left: -10px;">
                    <div class="table-responsive">
                        <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm"
                            cellspacing="0" style="min-width: 1000px; overflow-x: scroll; width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
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
                                @foreach ($slaughterHouses as $slaughterHouse)
                                <tr>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $counter++;}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $slaughterHouse->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $slaughterHouse->position }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $slaughterHouse->note }}</span>
                                    </td>
                                    <td class="text-center">
                                        <small
                                            class="ml-2 break-all text-gray-600">{{ $slaughterHouse->created_at->format('j M Y, g:i a') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('slaughterHouses.edit', $slaughterHouse)}}" class="p-2"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" id="deleteForm{{$slaughterHouse->id}}"
                                            action="{{ route('slaughterHouses.destroy', $slaughterHouse) }}" class="inline-block ">
                                            @csrf
                                            @method('delete')
                                            <a href="javascript:;showConfirmModal({{$slaughterHouse->id}})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
>>>>>>> 8de6edcb09f1a5696c984189c3798094a3a7ad88
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                        onclick="trashSlaughterHouse()"><i class="fas fa-check"></i> いいよ</button>
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