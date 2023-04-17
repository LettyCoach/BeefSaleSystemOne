<div id="home" class="container tab-pane active"><br>
    <h3 class="text-center mt-3">牧場統計資料</h3>
    <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 3000px; overflow-x: scroll; width:100%">
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
                    $totalAmount = 0;
                @endphp
                 @foreach ($parts as $partItem)
                    @php
                        $weight[$partItem->id] = 0;
                        $price[$partItem->id] = 0;
                        $avePrice[$partItem->id] = 0;
                    @endphp    
                @endforeach
                @foreach ($pastoralOxenList as $oxItem)

                    @foreach ($oxItem->parts as $partItem)
                        @php
                            $weight[$partItem->id] += $partItem->pivot->weight;
                            $price[$partItem->id] += $partItem->pivot->price;
                        @endphp
                    @endforeach
                @endforeach
                @foreach ($parts as $partItem)
                    @php
                        $totalWeight += $weight[$partItem->id];
                        $avePrice[$partItem->id] = $price[$partItem->id]/$pastoralOxenList->count();
                        $partTotalAmount= $weight[$partItem->id]*$avePrice[$partItem->id];
                        $totalAmount += $partTotalAmount;
                    @endphp
                    <td>{{$weight[$partItem->id]}}</td> 
                    <td>{{round($avePrice[$partItem->id],2,PHP_ROUND_HALF_EVEN)}}</td>   
                @endforeach
                    
                <td>{{$totalWeight}}</td>
                <td>{{round($totalAmount,2,PHP_ROUND_HALF_EVEN)}}</td>
                
             </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div id="menu1" class="container tab-pane fade"><br>
    <h3 class="text-center mt-3">運送会社統計資料</h3>
    <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 3000px; overflow-x: scroll; width:100%">
        <thead >
            <tr>
                <th class="text-center">番号</th>
                <th class="text-center">運送会社</th>
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
                    $totalAmount = 0;
                @endphp
                 @foreach ($parts as $partItem)
                    @php
                        $weight[$partItem->id] = 0;
                        $price[$partItem->id] = 0;
                        $avePrice[$partItem->id] = 0;
                    @endphp    
                @endforeach
                @foreach ($pastoralOxenList as $oxItem)

                    @foreach ($oxItem->parts as $partItem)
                        @php
                            $weight[$partItem->id] += $partItem->pivot->weight;
                            $price[$partItem->id] += $partItem->pivot->price;
                        @endphp
                    @endforeach
                @endforeach
                @foreach ($parts as $partItem)
                    @php
                        $totalWeight += $weight[$partItem->id];
                        $avePrice[$partItem->id] = $price[$partItem->id]/$pastoralOxenList->count();
                        $partTotalAmount= $weight[$partItem->id]*$avePrice[$partItem->id];
                        $totalAmount += $partTotalAmount;
                    @endphp
                    <td>{{$weight[$partItem->id]}}</td> 
                    <td>{{round($avePrice[$partItem->id],2,PHP_ROUND_HALF_EVEN)}}</td>   
                @endforeach
                    
                <td>{{$totalWeight}}</td>
                <td>{{round($totalAmount,2,PHP_ROUND_HALF_EVEN)}}</td>
                
             </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div id="menu2" class="container tab-pane fade"><br>
    <h3 class="text-center mt-3">屠殺場統計資料</h3>
    <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 3000px; overflow-x: scroll; width:100%">
        <thead >
            <tr>
                <th class="text-center">番号</th>
                <th class="text-center">屠殺場</th>
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
                    $totalAmount = 0;
                @endphp
                 @foreach ($parts as $partItem)
                    @php
                        $weight[$partItem->id] = 0;
                        $price[$partItem->id] = 0;
                        $avePrice[$partItem->id] = 0;
                    @endphp    
                @endforeach
                @foreach ($slaughterHouseOxenList as $oxItem)

                    @foreach ($oxItem->parts as $partItem)
                        @php
                            $weight[$partItem->id] += $partItem->pivot->weight;
                            $price[$partItem->id] += $partItem->pivot->price;
                        @endphp
                    @endforeach
                @endforeach
                @foreach ($parts as $partItem)
                    @php
                        $totalWeight += $weight[$partItem->id];
                        $avePrice[$partItem->id] = $price[$partItem->id]/$pastoralOxenList->count();
                        $partTotalAmount= $weight[$partItem->id]*$avePrice[$partItem->id];
                        $totalAmount += $partTotalAmount;
                    @endphp
                    <td>{{$weight[$partItem->id]}}</td> 
                    <td>{{round($avePrice[$partItem->id],2,PHP_ROUND_HALF_EVEN)}}</td>   
                @endforeach
                    
                <td>{{$totalWeight}}</td>
                <td>{{round($totalAmount,2,PHP_ROUND_HALF_EVEN)}}</td>
                
             </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div id="menu3" class="container tab-pane fade"><br>
    <h3 class="text-center mt-3">日付統計資料</h3>
    <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 3000px; overflow-x: scroll; width:100%">
        <thead >
            <tr>
                <th class="text-center">番号</th>
                <th class="text-center">日付</th>
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
                    $totalAmount = 0;
                @endphp
                 @foreach ($parts as $partItem)
                    @php
                        $weight[$partItem->id] = 0;
                        $price[$partItem->id] = 0;
                        $avePrice[$partItem->id] = 0;
                    @endphp    
                @endforeach
                @foreach ($purchaseDateList as $oxItem)

                    @foreach ($oxItem->parts as $partItem)
                        @php
                            $weight[$partItem->id] += $partItem->pivot->weight;
                            $price[$partItem->id] += $partItem->pivot->price;
                        @endphp
                    @endforeach
                @endforeach
                @foreach ($parts as $partItem)
                    @php
                        $totalWeight += $weight[$partItem->id];
                        $avePrice[$partItem->id] = $price[$partItem->id]/$purchaseDateList->count();
                        $partTotalAmount= $weight[$partItem->id]*$avePrice[$partItem->id];
                        $totalAmount += $partTotalAmount;
                    @endphp
                    <td>{{$weight[$partItem->id]}}</td> 
                    <td>{{round($avePrice[$partItem->id],2,PHP_ROUND_HALF_EVEN)}}</td>   
                @endforeach
                    
                <td>{{$totalWeight}}</td>
                <td>{{round($totalAmount,2,PHP_ROUND_HALF_EVEN)}}</td>
                
             </tr>
            @endforeach
        </tbody>
    </table>
  </div>