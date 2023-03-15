<x-app-layout>
    <div class="container mt-5 pt-5"  style="min-height: 600px; overflow-y: auto">
        <h2 class="pt-5 text-center fw-bold">市場情報レジスター</h2>
        <form method="POST" action="{{ route('markets.store') }}" >
        @csrf
            @method('post')
            <div class="row mb-3 mt-3">
                <label for="name">名前:</label>
                <input type="name" class="form-control" id="name" placeholder="" name="name" value="{{old('name',$market->name)}}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row mb-3">
                <label for="position">場所:</label>
                <input type="text" class="form-control" id="position" placeholder="" name="position" value="{{ old('position',$market->position) }}">
                @error('position')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row mb-3">
                <label for="note">メモ:</label>
                <textarea class="form-control" name="note" id="note" placeholder="">{{ old('note',$market->note) }}</textarea>
                @error('note')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row d-flex justify-content-center">
                <button type="submit" class="col-1  btn btn-primary mx-2">セーブ</button>
                <a href="{{ route('markets.index') }}" class="col-1  btn btn-secondary mx-2">取消</a>
            </div>
            
        </form>
    </div>
</x-app-layout>