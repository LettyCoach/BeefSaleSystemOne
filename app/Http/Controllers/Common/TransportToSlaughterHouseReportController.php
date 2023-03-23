<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\Ox;

class TransportToSlaughterHouseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('common/transportToSlaughterHouseReport.index');
    }
    public function getTransportToSlaughterHouseReportList(Request $request){
        $pastoralOxen = Ox::whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->whereNotNull('exportDate')
        ->orderBy('pastoral_id')
        ->get()
        ->groupBy(function($data) {
            return $data->pastoral_id;
    });
    $trasnsportCompanyOxen = Ox::whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->whereNotNull('exportDate')
        ->orderBy('slaughterTransport_Company_id')
        ->get()
        ->groupBy(function($data) {
            return $data->slaughterTransport_Company_id;
    });
    $slaughterHouseOxen = Ox::whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->whereNotNull('exportDate')
        ->orderBy('slaughterHouse_id')
        ->get()
        ->groupBy(function($data) {
            return $data->slaughterHouse_id;
    });
    $purchaseDates = Ox::whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->whereNotNull('exportDate')
        ->orderBy('purchaseDate')
        ->get()
        ->groupBy(function($data) {
            return $data->purchaseDate;
    });
    return view('common/transportToSlaughterHouseReport.list',[
        'pastoralOxen'=>$pastoralOxen,
        'trasnsportCompanyOxen'=>$trasnsportCompanyOxen,
        'slaughterHouseOxen'=>$slaughterHouseOxen,
        'purchaseDates'=>$purchaseDates,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
