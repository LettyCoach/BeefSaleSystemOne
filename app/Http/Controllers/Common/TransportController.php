<?php

namespace App\Http\Controllers\Common;
use App\Models\Admin\TransportCompany;
use App\Models\Admin\Pastoral;
use App\Models\Common\Ox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        $TransportCompanies = TransportCompany::all();
        $Pastorals = Pastoral::all();
        $todayDate = Date('Y-m-d');
        $month = strtotime("-1 Months");
        $firstDate = date('Y-m-d', $month);

        return view( 'common.transports.index', [
            'TransportCompanies' => $TransportCompanies,
            'Pastorals' => $Pastorals,
            'todayDate' => $todayDate,
            'firstDate' => $firstDate,
        ]);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $registerType = $request->registerType;
        $OxId = $request->OxId;
        $LoadDate = $request->LoadDate;
        
        $Ox = Ox::find($OxId);

        if($registerType == 'load') {
            $Ox->loadDate = $LoadDate;
            $Ox->save();
        }

        if($registerType == 'unload') {
            $Ox->unloadDate = $LoadDate;
            $Ox->save();
        }

        return "OK";
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {

    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        //
    }

    public function getPurchaseTransportList(Request $request) {
        $transportCompanyId = $request->transportCompanyId;
        $firstDate = $request->firstDate;
        $lastDate = $request->lastDate;
        $pastoralId = $request->pastoralId;
        $pageSize = $request->pageSize;
        $loadType = $request->loadType;
        $loadState = $request->loadState;
        $pageNumber = $request->pageNumber;

        if($firstDate > $lastDate) {
            return "Date Error";
        }

        $purchaseTransports =  Ox::whereNotNull('purchaseDate');
        $totalCnt = $purchaseTransports->count();

        if($transportCompanyId != 0) {
            $purchaseTransports = $purchaseTransports->where('purchaseTransport_Company_id', $transportCompanyId);
            $totalCnt = $purchaseTransports->count();
        }

        if($pastoralId != 0) {
            $purchaseTransports = $purchaseTransports->where('pastoral_id', $pastoralId);
            $totalCnt = $purchaseTransports->count();
        }

        if($loadType == 0 && $loadState == 1) {
            $purchaseTransports = $purchaseTransports->whereNull('loadDate')->whereNull('unloadDate');
            $totalCnt = $purchaseTransports->count();
        }

        if($loadType == 0 && $loadState == 2) {
            $purchaseTransports = $purchaseTransports
                ->whereNotNull('loadDate')
                ->where('loadDate', '>=', $firstDate)
                ->where('loadDate', '<=', $lastDate);
            $totalCnt = $purchaseTransports->count();
        }

        if($loadType == 1 && $loadState == 0) {
            $purchaseTransports = $purchaseTransports->whereNotNull('loadDate');
            $totalCnt = $purchaseTransports->count();
        }

        if($loadType == 1 && $loadState == 1) {
            $purchaseTransports = $purchaseTransports->whereNotNull('loadDate')->whereNull('unloadDate');
            $totalCnt = $purchaseTransports->count();
        }

        if($loadType == 1 && $loadState == 2) {
            $purchaseTransports = $purchaseTransports->whereNotNull('loadDate')->whereNotNull('unloadDate');
            $totalCnt = $purchaseTransports->count();
        }

        $purchaseTransports = $purchaseTransports->orderBy('updated_at', 'desc')
            ->limit($pageSize)->
            offset(($pageNumber - 1) * $pageSize)
            ->get();

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }
        
        return view('common.transports.list')
            ->with('purchaseTransports', $purchaseTransports)
            ->with('pageNumber', $pageNumber)
            ->with('pageSize', $pageSize)
            ->with('totalCnt', $totalCnt)
            ->with('loadType', $loadType)
            ->with('pageCnt', $pageCnt);
    }

    public function getPurchaseTransDataByOxId(Request $request) {
        $id = $request->OxId;
        $rlt = Ox::find($id);
        
        return $rlt;
    }
}
