<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">番号</th>
            <th class="text-center">部位</th>
            <th class="text-center">重さ</th>
            <th class="text-center">編集</th>
            <th class="text-center">削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ox->parts as $item)
        <tr>
            <td class="text-center" id = "partName{{$item->id}}">
                {{$item->name}}
            </td>
            <td class="text-center" id = "weight{{$item->id}}">
                {{$item->pivot->weight}}
            </td>
            <td class="text-center" id = "price{{$item->id}}">
                {{$item->pivot->price}}
            </td>
            <td class="text-center">
                <a href="javascript:;showUpdateModal({{$item->id}},{{$ox->id}})"><i class="fa fa-check text-green-700"
                        aria-hidden="true"></i></a>
            </td>
            <td class="text-center">
                <a href="javascript:;deletePartRegister({{$item->id}},{{$ox->id}})"><i class="fa fa-trash text-green-700"
                        aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>