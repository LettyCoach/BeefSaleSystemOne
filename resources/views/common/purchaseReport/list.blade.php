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
        <a class="nav-link" data-bs-toggle="tab" href="#menu2">市場統計資料</a>
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
                        <span class="text-gray-800 break-all">{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$pastoralOxenList[0]->pastoral->name}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$pastoralOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$pastoralOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$pastoralOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$pastoralOxenList->sum('purchasePrice')}}円</span>
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
                        <span class="text-gray-800 break-all">{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$trasnsportCompanyOxenList[0]->purchaseTransportCompany->name}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$trasnsportCompanyOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$trasnsportCompanyOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$trasnsportCompanyOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$trasnsportCompanyOxenList->sum('purchasePrice')}}円</span>
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
                        <span class="text-gray-800 break-all">{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$marketOxenList[0]->market->name}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$marketOxenList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$marketOxenList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$marketOxenList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$marketOxenList->sum('purchasePrice')}}円</span>
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
                        <span class="text-gray-800 break-all">{{$no++ }}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$purchaseDate}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$purchaseDateList->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$purchaseDateList->where('sex','=',1)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$purchaseDateList->where('sex','=',0)->count()}}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-gray-800 break-all">{{$purchaseDateList->sum('purchasePrice')}}円</span>
                    </td>
                 </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>