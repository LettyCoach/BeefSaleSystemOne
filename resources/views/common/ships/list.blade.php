<table id="" class="table table-bordered table-striped" style="min-width: 1000px; width: 100%; overflow-x: scroll;">
    <thead class="bg-light">
        <tr style="postion: sticky; top: 0;">
            <th class="text-center">番号</th>
            <th class="text-center">個体識別番号</th>
            <th class="text-center">和牛登録名</th>
            <th class="text-center">生年月日</th>
            <th class="text-center">性別</th>
            <th class="text-center">牧場</th>
            <th class="text-center">運送会社</th>
            <th class="text-center">行き先</th>
            <th class="text-center">編集</th>
            <th class="text-center">削除</th>
        </tr>
    </thead>
    <tbody>
        @if(count($ships) > 0)
            @php
                $no = ($pageNumber - 1) * $pageSize + 1;
                $firstRow = $no;
                $rowCnt = 0;
            @endphp
            @foreach ($ships as $ship)
            @php
                $rowCnt ++;
            @endphp
            <tr>
                <td class="text-center">
                    <span class="">{{ $no ++ }}</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->registerNumber}}</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->name}}</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->birthday}}</span>
                </td>
                <td class="text-center">
                    <span class="ml-2 break-all text-gray-600">@if($ship->sex==1) 雄 @else 雌 @endif</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->pastoral->name}}</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->slaughterTransportCompany->name}}</span>
                </td>
                <td class="text-center">
                    <span class="">{{$ship->slaughterHouse->name}}</span>
                </td>
                <td class="text-center">
                    <span class="">
                        <a href="javascript:;editShip({{ $ship->id }})" class="text-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                </td>
                <td class="text-center">
                    <span class="">
                        <a href="javascript:;deleteShip({{ $ship->id }})">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="10">表にデータがありません</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="d-flex  justify-content-between">
    <div class="d-flex justify-content-start">
        @if(count($ships) > 0)
            {{ $totalCnt }} エントリ中 {{ $firstRow }} から {{ $firstRow + $rowCnt - 1 }} を表示
        @endif
    </div>
    <ul class="pagination justify-content-end">
        @if($pageCnt <= 5)
            @if($pageNumber == 1)
            <li class="page-item disabled">
                <a href="javascript:;getShipList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getShipList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @endif
            @for($i = 1; $i <= $pageCnt; $i ++)
                @if($i == $pageNumber)
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $i }})" class="page-link active">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $i }})" class="page-link">{{ $i }}</a>
                </li>
                @endif
            @endfor
            @if($pageNumber == $pageCnt)
            <li class="page-item disabled">
                <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
            </li>
            @endif
        @else
            @if($pageNumber <= 4)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getShipList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getShipList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= 4; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
            @elseif($pageNumber >= $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getShipList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @endif
            @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getShipList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getShipList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getShipList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
            @endif
        @endif
    </ul>
</div>