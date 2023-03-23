<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TransportCompany;
use App\Models\Common\Ox;
use App\Models\Admin\Pastoral;
use App\Models\Admin\SlaughterHouse ;


class TransportToSlaughterHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = strtotime("-1 Months");
        $startDate = date('Y-m-d', $month);
        $transportCompanies = TransportCompany::all();
        $pastorals = Pastoral::all();
        $slaughterHouses = SlaughterHouse::all();
        return view("common/transportToSlaughterHouses.index",[
            'transportCompanies'=>$transportCompanies,
            'startDate'=>$startDate,
            'pastorals' =>$pastorals,
            'slaughterHouses' =>$slaughterHouses,

        ]);
    }
    public function getExportTransportCompanyList(Request $request){
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize; 
        //
        $acceptedDateSlaughterHouse = $request->acceptedDateSlaughterHouse;
        $ox_id = $request->ox_id;

        //register
        Ox::where('id',$ox_id)->update(['acceptedDateSlaughterHouse'=>$acceptedDateSlaughterHouse]);
        
        //search data
        $transportState =$request->transportState;
        $endDate = $request->endDate;
        $company_id = $request->SelectCompany;
        $pastoral_id = $request->pastoral;
        $slaughterHouse_id = $request->slaughterHouse;


        $OxModel = Ox::whereNotNull('purchaseDate')
                        ->whereNotNull('loadDate')
                        ->whereNotNull('unloadDate')
                        ->whereNotNull('exportDate');
        $totalCnt = $OxModel->count();
        

        if($transportState != NULL) {
            if($transportState == 1){
                $OxModel = $OxModel->whereNotNull('acceptedDateSlaughterHouse');
                $totalCnt = $OxModel->count();
            }
            if($transportState == 0){
                $OxModel = $OxModel->whereNull('acceptedDateSlaughterHouse');
                $totalCnt = $OxModel->count();
            } 
        }
        if($pastoral_id != NULL) {
            $OxModel = $OxModel->where('pastoral_id','=',$pastoral_id);
            $totalCnt = $OxModel->count();          
        }
        if($company_id != NULL) {
            $OxModel = $OxModel->where('slaughterTransport_Company_id','=',$company_id);
            $totalCnt = $OxModel->count();          
        }
        if($slaughterHouse_id != NULL) {
            $OxModel = $OxModel->where('slaughterHouse_id','=',$slaughterHouse_id);
            $totalCnt = $OxModel->count();          
        }
        $oxen = $OxModel->limit($pageSize)
                ->offset(($pageNumber - 1) * $pageSize)
                // ->orderBy('acceptedDateSlaughterHouse', 'desc')
                ->get();
    
        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }
        return view('common/transportToSlaughterHouses.list',[
            'oxen'=>$oxen,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt,
        ]);
    }

    public function cancel(Request $request){
        $acceptedDateSlaughterHouse = $request->acceptedDateSlaughterHouse;
        $ox_id = $request->ox_id;
        //cancel
        if($acceptedDateSlaughterHouse == "1900-01-01"){
            if(Ox::find($ox_id)->slaughterFinishedDate != null) {
                return "CannotDelete";
            }else {
                Ox::where('id',$ox_id)->update(['acceptedDateSlaughterHouse'=>NULL]);
                return "ok";
            }
        }
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
