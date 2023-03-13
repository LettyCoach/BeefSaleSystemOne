@extends('layouts.commonUser')
@section('content')
<div class="bg-white max-w-7xl m-auto px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <h2 class="text-center text-2xl mb-4">牛肉のディテール</h2>
    <div class="d-flex">
        <div class="d-flex flex-col w-1/2 pr-1">
            <p>個体識別番号</p>
            <input type="text" value="{{$ox->registerNumber}}" id="oxRegisterId"
                class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
        </div>
        <div class="d-flex flex-col w-1/2 pl-1">
            <p>和牛登録名</p>
            <input type="text" value="{{$ox->name}}" id="oxName" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
        </div>
    </div>
    <div class="d-flex">
        <div class="d-flex flex-col w-1/2 pr-1">
            <p>生年月日</p>
            <input type="text" value="{{$ox->birthday}}" id="oxBirth" class="w-full bg-gray-100 p-2 mt-2 mb-3"
                disabled />
        </div>
        <div class="d-flex flex-col w-1/2 pl-1">
            <p>性別</p>
            <input type="text" value="{{$ox->sex}}" id="oxSex" class="w-full bg-gray-100 p-2 mt-2 mb-3" disabled />
        </div>
    </div>
    <div class="d-flex flex flex-col ">
        <div class="w-full flex flex-row mb-2 ">
            <p class="w-1/3 text-center">部位</p>
            <p class="w-1/3 text-center ml-2 mr-2">重さ</p>
            <p class="w-1/3 text-center">値段</p>
        </div>
        @php
          use App\Models\Admin\Part;
        @endphp
        @foreach($ox->meats as $meat)
        <div class="w-full flex flex-row mb-2">
            <input type="text" name="PartName" class="w-1/3" value="{{Part::find($meat->part_id)->name}}"
                onkeydown="return false">
            <input type="text" value="{{$meat->weight}}" class="w-1/3 ml-2 mr-2">
            <input type="text" value="{{$meat->price}}" class="w-1/3">
        </div>
        @endforeach
        <a href="{{route('meats.index')}}" class="text-white items-center bg-gradient-to-r w-1/6 from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">バック</a>
    </div>
</div>
@endsection