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
        $todayDate = date('Y-m-d');
        return view('common.ships.index',['TransportCompanies' => $TransportCompanies, 'Pastorals' => $Pastorals, 'SlaughterHouses' => $SlaughterHouses, 'todayDate'=>$todayDate]);
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
            $oxen = Ox::whereNotNull('exportDate')->paginate(10);
        }

        if($pastoralId != 0 && $transportCompanyId == 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('pastoral_id', $pastoralId)
                ->paginate(10);
        }

        if($pastoralId == 0 && $transportCompanyId != 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('slaughterTransport_Company_id', $transportCompanyId)
                ->paginate(10);
        }

        if($pastoralId != 0 && $transportCompanyId != 0) {
            $oxen = Ox::whereNotNull('exportDate')
                ->where('pastoral_id', $pastoralId)
                ->where('slaughterTransport_Company_id', $transportCompanyId)
                ->paginate(10);
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

        $ox->exportDate = NULL;
        $ox->slaughterTransport_Company_id = NULL;
        $ox->slaughterHouse_id = NULL;

        $ox->save();

        return "OK";
    }
}
