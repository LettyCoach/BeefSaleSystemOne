<x-app-layout>
    <div class="max-w-2xl shadow-lg mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-center text-3xl font-bold mb-5">Market Information Update</h2>
        <form method="POST" action="{{ route('markets.update', $market) }}" class="max-w-2xl">
            @csrf
            @method('patch')
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-full-name">
                        Market Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="name" placeholder="{{__('Please put market\'s name')}}" class="p-2 text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{old('name',$market->name)}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-password">
                        Market Position
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="position" placeholder="{{ __('Please put market\'s position') }}"
                        class="p-2 text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{ old('position',$market->position) }}">
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-left text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-password">
                        Note
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea name="note" placeholder="{{ __('note') }}"
                        class=" text-lg block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('note',$market->note) }}</textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <div class="mt-4 space-x-2">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('markets.index') }}">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>