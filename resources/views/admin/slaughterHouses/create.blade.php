<x-app-layout>
    <div class="max-w-lg shadow-lg mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-center text-3xl font-bold mb-5">屠殺場情報登録</h2>
        <form method="POST" action="{{ route('slaughterHouses.store') }}" class="max-w-2xl">
            @csrf
            @method('post')
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/6">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-full-name">
                        名前
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input name="name" class="p-2 text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{old('name',$slaughterHouse->name)}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/6">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-password">
                        場所
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input name="position" 
                        class="p-2 text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{ old('position',$slaughterHouse->position) }}">
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/6">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-password">
                        メモ
                    </label>
                </div>
                <div class="md:w-5/6">
                    <textarea name="note" 
                        class=" text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('note',$slaughterHouse->note) }}</textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center">
                
                
                    <div class="m-auto">
                        <x-primary-button>{{ __('セーブ') }}</x-primary-button>
                        <x-primary-button><a href="{{ route('slaughterHouses.index') }}" class="hover:no-underline text-white">{{ __('キャンセル') }}</a></x-primary-button>
                    </div>
                
            </div>
        </form>
    </div>
</x-app-layout>
