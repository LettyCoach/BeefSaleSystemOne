<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\Ox;
use App\Models\User;
use Auth;
class ShipReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('common/shipReport.index');
    }
    
    public function getShipReportList(Request $request){
        $OxModel = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $company_id = User::find(Auth::user()->id)['company_id'];
            $OxModel = $OxModel->where('company_id',$company_id);  
        }

        $pastoralOxen = $OxModel->orderBy('pastoral_id')
            ->get()
            ->groupBy(function($data) {
                return $data->pastoral_id;
        });

        $OxModel = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $company_id = User::find(Auth::user()->id)['company_id'];
            $OxModel = $OxModel->where('company_id',$company_id);  
        }

        $trasnsportCompanyOxen = $OxModel->orderBy('slaughterTransport_Company_id')
            ->get()
            ->groupBy(function($data) {
                return $data->slaughterTransport_Company_id;
        });

        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $company_id = User::find(Auth::user()->id)['company_id'];
            $OxModel = $OxModel->where('company_id',$company_id);  
        }

        $OxModel = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate');
        
        $slaughterHouseOxen = $OxModel->orderBy('slaughterHouse_id')
            ->get()
            ->groupBy(function($data) {
                return $data->slaughterHouse_id;
        });
        $OxModel = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate');
        
        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $company_id = User::find(Auth::user()->id)['company_id'];
            $OxModel = $OxModel->where('company_id',$company_id);  
        }

        $purchaseDates = $OxModel->orderBy('purchaseDate')
            ->get()
            ->groupBy(function($data) {
                return $data->purchaseDate;
        });
        return view('common/shipReport.list',[
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
