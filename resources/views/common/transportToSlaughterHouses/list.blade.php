<table class="w-full">
    <thead class="text-xl text-center mb-4 border-b dark:border-neutral-500">
        <th>No</th>
        <th>ステータス</th>
        <th>個体識別番号</th>
        <th>和牛登録名</th>
        <th>生年月日</th>
        <th>性別</th>
        <th>登録日</th>
        <th>登録</th>
        <th>キャンセル</th>
    </thead>
    <tbody class="text-center">
        @php
        $counter = 1;
        @endphp
        @foreach($oxen as $ox)

        <tr class="border-b dark:border-neutral-500">
            <td>{{$counter++}}</td>
            <td class="text-xs">
                <select disabled="disabled" name="" id="">
                    <option @if($ox->acceptedDateSlaughterHouse != NULL) selected @endif >完了</option>
                    <option @if($ox->acceptedDateSlaughterHouse == NULL) selected @endif>未</option>
                </select>
            </td>
            <td>{{$ox->registerNumber}}</td>
            <td>{{$ox->name}}</td>
            <td>{{$ox->birthday}}</td>
            <td>@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
            <td class="p-1 text-xs">
                <form method="post" id="loadDateForm{{$ox->id}}" name="loadDateForm{{$ox->id}}">
                    @csrf
                    <input type="hidden" name="ox_id" value="{{$ox->id}}">
                    <input type="date" name="acceptedDateSlaughterHouse" id="acceptedDateSlaughterHouse{{$ox->id}}" value="{{$ox->acceptedDateSlaughterHouse}}">
                </form>

            </td>
            
            <td><a id="register{{$ox->id}}" href="javascript:;register({{$ox->id}})"  @if($ox->loadDate != NULL) disabled @endif>登録</a>  
            </td>
            <td><a id="cancel{{$ox->id}}" href="javascript:;cancel({{$ox->id}})"  @if($ox->loadDate == NULL) disabled @endif>キャンセル</a>
            </td>
        </tr>
                @endforeach
    <tbody>
    
</table>
