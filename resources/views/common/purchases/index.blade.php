@extends('layouts.commonUser')
@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
        <h2 class="text-center text-3xl font-bold mt-4 mb-4">仕入リスト</h2>
       
        @if($message = Session::get('updateSuccess'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove" style="color:rgb(121, 121, 121)"></i></button>
                <strong>{{$message}}</strong>
            </div>
        @endif
        @if($message = Session::get('registerSuccess'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove" style="color:rgb(121, 121, 121)"></i></button>
                <strong>{{$message}}</strong>
            </div>
        @endif

        @if($message = Session::get('deleteSuccess'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove" style="color:rgb(121, 121, 121)"></i></button>
                <strong>{{$message}}</strong>
            </div>
        @endif
        
        <div class="flex justify-between items-center">
            <div class="">
            
            </div>
            <div class="flex justify-end items-center">
                <div class="rounded-md">
                    <x-primary-button><a href="{{ route('purchases.create') }}" class="hover:no-underline text-white">{{ __('添加') }}</a></x-primary-button>
                    <!-- <i class="fa fa-plus" style="color:white"></i> -->
                </div>

            </div>
        </div>
        

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full table-fixed text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 ">番号</th>
                                    <th scope="col" class="px-6 py-4 ">個体識別番号</th>
                                    <th scope="col" class="px-6 py-4 ">和牛登録名</th>
                                    <th scope="col" class="px-6 py-4 ">生年月日</th>
                                    <th scope="col" class="px-6 py-4 ">性別</th>
                                    <th scope="col" class="px-6 py-4 ">購入場所</th>
                                    <th scope="col" class="px-6 py-4 ">運送会社</th>
                                    <th scope="col" class="px-6 py-4 ">搬送先</th>
                                    <th scope="col" class="px-6 py-4 ">購入金額</th>
                                    <th scope="col" class="px-6 py-4 ">活動</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($oxen as $ox)
                                <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-200 dark:hover:bg-neutral-400">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$counter++}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$ox->registerNumber}}</span>
                                    </td>
                                    <td class="hitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$ox->name}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                                        <span class="text-gray-800 break-all">{{$ox->birthday}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$ox->market->name}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$ox->purchaseTransportCompany->name}}</span>
                                    </td>
                                    <td class="hitespace-nowrap px-6 py-2 font-medium ">
                                        <span class="text-gray-800 break-all">{{$ox->pastoral->name}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                                        <span class="text-gray-800 break-all">{{$ox->purchasePrice}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium  ">
                                        <small
                                            class="ml-2 break-all text-gray-600">@if($ox->sex==1) 雄 @else 雌 @endif</small>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium w-10">
                                        <a href="{{route('purchases.edit', $ox)}}" class="p-2"><i class="fa fa-check"
                                                style="color: rgb(121, 121, 121)"></i></a>
                                        <form method="POST" id="deleteForm" action="{{route('purchases.destroy',$ox->id)}}"
                                            class="inline-block p-2">
                                            @csrf
                                            @method('delete')
                                            <a href="" onclick="deleteFunction()">
                                                <i class="fa fa-remove" style="color:rgb(121, 121, 121)"></i>
                                            </a>
                                            <script>
                                                function deleteFunction() {
                                                let text = "本当に削除しますか?";
                                                    if (confirm(text) == true) {
                                                        event.preventDefault(); 
                                                        document.getElementById('deleteForm').submit();
                                                    }else
                                                        event.preventDefault(); 
                                                }
                                                </script>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

@endsection