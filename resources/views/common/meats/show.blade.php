@extends('layouts.commonUser')
@section('content')
<div class="container-sm mt-5 pt-5" style="min-height: 700px; overflow-y: auto">
    <h2 class="text-center mx-auto my-5">牛肉のディテール</h2>
    <div class="row mb-4">
        <div class="col-3">
            <label for="">個体識別番号</label>
        </div>
        <div class="col-9">
            <input type="text" readonly id="oxRegisterNumber" class="w-100" value="{{$ox->registerNumber}}" disabled />
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <label for="">和牛登録名</label>
        </div>
        <div class="col-9">
            <input type="text" readonly id="oxName" class="w-100" value="{{$ox->name}}" disabled />
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <label for="">生年月日</label>
        </div>
        <div class="col-9">
            <input type="text" readonly id="oxBirth" class="w-100" value="{{$ox->birthday}}" disabled />
        </div>
    </div>

    <div class="row mb-4 ">
        <div class="col-3">
            <label for="">性別</label>
        </div>
        <div class="col-9">
            <input type="text" readonly id="oxSex" class="w-100" value=@if($ox->sex==1) me @else female @endif disabled />
        </div>
    </div>
    <div class="row mb-4">
        <p class="col">部位</p>
        <p class="col ml-2 mr-2">重さ</p>
        <p class="col">値段</p>
    </div>
    @php
    use App\Models\Admin\Part;
    @endphp
    @foreach($ox->meats as $meat)
    <div class="row mb-4">
        <div class="col">
            <input type="text" readonly name="PartName" class="w-100" value="{{Part::find($meat->part_id)->name}}"
                onkeydown="return false">
        </div>
        <div class="col">
            <input type="text" readonly value="{{$meat->weight}}" class="w-100 ml-2 mr-2">
        </div>
        <div class="col">
            <input type="text" readonly value="{{$meat->price}}" class="w-100">
        </div>
 </div>
    @endforeach
    <a href="{{route('meats.index')}}" class="btn btn-primary mb-4">バック</a>
</div>
@endsection