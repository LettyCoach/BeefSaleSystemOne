<x-app-layout>
    <div class="max-w-2xl shadow-lg mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-center text-3xl font-bold mb-5">部位情報アップデート</h2>
        <form method="POST" action="{{ route('parts.update', $part) }}" class="max-w-2xl">
            @csrf
            @method('patch')
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/6">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-full-name">
                        部位名
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input name="name"  class="p-2 text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{old('name',$part->name)}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>
            
            <div class="md:flex md:items-center">
               
                    <div class="m-auto">
                    <div class="mt-4 space-x-2">
                        <x-primary-button>{{ __('アップデート') }}</x-primary-button>
                        <x-primary-button><a href="{{ route('parts.index') }}" class="hover:no-underline text-white">{{ __('キャンセル') }}</a></x-primary-button>
                    </div>
                    </div>
              
            </div>
        </form>
    </div>
</x-app-layout>