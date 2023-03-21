<table id="dtBasicExample" class="table table-striped table-fixed table-bordered"
    cellspacing="0" style="min-width: 1000px; overflow-x: scroll; width:100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">名前</th>
            <th class="text-center">場所</th>
            <th class="text-center">メモ</th>
            <th class="text-center">時間</th>
            <th class="text-center">編集</th>
            <th class="text-center">削除</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = ($pageNumber - 1) * $pageSize + 1;
            $firstRow = $no;
            $rowCnt = 0;
        @endphp
        @foreach ($transportCompanies as $transportCompany)
        @php
            $rowCnt ++;
        @endphp
        <tr>
            <td class="text-center">
                <span>{{ $no++;}}</span>
            </td>
            <td class="text-center">
                <span>{{ $transportCompany->name }}</span>
            </td>
            <td class="text-center">
                <span>{{ $transportCompany->position }}</span>
            </td>
            <td class="text-center">
                <span>{{ $transportCompany->note }}</span>
            </td>
            <td class="text-center">
                <span
                    class="ml-2 break-all text-gray-600">{{ $transportCompany->created_at->format('Y-m-d') }}</span>
            </td>
            <td class="text-center">
                <a href="{{route('transportCompanies.edit', $transportCompany)}}" class="p-2"><i
                        class="fa fa-edit"></i></a>
            </td>
            <td class="text-center">
                <form method="POST" id="deleteForm{{$transportCompany->id}}"
                    action="{{ route('transportCompanies.destroy', $transportCompany) }}"
                    class="inline-block ">
                    @csrf
                    @method('delete')
                    <a href="javascript:;showConfirmModal({{$transportCompany->id}})">
                        <i class="fa fa-trash"></i>
                    </a>
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
                <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @endif
            @for($i = 1; $i <= $pageCnt; $i ++)
                @if($i == $pageNumber)
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link active">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link">{{ $i }}</a>
                </li>
                @endif
            @endfor
            @if($pageNumber == $pageCnt)
            <li class="page-item disabled">
                <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
            </li>
            @endif
        @else
            @if($pageNumber <= 4)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= 4; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
                </li>
            @elseif($pageNumber >= $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
                </li>
                @endif
            @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getTransportCompaniesList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getTransportCompaniesList(1)" class="page-link">最後</a>
                </li>
            @endif
        @endif
    </ul>
</div>