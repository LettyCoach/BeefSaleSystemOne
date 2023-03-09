<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
        <h2 class="text-center text-3xl font-bold mt-4 mb-4">牧場リスト</h2>
        <div class="flex justify-between items-center">
            <div class="">
            合計:{{$pastorals->total()}}
            </div>
            <div class="flex justify-end items-center">
                <form action="{{route('pastorals.index')}}" method="get" class="">
                    @csrf
                    @method('get')
                    @php
                    $pageSize = $pastorals->perPage();
                    @endphp
                    <div>
                        <label for="pageSize">ページごとの行</label>
                        <select name="pageSize" id="pageSize" class="text-xs"
                            onchange="event.preventDefault(); this.closest('form').submit();">
                            <option value="15" @if($pageSize==15 ) selected @endif>15</option>
                            <option value="20" @if($pageSize==20) selected @endif>20</option>
                            <option value="30" @if($pageSize==30) selected @endif>30</option>
                            <option value="50" @if($pageSize==50) selected @endif>50</option>
                        </select>
                    </div>

                </form>
                <div class="m-2 rounded-md">
                <x-primary-button><a href="{{ route('pastorals.create') }}" class="hover:no-underline text-white">{{ __('添加') }}</a></x-primary-button> 
                </div>
            </div>
        </div>
        

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full table-fixed text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 w-10">番号</th>
                                    <th scope="col" class="px-6 py-4 w-36">名前</th>
                                    <th scope="col" class="px-6 py-4 w-40">場所</th>
                                    <th scope="col" class="px-6 py-4 w-40">メモ</th>
                                    <th scope="col" class="px-6 py-4 w-40">時間</th>
                                    <th scope="col" class="px-6 py-4 w-5">活動</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter =($pastorals->currentPage()-1)*$pageSize +1;
                                @endphp
                                @foreach ($pastorals as $pastoral)
                                <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-10">
                                        <span class="text-gray-800 break-all">{{ $counter++;}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-36">
                                        <span class="text-gray-800 break-all">{{ $pastoral->name }}</span>
                                    </td>
                                    <td class="hitespace-nowrap px-6 py-2 font-medium w-40">
                                        <span class="text-gray-800 break-all">{{ $pastoral->position }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-40 ">
                                        <span class="text-gray-800 break-all">{{ $pastoral->note }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-40 ">
                                        <small
                                            class="ml-2 break-all text-gray-600">{{ $pastoral->created_at->format('j M Y, g:i a') }}</small>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-10">
                                        <a href="{{route('pastorals.edit', $pastoral)}}" class="p-2"><i class="fa fa-check"
                                                style="color: rgb(121, 121, 121)"></i></a>
                                        <form method="POST" id="deleteForm" action="{{ route('pastorals.destroy', $pastoral) }}"
                                            class="inline-block p-2">
                                            @csrf
                                            @method('delete')
                                            <a href="route('pastorals.destroy', $pastoral)" onclick="deleteFunction()">
                                                <i class="fa fa-remove" style="color:rgb(121, 121, 121)"></i>
                                            </a>
                                            <script>
                                                function deleteFunction() {
                                                let text = "本当に削除しますか?";
                                                    if (confirm(text) == true) {
                                                        event.preventDefault(); 
                                                        document.getElementById('deleteForm').submit();
                                                    }else
                                                        event.preventDefault(); 
                                                }
                                                </script>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{$pastorals->appends("pageSize",$pageSize)}}

</x-app-layout>