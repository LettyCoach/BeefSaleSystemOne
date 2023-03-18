@php
    $no = 1;
@endphp
@foreach ($oxs as $ox)
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
</tr>
@endforeach