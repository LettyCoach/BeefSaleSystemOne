@extends('layouts.commonUser')
@section('content')
<div class="justify-content-center mt-5 pt-5 mb-4">
    <div class="col-md-6 mt-5 mx-auto">
        <!-- form user info -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0 text-center">牛肉のディテール</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('purchases.store') }}" autocomplete="off" class="form" role="form">
                    @csrf
                    @method('post')
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">個体識別番号</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly id="oxRegisterNumber" name="registerNumber"
                                value="{{$ox->registerNumber}}" disabled />
                            @error('registerNumber')<div class="text-danger">{{ $message }}</div>@enderror
                            @if($message = Session::get('info'))
                            <div class="text-danger">{{$message}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">和牛登録名</label>
                        <div class="col-lg-9">
                            <input type="text" readonly id="name" class="form-control" value="{{$ox->name}}"
                                disabled />
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">生年月日</label>
                        <div class="col-lg-9">
                            <input type="text" name="birthday" readonly id="oxBirth" class="form-control" value="{{$ox->birthday}}"
                                disabled />
                            @error('birthday')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">性別</label>
                        <div class="col-lg-9">
                            <input type="text" readonly id="oxSex" class="form-control" value=@if($ox->sex==1) 雄 @else 雌 @endif
                            disabled />
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="row mt-2">
                            <p class="col-4 text-center">部位</p>
                            <p class="col-4 text-center">重さ</p>
                            <p class="col-4 text-center">値段</p>
                        </div>
                    </div>
                    @php
                    use App\Models\Admin\Part;
                    @endphp
                    @foreach($ox->meats as $meat)
                    <div class="row mb-4 p-2">
                        <div class="col">
                            <input type="text" readonly name="PartName" class="form-control"
                                value="{{Part::find($meat->part_id)->name}}" onkeydown="return false">
                        </div>
                        <div class="col">
                            <input type="text" readonly value="{{$meat->weight}}" class="form-control">
                        </div>
                        <div class="col">
                            <input type="text" readonly value="{{$meat->price}}" class="form-control">
                        </div>
                    </div>
                    @endforeach


                </form>
                <div class="row mb-4 ">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="{{route('meats.index')}}" class="btn btn-secondary mb-4 mx-auto"><i
                                class="fa fa-rotate-left" aria-hidden="true"></i> バック</a>
                    </div>
                </div>
            </div>
        </div><!-- /form user info -->
    </div>
</div>
@endsection