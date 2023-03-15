    
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
    <div class="panel panel-primary container mx-auto" style="min-height: 500px; overflow-y: auto">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm" cellspacing="0"
                        style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">積載</th>
                                <th class="text-center">重量</th>
                                <th class="text-center">格付</th>
                                <th class="text-center">個体識別番号</th>
                                <th class="text-center">和牛登録名</th>
                                <th class="text-center">生年月日</th>
                                <th class="text-center">性別</th>
                                <th class="text-center">登録日</th>
                                <th class="text-center">登録</th>
                                <th class="text-center">取り消す</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach ($oxen as $ox)
                            <tr>
                                <td class="text-center">{{$counter++}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">
                                        <span class="@if($ox->slaughterFinishedDate != NULL) text-success @endif">@if($ox->slaughterFinishedDate != NULL) 完了 @else 未 @endif</span>
                                    </span></td>
                                <td class="text-center"><span class="text-gray-800 break-all"><input type="text" class="w-10" value="{{$ox->acceptedWeight}}"
                                             size="8" id="acceptedWeight{{$ox->id}}" @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></span></td>
                                <td class="text-center"><span class="text-gray-800 break-all"><input type="text" class="w-10" value="{{$ox->acceptedLevel}}"
                                            size="8" id="acceptedLevel{{$ox->id}}" @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></span></td>
                                <td class="text-center"><span
                                        class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                                </td>
                                <td class="text-center"><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄
                                        @else 雌 @endif</span></td>
                                <td class="text-center" class="p-1">
                                    <form method="post" id="slaughterFinishedDateForm{{$ox->id}}"
                                        name="slaughterFinishedDateForm{{$ox->id}}">
                                        @csrf
                                        <input type="hidden" name="ox_id" value="{{$ox->id}}">
                                        <input type="date" name="slaughterFinishedDate" 
                                            id="slaughterFinishedDate{{$ox->id}}" class="text-xs"
                                            value="{{$ox->slaughterFinishedDate}}" @if($ox->slaughterFinishedDate !=
                                        NULL) disabled @else @endif>
                                    </form>
                                    </span>
                                </td>
                                <td class="text-center"><span class="text-gray-800 break-all"><a
                                            id="register{{$ox->id}}" href="javascript:;register({{$ox->id}})"
                                            @if($ox->slaughterFinishedDate != NULL) disabled @endif>登録</a>
                                    </span></td>
                                <td class="text-center"><span class="text-gray-800 break-all"><a id="cancel{{$ox->id}}"
                                            href="javascript:;cancel({{$ox->id}})" @if($ox->slaughterFinishedDate ==
                                            NULL) disabled @endif>取り消す</a>
                                    </span></td>

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
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>