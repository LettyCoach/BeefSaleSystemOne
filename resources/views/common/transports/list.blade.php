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
    <div class="panel panel-primary my-4" style="min-height: 500px; overflow-y: auto">
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">積載</th>
                                <th class="text-center">行き先</th>
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
                            @foreach($oxen as $ox)
                            <tr>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$counter++}}</span></td>
                                <td class="text-center">
                                    <span class="@if($ox->loadDate != NULL) text-success @endif">@if($ox->loadDate != NULL) 完了 @else 未 @endif</span>
                                </td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->birthday}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
                                <td class="text-center" class="p-1">
                                    <form method="post" id="loadDateForm{{$ox->id}}" name="loadDateForm{{$ox->id}}">
                                        @csrf
                                        <input type="hidden" name="ox_id" value="{{$ox->id}}">
                                        <input type="date" class="loadDate" name="loadDate" id="loadDate{{$ox->id}}" class="text-xs" value="{{$ox->loadDate}}">


                                    </form>

                                </td>
                                
                                <td class="text-center"><a id="register{{$ox->id}}" href="javascript:;register({{$ox->id}})"  @if($ox->loadDate != NULL) disabled @endif>登録</a>  
                                </td>
                                <td class="text-center"><a id="cancel{{$ox->id}}" href="javascript:;cancel({{$ox->id}})"  @if($ox->loadDate == NULL) disabled @endif>取り消す</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary my-4">
        <h2 class="text-center fw-bold">積み下ろし</h2>
        <div class="panel-body">
            <div style="width: 100%; padding-left: -10px;">
                <div class="table-responsive">
                    <table id="dtBasicExample1" class="table table-striped table-bordered table-sm" cellspacing="0"  style="min-width: 1200px; overflow-x: scroll; width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">積み下ろし</th>
                                <th class="text-center">行き先</th>
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
                            @foreach($oxen as $ox)
                            <tr>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$counter++}}</span></td>
                                <td class="text-center">
                                <span class="@if($ox->unloadDate != NULL) text-success @endif">@if($ox->unloadDate != NULL) 完了 @else 未 @endif</span>
                                </td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">{{$ox->birthday}}</span></td>
                                <td class="text-center"><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄 @else 雌 @endif</td>
                                <td class="text-center" class="p-1">
                                    <form method="post" id="unloadDateForm{{$ox->id}}" name="unloadDateForm{{$ox->id}}">
                                        @csrf
                                        <input type="hidden" name="ox_id" value="{{$ox->id}}">
                                        <input type="date" class="unloadDate" name="unloadDate" id="unloadDate{{$ox->id}}" class="text-xs" value="{{$ox->unloadDate}}">
                                    </form>
                                </td>
                                <td class="text-center"><a id="unloadDateregister{{$ox->id}}" href="javascript:;unloadDateregister({{$ox->id}})"  @if($ox->unloadDate != NULL) disabled @endif>登録</a>  
                                </td>
                                <td class="text-center"><a id="unloadDatecancel{{$ox->id}}" href="javascript:;unloadDatecancel({{$ox->id}})"  @if($ox->unloadDate == NULL) disabled @endif>取り消す</a>
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

<script src="{{ asset('assets/js/components/datatable.js') }}"></script>
<script>
    $(document).ready(function () {
      
        $('#dtBasicExample1').DataTable();
        $('.dataTables_length').addClass('bs-select');

        var today = getTodayDate();
        var length = document.getElementsByClassName("loadDate").length;
        for(i = 0; i < length; i ++) {
            document.getElementsByClassName("loadDate")[i].setAttribute('max', today);
        }
        length = document.getElementsByClassName("unloadDate").length;
        for(i = 0; i < length; i ++) {
            document.getElementsByClassName("unloadDate")[i].setAttribute('max', today);
        }

        function getTodayDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            return today;
        }
    });
</script>