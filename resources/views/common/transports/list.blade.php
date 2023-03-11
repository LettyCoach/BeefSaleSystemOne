<table class="w-full">
    <thead class="text-xl text-center mb-4 border-b dark:border-neutral-500">
        <th>No</th>
        <th>積載</th>
        <th>行き先</th>
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
            <td>
                <select disabled="disabled" class="text-xs">
                    <option @if($ox->loadDate != NULL) selected @endif >完了</option>
                    <option @if($ox->loadDate == NULL) selected @endif>未</option>
                </select>
            </td>
            <td>{{$ox->pastoral->name}}</td>
            <td>{{$ox->registerNumber}}</td>
            <td>{{$ox->name}}</td>
            <td>{{$ox->birthday}}</td>
            <td>@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
            <td class="p-1">
                <form method="post" id="loadDateForm{{$ox->id}}" name="loadDateForm{{$ox->id}}">
                    @csrf
                    <input type="hidden" name="ox_id" value="{{$ox->id}}">
                    <input type="date" name="loadDate" id="loadDate{{$ox->id}}" class="text-xs" value="{{$ox->loadDate}}">


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



<table class="w-full mt-20">
    <thead class="text-xl text-center mb-4 border-b dark:border-neutral-500">
        <th>No</th>
        <th>積み下ろし</th>
        <th>行き先</th>
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
            <td>
                <select disabled="disabled" class="text-xs ">
                    <option @if($ox->unloadDate != NULL) selected @endif >完了</option>
                    <option @if($ox->unloadDate == NULL) selected @endif>未</option>
                </select>
            </td>
            <td>{{$ox->pastoral->name}}</td>
            <td>{{$ox->registerNumber}}</td>
            <td>{{$ox->name}}</td>
            <td>{{$ox->birthday}}</td>
            <td>@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
            <td class="p-1">
                <form method="post" id="unloadDateForm{{$ox->id}}" name="unloadDateForm{{$ox->id}}">
                    @csrf
                    <input type="hidden" name="ox_id" value="{{$ox->id}}">
                    <input type="date" name="unloadDate" id="unloadDate{{$ox->id}}" class="text-xs" value="{{$ox->unloadDate}}">


                </form>

            </td>
            
            <td><a id="unloadDateregister{{$ox->id}}" href="javascript:;unloadDateregister({{$ox->id}})"  @if($ox->unloadDate != NULL) disabled @endif>登録</a>  
            </td>
            <td><a id="unloadDatecancel{{$ox->id}}" href="javascript:;unloadDatecancel({{$ox->id}})"  @if($ox->unloadDate == NULL) disabled @endif>キャンセル</a>
            </td>
        </tr>
                @endforeach
    <tbody>
    
</table>