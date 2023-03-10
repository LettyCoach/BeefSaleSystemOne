@foreach ($oxs as $ox)
<tr
    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
    <td class="whitespace-nowrap px-6 py-2 font-medium ">
        <span class="text-gray-800 break-all"><a href="javascript:;descriptionModal({{ $ox->id }})" class="text-sm">記入</a></span>
    </td>
    <td class="whitespace-nowrap px-6 py-2 font-medium ">
        <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
    </td>
    <td class="hitespace-nowrap px-6 py-2 font-medium ">
        <span class="text-gray-800 break-all">{{$ox->name}}</span>
    </td>
    <td class="whitespace-nowrap px-6 py-2 font-medium  ">
        <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
    </td>
    <td class="whitespace-nowrap px-6 py-2 font-medium  ">
        <small
            class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</small>
    </td>
</tr>
@endforeach