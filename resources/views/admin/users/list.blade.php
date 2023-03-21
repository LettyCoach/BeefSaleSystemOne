<table id="" class="table table-striped table-fixed table-bordered" style="min-width: 1000px; overflow-x: scroll; width:100%">
    <thead>
        <tr>
            <th class="text-center">番号</th>
            <th class="text-center">名前</th>
            <th class="text-center">Eメール</th>
            <th class="text-center">権限設定</th>
            <th class="text-center">削除</th>
        </tr>
    </thead>
    <tbody>
        @if($users->count() > 0)
            @php
                $no = ($pageNumber - 1) * $pageSize + 1;
                $firstRow = $no;
                $rowCnt = 0;
            @endphp
            @foreach ($users as $user)
            @php
                $rowCnt ++;
            @endphp
            <tr>
                <td class="text-center">
                    <span class="break-all">{{ $no ++ }}</span>
                </td>
                <td class="text-center">
                    <span class="break-all" id = "userName{{ $user->id }}">{{ $user->name }}</span>
                </td>
                <td class="text-center">
                    <span class="break-all" id = "userEmail{{ $user->id }}">{{ $user->email }}</span>
                </td>
                <td class="text-center">
                    <span class="break-all">
                        <a href="javascript:;showAddRoleModal({{ $user->id }})">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>
                </td>
                <td class="text-center">
                    <span class="break-all">
                        <a href="javascript:;showConfirmModal({{$user->id}})">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">表にデータがありません</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-between">
    <div class="d-flex justify-content-start">
        @if(count($users) > 0)
            {{ $totalCnt }} エントリ中 {{ $firstRow }} から {{ $firstRow + $rowCnt - 1 }} を表示
        @endif
    </div>
    <ul class="pagination justify-content-end">
        @if($pageCnt <= 5)
            @if($pageNumber == 1)
            <li class="page-item disabled">
                <a href="javascript:;getUserList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getUserList(1)" class="page-link">初め</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
            </li>
            @endif
            @for($i = 1; $i <= $pageCnt; $i ++)
                @if($i == $pageNumber)
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $i }})" class="page-link active">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $i }})" class="page-link">{{ $i }}</a>
                </li>
                @endif
            @endfor
            @if($pageNumber == $pageCnt)
            <li class="page-item disabled">
                <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item disabled">
                <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
            </li>
            <li class="page-item">
                <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
            </li>
            @endif
        @else
            @if($pageNumber <= 4)
                @if($pageNumber == 1)
                <li class="page-item disabled">
                    <a href="javascript:;getUserList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getUserList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                @endif
                @for($i = 1; $i <= 4; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
            @elseif($pageNumber >= $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getUserList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageCnt - 3; $i <= $pageCnt; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                @if($pageNumber == $pageCnt)
                <li class="page-item disabled">
                    <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item disabled">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
                @endif
            @elseif($pageNumber > 4 && $pageNumber < $pageCnt - 3)
                <li class="page-item">
                    <a href="javascript:;getUserList(1)" class="page-link">初め</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber - 1 }})" class="page-link">前へ</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList(1)" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                @for($i = $pageNumber - 1; $i <= $pageNumber + 1; $i ++)
                    @if($i == $pageNumber)
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link active">{{ $i }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a href="javascript:;getUserList({{ $i }})" class="page-link">{{ $i }}</a>
                    </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a href="javascript:;" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">{{ $pageCnt }}</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageNumber + 1 }})" class="page-link">次に</a>
                </li>
                <li class="page-item">
                    <a href="javascript:;getUserList({{ $pageCnt }})" class="page-link">最後</a>
                </li>
            @endif
        @endif
    </ul>
</div>