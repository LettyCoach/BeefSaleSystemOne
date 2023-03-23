<div class="container mt-3">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#home">牧場統計資料</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu1">運送会社統計資料</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu2">屠殺場統計資料</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu3">日付統計資料</a>
      </li>
    </ul>
  
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <h3 class="text-center mt-3">牧場統計資料</h3>
        <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
            <thead >
                <tr>
                    <th class="text-center">番号</th>
                    <th class="text-center">牧場</th>
                    <th class="text-center">総牛マリー数</th>
                    <th class="text-center">雄</th>
                    <th class="text-center">雌</th>
                    <th class="text-center">精肉受付中</th>
                    <th class="text-center">精肉受付完了</th>
                    @foreach ($parts as $partItem)
                        <th>{{$partItem->name}}</th>
                        <th>価格</th>   
                    @endforeach
                    <th>総重量</th>
                    <th>平均価格</th>
                    <th>総金額</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($pastoralOxen as $pastoral_id => $pastoralOxenList)
                <tr>
                    <td class="text-center">
                        <span>{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList[0]->pastoral->name}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 0)
                                                    ->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$pastoralOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 1)
                                                    ->count()}}</span>
                    </td>
                    @php
                        $totalWeight = 0;
                        $totalPrice = 0;
                    @endphp
                     @foreach ($parts as $partItem)
                        @php
                            $weight[$partItem->id] = 0;
                            $price[$partItem->id] = 0;
                        @endphp    
                    @endforeach
                    @foreach ($pastoralOxenList as $oxItem)
                        @foreach ($parts as $partItem)
                            @php
                                $weight[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('weight');
                                $price[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('price');
                            @endphp
                        @endforeach
                    @endforeach
                    @foreach ($parts as $partItem)
                        @php
                            $totalWeight += $weight[$partItem->id];
                            $totalPrice += $price[$partItem->id];
                        @endphp
                        <td>{{$weight[$partItem->id]}}</td> 
                        <td>{{$price[$partItem->id]}}</td>   
                    @endforeach
                        @php
                            $totalPrice /=$parts->count();
                            $totalPrice = floor($totalPrice);
                        @endphp
                    <td>{{$totalWeight}}</td>
                    <td>{{$totalPrice}}</td>
                    <td>{{$totalWeight*$totalPrice}}</td>
                    
                 </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div id="menu1" class="container tab-pane fade"><br>
        <h3 class="text-center mt-3">運送会社統計資料</h3>
        <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
            <thead >
                <tr>
                    <th class="text-center">番号</th>
                    <th class="text-center">牧場</th>
                    <th class="text-center">総牛マリー数</th>
                    <th class="text-center">雄</th>
                    <th class="text-center">雌</th>
                    <th class="text-center">精肉受付中</th>
                    <th class="text-center">精肉受付完了</th>
                    @foreach ($parts as $partItem)
                        <th>{{$partItem->name}}</th>
                        <th>価格</th>   
                    @endforeach
                    <th>総重量</th>
                    <th>平均価格</th>
                    <th>総金額</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($trasnsportCompanyOxen as $slaughterTransport_Company_id => $trasnsportCompanyOxenList)
                <tr>
                    <td class="text-center">
                        <span>{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList[0]->slaughterTransportCompany->name}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 0)
                                                    ->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$trasnsportCompanyOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 1)
                                                    ->count()}}</span>
                    </td>
                    @php
                        $totalWeight = 0;
                        $totalPrice = 0;
                    @endphp
                     @foreach ($parts as $partItem)
                        @php
                            $weight[$partItem->id] = 0;
                            $price[$partItem->id] = 0;
                        @endphp    
                    @endforeach
                    @foreach ($trasnsportCompanyOxenList as $oxItem)
                        @foreach ($parts as $partItem)
                            @php
                                $weight[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('weight');
                                $price[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('price');
                            @endphp
                        @endforeach
                    @endforeach
                    @foreach ($parts as $partItem)
                        @php
                            $totalWeight += $weight[$partItem->id];
                            $totalPrice += $price[$partItem->id];
                        @endphp
                        <td>{{$weight[$partItem->id]}}</td> 
                        <td>{{$price[$partItem->id]}}</td>   
                    @endforeach
                        @php
                            $totalPrice /=$parts->count();
                            $totalPrice = floor($totalPrice);
                        @endphp
                    <td>{{$totalWeight}}</td>
                    <td>{{$totalPrice}}</td>
                    <td>{{$totalWeight*$totalPrice}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div id="menu2" class="container tab-pane fade"><br>
        <h3 class="text-center mt-3">屠殺場統計資料</h3>
        <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
            <thead >
                <tr>
                    <th class="text-center">番号</th>
                    <th class="text-center">牧場</th>
                    <th class="text-center">総牛マリー数</th>
                    <th class="text-center">雄</th>
                    <th class="text-center">雌</th>
                    <th class="text-center">精肉受付中</th>
                    <th class="text-center">精肉受付完了</th>
                    @foreach ($parts as $partItem)
                        <th>{{$partItem->name}}</th>
                        <th>価格</th>   
                    @endforeach
                    <th>総重量</th>
                    <th>平均価格</th>
                    <th>総金額</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($slaughterHouseOxen as $slaughterHouse_id => $slaughterHouseOxenList)
                <tr>
                    <td class="text-center">
                        <span>{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList[0]->slaughterHouse->name}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 0)
                                                    ->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$slaughterHouseOxenList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 1)
                                                    ->count()}}</span>
                    </td>
                    @php
                        $totalWeight = 0;
                        $totalPrice = 0;
                    @endphp
                     @foreach ($parts as $partItem)
                        @php
                            $weight[$partItem->id] = 0;
                            $price[$partItem->id] = 0;
                        @endphp    
                    @endforeach
                    @foreach ($slaughterHouseOxenList as $oxItem)
                        @foreach ($parts as $partItem)
                            @php
                                $weight[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('weight');
                                $price[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('price');
                            @endphp
                        @endforeach
                    @endforeach
                    @foreach ($parts as $partItem)
                        @php
                            $totalWeight += $weight[$partItem->id];
                            $totalPrice += $price[$partItem->id];
                        @endphp
                        <td>{{$weight[$partItem->id]}}</td> 
                        <td>{{$price[$partItem->id]}}</td>   
                    @endforeach
                        @php
                            $totalPrice /=$parts->count();
                            $totalPrice = floor($totalPrice);
                        @endphp
                    <td>{{$totalWeight}}</td>
                    <td>{{$totalPrice}}</td>
                    <td>{{$totalWeight*$totalPrice}}</td>
                 </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div id="menu3" class="container tab-pane fade"><br>
        <h3 class="text-center mt-3">日付統計資料</h3>
        <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
            <thead >
                <tr>
                    <th class="text-center">番号</th>
                    <th class="text-center">牧場</th>
                    <th class="text-center">総牛マリー数</th>
                    <th class="text-center">雄</th>
                    <th class="text-center">雌</th>
                    <th class="text-center">精肉受付中</th>
                    <th class="text-center">精肉受付完了</th>
                    @foreach ($parts as $partItem)
                        <th>{{$partItem->name}}</th>
                        <th>価格</th>   
                    @endforeach
                    <th>総重量</th>
                    <th>平均価格</th>
                    <th>総金額</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($purchaseDates as $purchaseDate => $purchaseDateList)
                <tr>
                    <td class="text-center">
                        <span>{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDate}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDateList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDateList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDateList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDateList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 0)
                                                    ->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span>{{$purchaseDateList->whereNotNull('acceptedDateSlaughterHouse')
                                                    ->whereNotNull('slaughterFinishedDate')
                                                    ->where('finishedState', '=', 1)
                                                    ->count()}}</span>
                    </td>
                    @php
                        $totalWeight = 0;
                        $totalPrice = 0;
                    @endphp
                     @foreach ($parts as $partItem)
                        @php
                            $weight[$partItem->id] = 0;
                            $price[$partItem->id] = 0;
                        @endphp    
                    @endforeach
                    @foreach ($purchaseDateList as $oxItem)
                        @foreach ($parts as $partItem)
                            @php
                                $weight[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('weight');
                                $price[$partItem->id] += $oxItem->meats()->where('part_id','=', $partItem->id)->value('price');
                            @endphp
                        @endforeach
                    @endforeach
                    @foreach ($parts as $partItem)
                        @php
                            $totalWeight += $weight[$partItem->id];
                            $totalPrice += $price[$partItem->id];
                        @endphp
                        <td>{{$weight[$partItem->id]}}</td> 
                        <td>{{$price[$partItem->id]}}</td>   
                    @endforeach
                        @php
                            $totalPrice /=$parts->count();
                            $totalPrice = floor($totalPrice);
                        @endphp
                    <td>{{$totalWeight}}</td>
                    <td>{{$totalPrice}}</td>
                    <td>{{$totalWeight*$totalPrice}}</td>
                 </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>