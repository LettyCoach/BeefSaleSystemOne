<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            <table class="min-w-full table-fixed text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 ">個体識別番号</th>
                        <th scope="col" class="px-6 py-4 ">和牛登録名</th>
                        <th scope="col" class="px-6 py-4 ">生年月日</th>
                        <th scope="col" class="px-6 py-4 ">性別</th>
                        <th scope="col" class="px-6 py-4 ">牧場</th>
                        <th scope="col" class="px-6 py-4 ">運送会社</th>
                        <th scope="col" class="px-6 py-4 ">行き先</th>
                        <th scope="col" class="px-6 py-4 ">編集</th>
                        <th scope="col" class="px-6 py-4 ">削除</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($oxen as $ox)
                    <tr
                        class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
                        <td class="whitespace-nowrap px-6 py-2 font-medium ">
                            <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium ">
                            <span class="text-gray-800 break-all">{{$ox->name}}</span>
                        </td>
                        <td class="hitespace-nowrap px-6 py-2 font-medium ">
                            <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            <span class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            {{$ox->pastoral->name}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            {{$ox->slaughterTransportCompany->name}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            {{$ox->slaughterHouse->name}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            <a href="">Edit</a>
                        </td>
                        <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                            <a href="">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="px-4 pt-4">
                {{ $oxen->links() }}
            </div>
        </div>
    </div>
</div>