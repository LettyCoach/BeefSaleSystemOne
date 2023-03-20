
<table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm" cellspacing="0"
    style="min-width: 1000px; overflow-x: scroll; width:100%">
    <thead>
        <tr class="align-middle" style = "height:47px">
            <th class="text-center">No</th>
            <th class="text-center">積載</th>
            <th class="text-center" style="width:10%">重量</th>
            <th class="text-center" style="width:10%">格付</th>
            <th class="text-center">個体識別番号</th>
            <th class="text-center">和牛登録名</th>
            <th class="text-center">生年月日</th>
            <th class="text-center">性別</th>
            <th class="text-center">屠殺場</th>
            <th class="text-center" style="width:13%">登録日</th>
            <th class="text-center">登録</th>
            <th class="text-center">削除</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = ($pageNumber - 1) * $pageSize + 1;
        $firstRow = $no;
        $rowCnt = 0;
    @endphp
    @foreach ($oxen as $ox)
    @php
        $rowCnt ++;
    @endphp
        <tr class="align-middle">
            <td class="text-center">{{$no++}}</span></td>
            <td class="text-center"><span class="text-gray-800 break-all">
                @if($ox->slaughterFinishedDate != NULL)
                    <small style="padding: 5px" class="rounded text-white bg-success"> 完了 </small>
                    @else
                    <small style="padding: 5px" class="rounded text-white bg-danger"> 未 </small>
                    @endif
            </td>
            <td class="text-center"><span class="text-gray-800 break-all"><input type="text" class="form-control" value="{{$ox->acceptedWeight}}"
                            size="8" id="acceptedWeight{{$ox->id}}" @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></span></td>
            <td class="text-center"><span class="text-gray-800 break-all"><input type="text" class="form-control" value="{{$ox->acceptedLevel}}"
                        size="8" id="acceptedLevel{{$ox->id}}" @if($ox->slaughterFinishedDate != NULL) disabled @else @endif></span></td>
            <td class="text-center"><span
                    class="text-gray-800 break-all">{{$ox->registerNumber}}</span></td>
            <td class="text-center"><span class="text-gray-800 break-all">{{$ox->name}}</span></td>
            <td class="text-center"><span class="text-gray-800 break-all">{{$ox->birthday}}</span>
            </td>
            
            <td class="text-center"><span class="text-gray-800 break-all">@if($ox->sex == 1 ) 雄
                    @else 雌 @endif</span></td>
            <td class="text-center"><span class="text-gray-800 break-all">{{$ox->slaughterHouse->name}}</span>
                    </td>
           <td>
                    <input type="date" name="slaughterFinishedDate" class="form-control slaughterFinishedDate"  id="slaughterFinishedDate{{$ox->id}}" class="text-xs"
                        value="{{$ox->slaughterFinishedDate}}" @if($ox->slaughterFinishedDate !=
                    NULL) disabled @else @endif>
                </form>
                </span>
            </td>
            <td class="text-center"><a href="javascript:;register(undefined, {{$ox->id}})"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </td>
            <td class="text-center"><a href="javascript:;cancel({{$ox->id}})"><i class="fa fa-times" aria-hidden="true"></i></a>
            </td>

        </tr>
        @endforeach
    </table>
    <div class="d-flex  justify-content-between">
        <div class="d-flex justify-content-start">
            {{ $totalCnt }} エントリ中 {{ $firstRow }} から {{ $firstRow + $rowCnt - 1 }} を表示
        </div>
        <ul class="pagination justify-content-end">
            @if($pageCnt <= 5)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                </li>
                @endif
            @else
                @if($pageNumber <= 4)
                    @if($pageNumber == 1)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @endif
                    @for($i = 1; $i <= 4; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                    </li>
                @elseif($pageNumber >= $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    @if($pageNumber == $pageCnt)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                    </li>
                    @endif
                @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseList(1)" class="page-link">最後</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</table>

