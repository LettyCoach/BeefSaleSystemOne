
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
    style="min-width: 1200px; overflow-x: scroll; width:100%">
    <thead>
        <tr>
            <th class="text-center">番号</th>
            <th class="text-center">状態</th>
            <th class="text-center">個体識別番号</th>
            <th class="text-center">和牛登録名</th>
            <th class="text-center">生年月日</th>
            <th class="text-center">性別</th>
            <th class="text-center">登録</th>
            <th class="text-center">詳細</th>
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
        <tr>
            <td class="text-center">
                <span class="text-gray-800 break-all">{{$no++}}</span>
            </td>
            <td class="text-center">
            <span class="@if($ox->meats()->count()>0) text-success @endif">@if($ox->meats()->count()>0) 完了 @else 未 @endif</span>
            </td>
            <td class="text-center">
                <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
            </td>
            <td class="text-center">
                <span class="text-gray-800 break-all">{{$ox->name}}</span>
            </td>
            <td class="text-center">
                <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
            </td>
            <td class="text-center">
                <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌
                    @endif</span>
            </td>
            <td class="text-center">
                <a href="javascript:;openMeatModal({{ $ox->id }})"><i
                        class="p-2 fa fa-plus" aria-hidden="true"></i></a>
            </td>
            <td class="text-center">
                <a href="{{route('meats.show', $ox->id)}}"><i class="p-2 fa fa-info text-green-700"
                        aria-hidden="true"></i></a>
            </td>
            <td class="text-center">
                <form method="POST" id="deleteForm{{$ox->id}}"
                    action="{{route('meats.destroy',$ox->id)}}" class="inline-block" role="button">
                    @csrf
                    @method('delete')
                    <a onclick="deleteFunction({{$ox->id}})"><i
                            class="p-2 fas fa-trash"></i></a>

                    <script>
                    function deleteFunction(id) {
                        let text = "本当に削除しますか?";
                        if (confirm(text) == true) {
                            event.preventDefault();
                            document.getElementById('deleteForm' + id).submit();
                        } else
                            event.preventDefault();
                    }
                    </script>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
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

