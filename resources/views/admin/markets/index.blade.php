<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
        <h2 class="text-center text-3xl font-bold">Market Information List</h2>
        {{ $markets->links() }}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full table-fixed text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
                                <tr>
                                <th scope="col" class="px-6 py-4 w-10">No</th>
                                <th scope="col" class="px-6 py-4 w-36">Name</th>
                                    <th scope="col" class="px-6 py-4 w-40">Position</th>
                                    <th scope="col" class="px-6 py-4 w-40">Note</th>
                                    <th scope="col" class="px-6 py-4 w-40">Time</th>
                                    <th scope="col" class="px-6 py-4 w-5">State</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $counter = 1;
                            @endphp
                                @foreach ($markets as $market)
                                <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium w-10">
                                        <span class="text-gray-800 break-all">{{ $counter++;}}</span></td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium w-36">
                                        <span class="text-gray-800 break-all">{{ $market->name }}</span></td>
                                    <td class="hitespace-nowrap px-6 py-4 font-medium w-40">
                                        <span class="text-gray-800 break-all">{{ $market->position }}</span></td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium w-40 ">
                                        <span class="text-gray-800 break-all">{{ $market->note }}</span></td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium w-40 ">
                                        <small class="ml-2 break-all text-gray-600">{{ $market->created_at->format('j M Y, g:i a') }}</small>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium w-10">
                                        <a href="{{route('markets.create')}}" class="p-2"><i class="fa fa-plus" style="color:blue"></i></a>
                                        <a href="{{route('markets.edit', $market)}}" class="p-2"><i class="fa fa-check" style="color:blue"></i></a>
                                        <form method="POST" action="{{ route('markets.destroy', $market) }}" class="inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="route('markets.destroy', $market)"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="fa fa-remove" style="color:blue"></i>
                                                    </a>
                                                </form>
                                        <!-- <x-dropdown class="w-3/6 z-50">
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content" class="z-50 overflow-visible">
                                                <x-dropdown-link :href="route('markets.create')">
                                                    {{ __('Create') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link :href="route('markets.edit', $market)">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <form method="POST" action="{{ route('markets.destroy', $market) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <x-dropdown-link :href="route('markets.destroy', $market)"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        {{ __('Delete') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </x-slot>
                                        </x-dropdown> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>