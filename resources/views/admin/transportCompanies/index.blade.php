<x-app-layout>
    <div class="container mt-5 pt-5 mb-4">
        <h2 class="text-center mt-5 fw-bold">運送会社リスト</h2>
        <div class="m-2 rounded-md d-flex justify-content-end">
            <a href="{{ route('transportCompanies.create') }}" class="btn btn-primary">{{ __('添加') }}</a>
        </div>
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
                                @foreach ($transportCompanies as $transportCompany)
                                <tr>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $counter++;}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $transportCompany->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $transportCompany->position }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 break-all">{{ $transportCompany->note }}</span>
                                    </td>
                                    <td class="text-center">
                                        <small
                                            class="ml-2 break-all text-gray-600">{{ $transportCompany->created_at->format('j M Y, g:i a') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('transportCompanies.edit', $transportCompany)}}" class="p-2"><i
                                                class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" id="deleteForm"
                                            action="{{ route('transportCompanies.destroy', $transportCompany) }}"
                                            class="inline-block ">
                                            @csrf
                                            @method('delete')
                                            <a href="" onclick="deleteFunction()">
                                                <i class="fa fa-trash"></i>
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
        <script src="{{ asset('assets/js/components/datatable.js') }}"></script>
        <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
        </script>
</x-app-layout>