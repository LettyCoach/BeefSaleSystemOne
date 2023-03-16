<x-app-layout>
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
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center fw-bold pt-5">屠殺場リスト</h2>
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
        <div class="m-2 rounded-md d-flex justify-content-end">
            <a href="{{ route('slaughterHouses.create') }}" class="btn btn-primary" style="background-color:#f05656;"><i
                    class="fa fa-plus" aria-hidden="true"></i> 添加</a>
        </div>
        <div class="panel panel-primary container mx-auto"  style="min-height: 500px; overflow-y: auto">
            <div class="panel-body">
                <div style="width: 100%; padding-left: -10px;">
                    <div class="table-responsive">
                        <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm"
                            cellspacing="0" style="min-width: 1200px; overflow-x: scroll; width:100%">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i> 取消</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/components/datatable.js') }}"></script>
        <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
        </script>
        <script type="text/javascript">
        function showConfirmModal(id) {
            $('#confirmModal').modal('show');
            $('#slaughterHouse_id').html(id);
        }

        function trashSlaughterHouse() {
            id=$('#slaughterHouse_id').html();
            $('#deleteForm'+id).submit();
            $('#confirmModal').modal('hide');
        }
        </script>
</x-app-layout>