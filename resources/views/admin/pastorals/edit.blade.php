<x-app-layout>
    <div class="d-flex justify-content-center align-items-center container mt-5 pt-5 mb-4"  style="min-height:calc(100vh - 300px);">
        <div class="col-md-6 mt-5 mx-auto">
            <!-- form user info -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0 text-center">牧場情報更新</h3>

                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('pastorals.update', $pastoral) }}">
                        @csrf
                        @method('patch')
                        <div class="form-group row p-2">
                            <label class="col-lg-3 col-form-label form-control-label">名前:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="name" id="inline-name"
                                    value="{{old('name',$pastoral->name)}}">
                                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label class="col-lg-3 col-form-label form-control-label">場所:</label>
                            <div class="col-lg-9">
                                <input class="form-control" id="inline-position" type="text" name="position"
                                    value="{{ old('position',$pastoral->position) }}">
                                @error('position')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label class="col-lg-3 col-form-label form-control-label">メモ:</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="inline-note" type="text"
                                    name="note">{{ old('note',$pastoral->note) }}</textarea>
                                @error('note')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row p-2 d-flex flex-content-center">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #6ea924; border: 0;"><i class="fa fa-check"></i>
                                    更新</button>
                                <a href="{{ route('pastorals.index') }}" class="btn btn-secondary"><i
                                        class="fa fa-rotate-left" aria-hidden="true"></i> 取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /form user info -->
        </div>
    </div>
</x-app-layout>