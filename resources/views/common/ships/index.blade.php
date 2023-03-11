@extends('layouts.commonUser')
@section('content')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
    <h2 class="text-center text-3xl font-bold mt-4 mb-4">出荷指示</h2>
    
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
        <div class="" name="SelectCompany">
            <!-- <label for="SelectCompany">牧場</label> -->
            <select class="rounded" name="pastoralName" id="pastoralId" onchange="getShipList()">
                <option value="0" selected>全て(牧場)</option>
                @foreach($Pastorals as $Pastoral)
                <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="" name="SelectCompany">
            <!-- <label for="SelectCompany">牧場</label> -->
            <select class="rounded" name="transportCompanyName" id="transportCompanyId" onchange="getShipList()">
                <option value="0" selected>全て(運送会社)</option>
                @foreach($TransportCompanies as $TransportCompany)
                <option value="{{$TransportCompany->id}}">{{$TransportCompany->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="showAddShipModal()">
            <i class="fas fa-plus"></i>&nbsp;
            出荷指示追加
        </button>
    </div>
    

    <div class="flex flex-col" id="shipData">
        
    </div>

    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="AddShipModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h1 class="text-3xl text-center mb-6">出荷指示追加</h1>
                    <p id="oxId" class="hidden"></p>
                    <div class="d-flex">
                        <div class="d-flex flex-col w-1/2 pr-1">
                            <p>牧場選択</p>
                            <select class="p-2 mt-2 mb-3 rounded" id="pastoralAddShip" onchange="getOxRegisterNumberListByPastoral()">
                                @foreach($Pastorals as $Pastoral)
                                <option value="{{$Pastoral->id}}">{{$Pastoral->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-col w-1/2 pl-1">
                            <p>運送会社選択</p>
                            <select class="p-2 mt-2 mb-3 rounded" id="">
                                @foreach($TransportCompanies as $TransportCompany)
                                <option value="{{$TransportCompany->id}}">{{$TransportCompany->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-col w-1/2 pr-1">
                            <p>牛選択</p>
                            <select class="p-2 mt-2 mb-3 rounded" id="oxRegisterNumberByPastoral" onchange="getOxNameById()">

                            </select>
                        </div>
                        <div class="d-flex flex-col w-1/2 pl-1">
                            <p>和牛登録名</p>
                            <input type="text" id="oxNameById" class="w-full bg-gray-100 p-2 mt-2 mb-3 rounded" disabled />
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-col w-1/2 pr-1">
                            <p>日付選択</p>
                            <input type="date" id="oxBirth" class="w-full bg-gray-100 p-2 mt-2 mb-3 rounded" value="{{$todayDate}}" placeholder="" />
                        </div>
                        <div class="d-flex flex-col w-1/2 pl-1">
                            <p>行き先選択</p>
                            <select class="p-2 mt-2 mb-3 rounded" id="">
                                @foreach($SlaughterHouses as $SlaughterHouse)
                                <option value="{{$SlaughterHouse->id}}">{{$SlaughterHouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 mr-2" onclick="saveAppendInfo()"><i class="fas fa-save"></i> セーブ</button>
                    <button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 mr-2" onclick="closeAddShipModal()"><i class="fas fa-times"></i> 取消</button>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="successModal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-4xl">正常に更新されました!</h2>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-gray-700 mr-2" onclick="closeModal()"><i class="fas fa-check"></i> いいよ</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/common/ship.js') }}"></script>
@endsection