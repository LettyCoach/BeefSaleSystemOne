<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Common\Ox;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('common/purchaseReport.index');
    }
    public function getPurchaseReportList(Request $request){
        $pastoralOxen = Ox::whereNotNull('purchaseDate')
            ->orderBy('pastoral_id')
            ->get()
            ->groupBy(function($data) {
                return $data->pastoral_id;
        });
        $trasnsportCompanyOxen = Ox::whereNotNull('purchaseDate')
            ->orderBy('purchaseTransport_Company_id')
            ->get()
            ->groupBy(function($data) {
                return $data->purchaseTransport_Company_id;
        });
        $marketOxen = Ox::whereNotNull('purchaseDate')
            ->orderBy('market_id')
            ->get()
            ->groupBy(function($data) {
                return $data->market_id;
        });
        $purchaseDates = Ox::whereNotNull('purchaseDate')
            ->orderBy('purchaseDate')
            ->get()
            ->groupBy(function($data) {
                return $data->purchaseDate;
        });
        return view('common/purchaseReport.list',[
            'pastoralOxen'=>$pastoralOxen,
            'trasnsportCompanyOxen'=>$trasnsportCompanyOxen,
            'marketOxen'=>$marketOxen,
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
