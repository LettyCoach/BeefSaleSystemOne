<table class="w-full m-auto text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
        <th  scope="col" class="px-6 py-4 ">No</th>
        <th  scope="col" class="px-6 py-4 ">積載</th>
        <th  scope="col" class="px-6 py-4 ">重量</th>
        <th  scope="col" class="px-6 py-4 ">格付</th>
        <th  scope="col" class="px-6 py-4 ">個体識別番号</th>
        <th  scope="col" class="px-6 py-4 ">和牛登録名</th>
        <th  scope="col" class="px-6 py-4 ">生年月日</th>
        <th  scope="col" class="px-6 py-4 ">性別</th>
        <th  scope="col" class="px-6 py-4 ">登録日</th>
        <th  scope="col" class="px-6 py-4 ">登録</th>
        <th  scope="col" class="px-6 py-4 ">キャンセル</th>
        
    </thead>
    <tbody class="text-center">
        @php
        $counter = 1;
        @endphp
        @foreach($oxen as $ox)

        <tr class="border-b dark:border-neutral-500">
            <td>{{$counter++}}</td>
            <td>
                <select disabled="disabled" class="text-xs">
                    <option @if($ox->slaughterFinishedDate != NULL) selected @endif >完了</option>
                    <option @if($ox->slaughterFinishedDate == NULL) selected @endif>未</option>
                </select>
            </td>
            <td><input type="text" class="w-16 text-xs"  value="{{$ox->acceptedWeight}}" id="acceptedWeight{{$ox->id}}"  @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></td>
            <td><input type="text" class="w-16 text-xs"  value="{{$ox->acceptedLevel}}" id="acceptedLevel{{$ox->id}}"  @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></td>
            <td>{{$ox->registerNumber}}</td>
            <td>{{$ox->name}}</td>
            <td>{{$ox->birthday}}</td>
            <td>@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
            <td class="p-1">
                <form method="post" id="slaughterFinishedDateForm{{$ox->id}}" name="slaughterFinishedDateForm{{$ox->id}}">
                    @csrf
                    <input type="hidden" name="ox_id" value="{{$ox->id}}">
                    <input type="date" name="slaughterFinishedDate" id="slaughterFinishedDate{{$ox->id}}" class="text-xs" value="{{$ox->slaughterFinishedDate}}" @if($ox->slaughterFinishedDate != NULL) disabled @else @endif>


                </form>

            </td>
            
            <td><a id="register{{$ox->id}}" href="javascript:;register({{$ox->id}})"  @if($ox->slaughterFinishedDate != NULL) disabled @endif>登録</a>  
            </td>
            <td><a id="cancel{{$ox->id}}" href="javascript:;cancel({{$ox->id}})"  @if($ox->slaughterFinishedDate == NULL) disabled @endif>キャンセル</a>
            </td>
        </tr>
                @endforeach
    <tbody>
    
</table>
