<table class="w-full m-auto text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
        <th scope="col" class="px-6 py-4 ">No</th>
        <th scope="col" class="px-6 py-4 ">ステータス</th>
        <th scope="col" class="px-6 py-4 ">個体識別番号</th>
        <th scope="col" class="px-6 py-4 ">和牛登録名</th>
        <th scope="col" class="px-6 py-4 ">生年月日</th>
        <th scope="col" class="px-6 py-4 ">性別</th>
        <th scope="col" class="px-6 py-4 ">登録日</th>
        <th scope="col" class="px-6 py-4 ">登録</th>
        <th scope="col" class="px-6 py-4 ">キャンセル</th>
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
