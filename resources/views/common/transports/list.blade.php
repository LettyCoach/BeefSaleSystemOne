@if($loadType == 0)
    <table id="" class="table table-bordered" style="min-width: 1000px; width: 100%; overflow-x: scroll;">
        <thead class="bg-light">
            <tr>
                <th>番号</th>
                <th>個体識別番号</th>
                <th>和牛登録名</th>
                <th>生年月日</th>
                <th>性別</th>
                <th>購入場所</th>
                <th>運送会社</th>
                <th>行き先</th>
                <th>積み込み状態</th>
                <th>積み込み日</th>
                <th style="width: 5%;">記載</th>
                <th style="width: 5%;">詳細</th>
            </tr>
        </thead>
        <tbody>
            @if(count($purchaseTransports) > 0)
                @php
                    $no = ($pageNumber - 1) * $pageSize + 1;
                    $firstRow = $no;
                    $rowCnt = 0;
                @endphp
                @foreach ($purchaseTransports as $purchaseTransport)
                @php
                    $rowCnt ++;
                @endphp
                <tr>
                    <td>
                        <span class="">{{ $no ++ }}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->registerNumber }}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->name }}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->birthday }}</span>
                    </td>
                    <td>
                        <span class="ml-2 break-all text-gray-600">@if( $purchaseTransport->sex == 1 ) 雄 @else 雌 @endif</span>
                    </td>
                    <td>
                        <span class="" id = "marketName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->market->name }}</span>
                    </td>
                    <td>
                        <span class="" id = "transportCompanyName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->purchaseTransportCompany->name }}</span>
                    </td>
                    <td>
                        <span class="" id = "pastoralName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->pastoral->name }}</span>
                    </td>
                    <td>
                        <span class="">@if($purchaseTransport->loadDate == null) 未 @else 完了 @endif</span>
                    </td>
                    <td>
                        <span class="ml-2 break-all text-gray-600">@if($purchaseTransport->loadDate == null) なし @else {{ $purchaseTransport->loadDate }} @endif</span>
                    </td>
                    @if($purchaseTransport->loadDate == null)
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;showPurchaseTransLoadModal({{  $purchaseTransport->id }})">
                                <i class="fa fa-plus"></i>
                            </a>
                        </span>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;" class="disabled">
                                <i class="fa fa-plus"></i>
                            </a>
                        </span>
                    </td>
                    @endif
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;showPurchaseTransViewModal({{  $purchaseTransport->id }})">
                                <i class="fa fa-info"></i>
                            </a>
                        </span>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="12">表にデータがありません</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex  justify-content-between">
        <div class="d-flex justify-content-start">
            @if(count($purchaseTransports) > 0)
                {{ $totalCnt }} エントリ中 {{ $firstRow }} から {{ $firstRow + $rowCnt - 1 }} を表示
            @endif
        </div>
        <ul class="pagination justify-content-end">
            @if($pageCnt <= 5)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @endif
            @else
                @if($pageNumber <= 4)
                    @if($pageNumber == 1)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @endif
                    @for($i = 1; $i <= 4; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                @elseif($pageNumber >= $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    @if($pageNumber == $pageCnt)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                    @endif
                @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
@else
    <table id="" class="table table-bordered" style="min-width: 1000px; width: 100%; overflow-x: scroll;">
        <thead class="bg-light">
            <tr style="postion: sticky; top: 0;">
                <th>番号</th>
                <th>個体識別番号</th>
                <th>和牛登録名</th>
                <th>生年月日</th>
                <th>性別</th>
                <th>購入場所</th>
                <th>運送会社</th>
                <th>行き先</th>
                <th>積み下ろし状態</th>
                <th>積み下ろし日</th>
                <th style="width: 5%;">記載</th>
                <th style="width: 5%;">詳細</th>
            </tr>
        </thead>
        <tbody>
            @if(count($purchaseTransports) > 0)
                @php
                    $no = ($pageNumber - 1) * $pageSize + 1;
                    $firstRow = $no;
                    $rowCnt = 0;
                @endphp
                @foreach ($purchaseTransports as $purchaseTransport)
                @php
                    $rowCnt ++;
                @endphp
                <tr>
                    <td>
                        <span class="">{{ $no ++ }}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->registerNumber}}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->name}}</span>
                    </td>
                    <td>
                        <span class="">{{ $purchaseTransport->birthday}}</span>
                    </td>
                    <td>
                        <span class="ml-2 break-all text-gray-600">@if( $purchaseTransport->sex==1) 雄 @else 雌 @endif</span>
                    </td>
                    <td>
                        <span class="" id = "marketName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->market->name }}</span>
                    </td>
                    <td>
                        <span class="" id = "transportCompanyName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->purchaseTransportCompany->name }}</span>
                    </td>
                    <td>
                        <span class="" id = "pastoralName_{{ $purchaseTransport->id }}">{{ $purchaseTransport->pastoral->name }}</span>
                    </td>
                    <td>
                        <span class="">@if($purchaseTransport->unloadDate == null) 未 @else 完了 @endif</span>
                    </td>
                    <td>
                        <span class="ml-2 break-all text-gray-600">@if($purchaseTransport->unloadDate == null) なし @else {{ $purchaseTransport->loadDate }} @endif</span>
                    </td>
                    @if($purchaseTransport->unloadDate == null)
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;showPurchaseTransUnloadModal({{  $purchaseTransport->id }})">
                                <i class="fa fa-plus"></i>
                            </a>
                        </span>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;" class="disabled">
                                <i class="fa fa-plus"></i>
                            </a>
                        </span>
                    </td>
                    @endif
                    <td class="text-center">
                        <span class="">
                            <a href="javascript:;showPurchaseTransViewModal({{  $purchaseTransport->id }})">
                                <i class="fa fa-info"></i>
                            </a>
                        </span>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="12">表にデータがありません</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex  justify-content-between">
        <div class="d-flex justify-content-start">
            @if(count($purchaseTransports) > 0)
                {{ $totalCnt }} エントリ中 {{ $firstRow }} から {{ $firstRow + $rowCnt - 1 }} を表示
            @endif
        </div>
        <ul class="pagination justify-content-end">
            @if($pageCnt <= 5)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @endif
            @else
                @if($pageNumber <= 4)
                    @if($pageNumber == 1)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    @endif
                    @for($i = 1; $i <= 4; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                @elseif($pageNumber >= $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    @if($pageNumber == $pageCnt)
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item disabled">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                    @endif
                @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">初め</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList(1)" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                        @if($i == $pageNumber)
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link active">{{ $i }}</a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="javascript:;getPurchaseTransportList({{ $i }})" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                    @endfor
                    <li class="page-item">
                        <a href="javascript:;" class="page-link">...</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:;getPurchaseTransportList({{ $pageCnt }})" class="page-link">最後</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
@endif