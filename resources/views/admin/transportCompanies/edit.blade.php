<x-app-layout>
    <div class="container mt-5 pt-5"  style="min-height: 600px; overflow-y: auto">
        <h2 class="pt-5 text-center fw-bold">運送会社情報アップデート</h2>
        <form method="POST" action="{{ route('transportCompanies.update', $transportCompany) }}">
        @csrf
            @method('patch')
            <div class="row mb-3 mt-3">
                <label for="name">名前:</label>
                <input type="name" class="form-control" id="name" placeholder=""  name="name" value="{{old('name',$transportCompany->name)}}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row mb-3">
                <label for="position">場所:</label>
                <input type="text" class="form-control" id="position" placeholder="" name="position" value="{{ old('position',$transportCompany->position) }}">
                @error('position')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row mb-3">
                <label for="note">メモ:</label>
                <textarea class="form-control" name="note" id="note" placeholder="">{{ old('note',$transportCompany->note) }}</textarea>
                @error('note')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="row d-flex justify-content-center">
                <button type="submit" class="col-2  btn btn-primary mx-2">アップデート</button>
                <a href="{{ route('transportCompanies.index') }}" class="col-2  btn btn-secondary mx-2">取消</a>
            </div>
            
        </form>
    </div>
</x-app-layout>