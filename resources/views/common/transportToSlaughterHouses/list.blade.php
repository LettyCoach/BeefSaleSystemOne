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

<div class="panel panel-primary container mx-auto mb-4" style="min-height: 500px; overflow-y: auto">
    <div class="panel-body">
        <div style="width: 100%; padding-left: -10px;">
            <div class="table-responsive">
                <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm"
                    cellspacing="0" style="min-width: 1200px; overflow-x: scroll; width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ステータス</th>
                            <th class="text-center">個体識別番号</th>
                            <th class="text-center">和牛登録名</th>
                            <th class="text-center">生年月日</th>
                            <th class="text-center">性別</th>
                            <th class="text-center">登録日</th>
                            <th class="text-center">登録</th>
                            <th class="text-center">取消</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $counter = 1;
                        @endphp
                        @foreach ($oxen as $ox)
                        <tr>
                        <td><span class="text-gray-800 break-all">{{$counter++}}</span< /td>
                                <td class="text-xs">
                                    <span class="@if($ox->acceptedDateSlaughterHouse != NULL) text-success @endif">@if($ox->acceptedDateSlaughterHouse != NULL) 完了 @else 未 @endif</span>
                                </td>
                                <td><span class="text-gray-800 break-all">{{$ox->registerNumber}}</span< /td>
                                <td><span class="text-gray-800 break-all">{{$ox->name}}</span< /td>
                                <td><span class="text-gray-800 break-all">{{$ox->birthday}}</span< /td>
                                <td>@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
                                <td class="p-1 text-xs">
                                    <form method="post" id="loadDateForm{{$ox->id}}" name="loadDateForm{{$ox->id}}">
                                        @csrf
                                        <input type="hidden" name="ox_id" value="{{$ox->id}}">
                                        <input type="date" name="acceptedDateSlaughterHouse"
                                            id="acceptedDateSlaughterHouse{{$ox->id}}"
                                            value="{{$ox->acceptedDateSlaughterHouse}}">
                                    </form>

                                </td>

                                <td><a id="register{{$ox->id}}" href="javascript:;register({{$ox->id}})"
                                        @if($ox->loadDate != NULL) disabled @endif>登録</a>
                                </td>
                                <td><a id="cancel{{$ox->id}}" href="javascript:;cancel({{$ox->id}})" @if($ox->loadDate
                                        == NULL) disabled @endif>取消</a>
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