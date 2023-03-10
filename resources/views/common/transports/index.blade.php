@extends('layouts.commonUser')
@section('content')
    <!-- <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
        <h2 class="text-center text-3xl font-bold mt-4 mb-4">PurchasesTransports</h2>
       
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
                    
                </div>

            </div>
        </div>
        <div class="">
            <label for="TransportCompany Select">TransportCompany Select</label>
            <select name="" id="sel" class="" onchange="selectTransportCompanyFunction()">
                    <option value="">all</option>
                @foreach($transportCompanies as $transportCompany)
                    <option value="{{$transportCompany->id}}" id="{{$transportCompany->id}}" class="">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="">
            <table>
                <thead>
                    <th>No</th>
                    <th>load</th>
                    <th>target</th>
                    <th>registerNumber</th>
                    <th>name</th>
                    <th>birthday</th>
                    <th>sex</th>
                </thead>
                <tbody>
                    @php
                        $counter =1;
                    @endphp
                    @foreach($transportCompanies as $transportCompany)
                        @foreach($transportCompany->oxen as $ox)
                        <tr id="tr{{$transportCompany->id}}">
                            <td>{{$counter++}}</td>
                            <td>
                                <select name="" id="">
                                    <option value="">完了</option>
                                    <option value="">未</option>
                                </select>
                            </td>
                            <td>{{$ox->pastoral->name}}</td>
                            <td>{{$ox->registerNumber}}</td>
                            <td>{{$ox->name}}</td>
                            <td>{{$ox->birthday}}</td>
                            <td>@if($ox->sex==1) m @else fem @endif</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <script>
                function selectTransportCompanyFunction(){
                    if(document.querySelector("#sel").selectedIndex != 0){
                        const trnodeList = document.querySelectorAll("tbody tr");
                        for (let i = 0; i < trnodeList.length; i++) {
                            trnodeList[i].style.display = "none";
                        }
                        const company_id = document.querySelector("#sel");
                        const trnodeNoneList = document.querySelectorAll("#tr"+company_id.value);
                        for (let i = 0; i < trnodeNoneList.length; i++) {
                            trnodeNoneList[i].style.display = "block";
                        }
                    }else{
                        const trnodeList = document.querySelectorAll("tbody tr");
                        for (let i = 0; i < trnodeList.length; i++) {
                            trnodeList[i].style.display = "block";
                        }
                    }                    
                }
            </script>
    </div> 
    -->
    <div class="navbar">
        <div class="" name="SelectCompany">
            <label for="SelectCompany">SelectCompany</label>
            <select name="SelectCompany" id="SelectCompany" onchange="selectCompanyFunction()">
                @foreach($transportCompanies as $transportCompany)
                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="" id="statu" name="statu">
            <label for="Statu">Statu</label>
            <select name="" id="">
                <option value="">mi</option>
                <option value="">finish</option>
            </select>
        </div>
        <div class="search">
            <button class="search">
                Search
            </button>
        </div>
    </div>

    <div class="content" id="content">
    </div>

    <script>
        $(document).ready(function () {  

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({         
                url: "{{ route('transports.list')}}",
                type: "POST",
                // data:
            // dataType: 'json',
                success: function (data) {
                    $('#content').html(data);
                //  alert(data);
                
                },
                error: function (data) {
                    console.log('Error:', data);
                    
                }
            })();
        });
    </script>
@endsection