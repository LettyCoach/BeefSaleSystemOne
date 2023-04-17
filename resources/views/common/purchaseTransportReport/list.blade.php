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
                <th class="text-center">送迎不可</th>
                <th class="text-center">輸送中</th>
                <th class="text-center">輸送完了</th>
                <th class="text-center">購入金額</th>
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
                    <span>{{$pastoralOxenList->whereNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$pastoralOxenList->whereNotNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$pastoralOxenList->whereNotNull('loadDate')->whereNotNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$pastoralOxenList->sum('purchasePrice')}}円</span>
                </td>
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
                <th class="text-center">送迎不可</th>
                <th class="text-center">輸送中</th>
                <th class="text-center">輸送完了</th>
                <th class="text-center">購入金額</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;    
            @endphp
            @foreach ($trasnsportCompanyOxen as $purchaseTransport_Company_id => $trasnsportCompanyOxenList)
            <tr>
                <td class="text-center">
                    <span>{{$no++ }}</span>
                </td>
                <td class="text-center">
                    <span>{{$trasnsportCompanyOxenList[0]->purchaseTransportCompany->name}}</span>
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
                    <span>{{$trasnsportCompanyOxenList->whereNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$trasnsportCompanyOxenList->whereNotNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$trasnsportCompanyOxenList->whereNotNull('loadDate')->whereNotNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$trasnsportCompanyOxenList->sum('purchasePrice')}}円</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div id="menu2" class="container tab-pane fade"><br>
    <h3 class="text-center mt-3">市場統計資料</h3>
    <table id="" class="table table-bordered table-striped" cellspacing="0"  style="min-width: 1000px; overflow-x: scroll; width:100%">
        <thead >
            <tr>
                <th class="text-center">番号</th>
                <th class="text-center">牧場</th>
                <th class="text-center">総牛マリー数</th>
                <th class="text-center">雄</th>
                <th class="text-center">雌</th>
                <th class="text-center">送迎不可</th>
                <th class="text-center">輸送中</th>
                <th class="text-center">輸送完了</th>
                <th class="text-center">購入金額</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;    
            @endphp
            @foreach ($marketOxen as $market_id => $marketOxenList)
            <tr>
                <td class="text-center">
                    <span>{{$no++ }}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList[0]->market->name}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->where('sex','=',1)->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->where('sex','=',0)->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->whereNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->whereNotNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->whereNotNull('loadDate')->whereNotNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$marketOxenList->sum('purchasePrice')}}円</span>
                </td>
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
                <th class="text-center">送迎不可</th>
                <th class="text-center">輸送中</th>
                <th class="text-center">輸送完了</th>
                <th class="text-center">購入金額</th>
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
                    <span>{{$purchaseDateList->whereNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$purchaseDateList->whereNotNull('loadDate')->whereNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$purchaseDateList->whereNotNull('loadDate')->whereNotNull('unloadDate')->count()}}</span>
                </td>
                <td class="text-center">
                    <span>{{$purchaseDateList->sum('purchasePrice')}}円</span>
                </td>
             </tr>
            @endforeach
        </tbody>
    </table>
  </div>    