<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
    style="min-width: 1000px; width: 100%; overflow-x: scroll; width:100%">
    <thead>
        <tr>
            <th>個体識別番号</th>
            <th>和牛登録名</th>
            <th>生年月日</th>
            <th>性別</th>
            <th>記載</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($oxs as $ox)
        <tr>
            <td>
                <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
            </td>
            <td>
                <span class="text-gray-800 break-all">{{$ox->name}}</span>
            </td>
            <td>
                <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
            </td>
            <td>
                <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</span>
            </td>
            <td>
                <span class="text-gray-800 break-all">
                    <a href="javascript:;descriptionModal({{ $ox->id }})" class="text-sm">記入</a>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>