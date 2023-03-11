@extends('layouts.commonUser')
@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
    <h2 class="text-center mb-6 text-xl">仕入登録</h2>
    @if($message = Session::get('info'))
    <div class="max-w-7xl alert alert-info alert-block m-auto mb-4" style="width:350px">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                style="color:rgb(121, 121, 121)"></i></button>
        <strong>{{$message}}</strong>
    </div>
    @endif
    <form method="POST" action="{{ route('purchases.update',$ox->id) }}" class="w-full max-w-sm m-auto">
        @csrf
        @method('patch')
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    for="inline-registerNumber">
                    個体識別番号
                </label>
            </div>
            <div class="md:w-2/3">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="registerNumber" id="inline-registerNumber" type="text"
                    value="{{old('registerNumber',$ox->registerNumber)}}">
                <x-input-error :messages="$errors->get('registerNumber')" class="mt-2" />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-name">
                    和牛登録名
                </label>
            </div>
            <div class="md:w-2/3">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="name" id="inline-name" type="text" value="{{old('name',$ox->name)}}">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-birthday">
                    生年月日
                </label>
            </div>
            <div class="md:w-2/3">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="birthday" id="inline-birthday" type="text" value="{{old('birthday',$ox->birthday)}}">
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="sex" class="block  text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">性別</label>
            </div>
            <div class="md:w-2/3">
                <select id="sex" name="sex"
                    class="block w-full p-2 font-bold text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" selected>雄</option>
                    <option value="0">雌</option>
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="market_id" class="block  text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">購入場所</label>
            </div>
            <div class="md:w-2/3">
                <select id="market_id" name="market_id"
                    class="block w-full p-2 font-bold text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($markets as $market)
                    <option value="{{$market->id}}">{{$market->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="purchaseTransport_Company_id"
                    class="block  text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">運送会社</label>
            </div>
            <div class="md:w-2/3">

                <select id="purchaseTransport_Company_id" name="purchaseTransport_Company_id"
                    class="block w-full p-2 font-bold text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($transportCompanies as $transportCompany)
                    <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="pastoral_id"
                    class="block  text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">搬送先</label>
            </div>
            <div class="md:w-2/3">
                <select id="pastoral_id" name="pastoral_id"
                    class="block w-full p-2 font-bold text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($pastorals as $pastoral)
                    <option value="{{$pastoral->id}}">{{$pastoral->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-purchasePrice">
                    購入金額
                </label>
            </div>
            <div class="md:w-2/3">
                <input name="purchasePrice"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="inline-purchasePrice" type="text" value="{{$ox->purchasePrice}}">
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <div class="mt-4 space-x-2 flex">
                    <x-primary-button>{{ __('アップデート') }}</x-primary-button>
                    <x-primary-button><a href="{{ route('purchases.index') }}" class="hover:no-underline text-white">{{ __('キャンセル') }}</a></x-primary-button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection