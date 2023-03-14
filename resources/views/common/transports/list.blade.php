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
<div class="mx-auto">
    @if($message = Session::get('updateSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('registerSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif @if($message = Session::get('deleteSuccess'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <div class="panel panel-primary" style="margin: 50px;">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach($oxen as $ox)
                            <tr>
                                <td><span class="text-gray-800 break-all">{{$counter++}}</span></td>
                                <td>
                                    <select disabled="disabled" class="text-xs">
                                        <option @if($ox->loadDate != NULL) selected @endif >完了</option>
                                        <option @if($ox->loadDate == NULL) selected @endif>未</option>
                                    </select>
                                </td>
                                <td><span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->birthday}}</span></td>
                                <td><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary" style="margin: 50px;">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample1" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach($oxen as $ox)
                            <tr>
                                <td><span class="text-gray-800 break-all">{{$counter++}}</span></td>
                                <td>
                                    <select disabled="disabled" class="text-xs">
                                        <option @if($ox->unloadDate != NULL) selected @endif >完了</option>
                                        <option @if($ox->unloadDate == NULL) selected @endif>未</option>
                                    </select>
                                </td>
                                <td><span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
                                <td><span class="text-gray-800 break-all">{{$ox->birthday}}</span></td>
                                <td><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD

<table class="w-full m-auto text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
        <th scope="col" class="px-6 py-4 ">No</th>
        <th scope="col" class="px-6 py-4 ">積み下ろし</th>
        <th scope="col" class="px-6 py-4 ">行き先</th>
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
=======
<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('#dtBasicExample1').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
>>>>>>> c6aa147844b4673357094789e3c48910e3b7ebf3
