<table id="" class="table table-bordered" style="min-width: 1000px; width: 100%; overflow-x: scroll;">
    <thead class="bg-light">
        <tr style="postion: sticky; top: 0;">
            <th>番号</th>
            <th>個体識別番号</th>
            <th>和牛登録名</th>
            <th>生年月日</th>
            <th>性別</th>
            <th>記載</th>
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = ($pageNumber - 1) * $pageSize + 1;
            $firstRow = $no;
            $rowCnt = 0;
        @endphp
        @foreach ($oxs as $ox)
        @php
            $rowCnt ++;
        @endphp
        <tr>
            <td>
                <span class="">{{ $no ++ }}</span>
            </td>
            <td>
                <span class="">{{$ox->registerNumber}}</span>
            </td>
            <td>
                <span class="">{{$ox->name}}</span>
            </td>
            <td>
                <span class="">{{$ox->birthday}}</span>
            </td>
            <td>
                <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</span>
            </td>
            <td>
                <span class="">
                    <a href="javascript:;descriptionModal({{ $ox->id }})" class="text-sm">記入</a>
                </span>
            </td>
            <td>
                <span class="">
                    <a href="javascript:;">
                        <i class="fa fa-info"></i>
                    </a>
                </span>
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
                <a href="javascript:;getOxList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getOxList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @endif
            @for($i = 1; $i <= $pageCnt; $i ++)
                @if($i == $pageNumber)
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $i }})" class="page-link active">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $i }})" class="page-link">{{ $i }}</a>
                </li>
                @endif
            @endfor
            @if($pageNumber == $pageCnt)
            <li class="page-item disabled">
                <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getOxList(1)" class="page-link">最後</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getOxList(1)" class="page-link">最後</a>
            </li>
            @endif
        @else
            @if($pageNumber <= 4)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getOxList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= 4; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">最後</a>
                </li>
            @elseif($pageNumber >= $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getOxList(1)" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">最後</a>
                </li>
                @endif
            @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getOxList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getOxList(1)" class="page-link">最後</a>
                </li>
            @endif
        @endif
    </ul>
</div>