<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" style="min-width: 1000px; width: 100%; overflow-x: scroll; width:100%">
    <thead>
        <tr>
            <th>個体識別番号</th>
            <th>和牛登録名</th>
            <th>生年月日</th>
            <th>性別</th>
            <th>牧場</th>
            <th>運送会社</th>
            <th>行き先</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($oxen as $ox)
        <tr>
            <td>
                <span class="">{{ $ox->registerNumber }}</span>
            </td>
            <td>
                <span class="">{{ $ox->name }}</span>
            </td>
            <td>
                <span class="">{{ $ox->birthday }}</span>
            </td>
            <td>
                <span class="">@if($ox->sex==1) 雄 @else 雌 @endif</span>
            </td>
            <td>
                <span class="">{{$ox->pastoral->name}}</span>
            </td>
            <td>
                <span class="">{{$ox->slaughterTransportCompany->name}}</span>
            </td>
            <td>
                <span class="">{{$ox->slaughterHouse->name}}</span>
            </td>
            <td>
                <a class="p-2 text-center" href="javascript:;editShip({{ $ox->id }})"><i class="fa fa-edit"></i></a>
            </td>
            <td>
                <a class="p-2 text-center" href="javascript:;deleteShip({{ $ox->id }})"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
</script>