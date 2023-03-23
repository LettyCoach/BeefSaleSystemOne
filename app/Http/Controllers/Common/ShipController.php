<?php

namespace App\Http\Controllers\Common;

use App\Models\Admin\TransportCompany;
use App\Models\Admin\SlaughterHouse;
use App\Models\Admin\Pastoral;
use App\Models\Common\Ox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TransportCompanies = TransportCompany::all();
        $Pastorals = Pastoral::all();
        $SlaughterHouses = SlaughterHouse::all();
        $todayDate = Date('Y-m-d');
        $month = strtotime("-1 Months");
        $firstDate = date('Y-m-d', $month);

        return view('common.ships.index',[
            'TransportCompanies' => $TransportCompanies,
            'Pastorals' => $Pastorals,
            'SlaughterHouses' => $SlaughterHouses,
            'todayDate' => $todayDate,
            'firstDate' => $firstDate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transportCompanyId = $request->transportCompanyId;
        $oxId = $request->oxId;
        $exportDate = $request->exportDate;
        $slaughterHouseId = $request->slaughterHouseId;

        $ox = Ox::find($oxId);

        $ox->slaughterTransport_Company_id = $transportCompanyId;
        $ox->exportDate = $exportDate;
        $ox->slaughterHouse_id = $slaughterHouseId;

        $ox->save();

        return "OK";
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $pastoralId = $request->pastoralId;
        $transportCompanyId = $request->transportCompanyId;
        
        if($pastoralId == 0 && $transportCompanyId ==0) {
            $oxen = Ox::whereNotNull('exportDate')->get();
        }

        if($pastoralId != 0 && $transportCompanyId == 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('pastoral_id', $pastoralId)->get();
        }

        if($pastoralId == 0 && $transportCompanyId != 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('slaughterTransport_Company_id', $transportCompanyId)->get();
        }

        if($pastoralId != 0 && $transportCompanyId != 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('pastoral_id', $pastoralId)
                ->where('slaughterTransport_Company_id', $transportCompanyId)->get();
        }

        return view('common.ships.list',['oxen'=>$oxen]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $oxId = $request->oxId;
        $ox = Ox::find($oxId);

        if(isset($ox->acceptedDateSlaughterHouse)) {
            return 0;
        }

        $ox->exportDate = NULL;
        $ox->slaughterTransport_Company_id = NULL;
        $ox->slaughterHouse_id = NULL;

        $ox->save();

        return "OK";
    }

    public function getShipList(Request $request) {
        
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $pastoralId = $request->pastoralId;
        $transportCompanyId = $request->transportCompanyId;
        $slaughterHouseId = $request->slaughterHouseId;
        $firstDate = $request->firstDate;
        $lastDate = $request->lastDate;

        $ships = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate')
            ->where('exportDate', '>=', $firstDate)
            ->where('exportDate', '<=', $lastDate);
        $totalCnt = $ships->count();

        if($pastoralId != 0) {
            $ships = $ships->where('pastoral_id', $pastoralId);
            $totalCnt = $ships->count();
        }

        if($transportCompanyId != 0) {
            $ships = $ships->where('slaughterTransport_Company_id', $transportCompanyId);
            $totalCnt = $ships->count();
        }

        if($slaughterHouseId != 0) {
            $ships = $ships->where('slaughterHouse_id', $slaughterHouseId);
            $totalCnt = $ships->count();
        }

        $ships = $ships->orderBy('updated_at', 'desc')->limit($pageSize)->offset(($pageNumber - 1) * $pageSize)->get();

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        return view('common.ships.list')
            ->with('ships', $ships)
            ->with('pageNumber', $pageNumber)
            ->with('pageSize', $pageSize)
            ->with('totalCnt', $totalCnt)
            ->with('pageCnt', $pageCnt);
    }

    public function getOxRegisterNumberListByPastoral(Request $request) {
        $pastoralId = $request->pastoralId;
        $oxen = Ox::where('pastoral_id', $pastoralId)
        ->whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->where('exportDate', NULL)->get();
        if(count($oxen) == 0) {
            return "<option value='0'>なし</option>";
        }
        return view('common.ships.OxRegisterNumberListByPastoral', ['oxen' => $oxen]);
    }

    public function getOxNameById(Request $request) {
        $oxId = $request->oxId;
        if($oxId == 0) {
            return "なし";
        }
        $oxen = Ox::where('id', $oxId)->get();
        $oxName = $oxen[0]->name;
        return $oxName;
    }

    public function getOxById(Request $request) {
        $oxId = $request->oxId;

        $ox = Ox::find($oxId);
        return $ox;
    }
}
