<x-app-layout>
    <div class="container mt-5 pt-5"  style="min-height: 600px; overflow-y: auto">
        <h2 class="pt-5 text-center fw-bold">部位情報登録</h2>
        <form method="POST" action="{{ route('parts.store') }}">
        @csrf
            @method('post')
            <div class="row mb-3 mt-3">
                <label for="name">部位名:</label>
                <input type="name" class="form-control" id="name" placeholder="" name="name" value="{{old('name',$part->name)}}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row d-flex justify-content-center">
                <button type="submit" class="col-1  btn btn-primary mx-2">セーブ</button>
                <a href="{{ route('parts.index') }}" class="col-1  btn btn-secondary mx-2">取消</a>
            </div>
            
<<<<<<< HEAD
            <div class="md:flex md:items-center">
              
                    <div class="m-auto">
                    <div class="mt-4 space-x-2">
                    <x-primary-button>{{ __('セーブ') }}</x-primary-button>
                    <x-primary-button><a href="{{ route('parts.index') }}" class="hover:no-underline text-white">{{ __('取消') }}</a></x-primary-button>
                    </div>
                    </div>

            </div>
=======
>>>>>>> e9fe6a7d417723ff2d3029718bc0954aca47c144
        </form>
    </div>
</x-app-layout>