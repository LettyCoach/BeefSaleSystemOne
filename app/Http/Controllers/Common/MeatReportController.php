<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\Ox;
use App\Models\Admin\Part;
use Auth;
class MeatReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('common/meatReport.index');
    }
    public function getMeatReportList(Request $request){

        $OxModel = Ox::whereNotNull('purchaseDate')
        ->whereNotNull('loadDate')
        ->whereNotNull('unloadDate')
        ->whereNotNull('exportDate')
        ->whereNotNull('acceptedDateSlaughterHouse')
        ->whereNotNull('slaughterFinishedDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $OxModel = $OxModel->where('user_id',Auth::user()->id);
        }
        

        $pastoralOxen = $OxModel->orderBy('pastoral_id')
        ->get()
        ->groupBy(function($data) {
            return $data->pastoral_id;
        });
        
        $OxModel= Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate')
            ->whereNotNull('acceptedDateSlaughterHouse')
            ->whereNotNull('slaughterFinishedDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin'))
        $OxModel = $OxModel->where('user_id',Auth::user()->id);


        $trasnsportCompanyOxen=$OxModel->orderBy('slaughterTransport_Company_id')
            ->get()
            ->groupBy(function($data) {
                return $data->slaughterTransport_Company_id;
        });

        $OxModel= Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate')
            ->whereNotNull('acceptedDateSlaughterHouse')
            ->whereNotNull('slaughterFinishedDate');

            //if current user is not admin
        if(!Auth::user()->hasRole('admin'))
        $OxModel = $OxModel->where('user_id',Auth::user()->id);

        $slaughterHouseOxen = $OxModel->orderBy('slaughterHouse_id')
            ->get()
            ->groupBy(function($data) {
                return $data->slaughterHouse_id;
        });
        $OxModelOx = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate')
            ->whereNotNull('exportDate')
            ->whereNotNull('acceptedDateSlaughterHouse')
            ->whereNotNull('slaughterFinishedDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin'))
        $OxModel = $OxModel->where('user_id',Auth::user()->id);

        $purchaseDates = $OxModel->orderBy('purchaseDate')
            ->get()
            ->groupBy(function($data) {
                return $data->purchaseDate;
        });
        $parts = Part::all();
        return view('common/meatReport.list',[
            'pastoralOxen'=>$pastoralOxen,
            'trasnsportCompanyOxen'=>$trasnsportCompanyOxen,
            'slaughterHouseOxen'=>$slaughterHouseOxen,
            'purchaseDates'=>$purchaseDates,
            'parts'=>$parts,
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
