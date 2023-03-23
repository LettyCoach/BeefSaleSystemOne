<?php

namespace App\Http\Controllers\Common;
use App\Models\Common\Ox;
use App\Models\Admin\SlaughterHouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\View;
use Illuminate\Http\RedirectResponse;

class SlaughterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('common/slaughters.index',['slaughterHouses'=>SlaughterHouse::all()]);
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

     public function slaughterList(Request $request){
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize; 
        
        //Search data
        $slaughterHouse_id = $request->SlaughterHouse;
        $acceptedWeight = $request->acceptedWeight;
        $acceptedLevel = $request->acceptedLevel;
        $slaughterFinishedDate = $request->slaughterFinishedDate;
        $ox_id = $request->ox_id;
        $slaughterState =$request->slaughterState;
        ///register
        if($acceptedWeight != NULL && $acceptedLevel !=NULL && $slaughterFinishedDate !=NULL){
            Ox::where('id',$ox_id)->update([
                'acceptedWeight'=>$acceptedWeight,
                'acceptedLevel'=>$acceptedLevel,
                'slaughterFinishedDate'=>$slaughterFinishedDate,
            ]);
        }
        //cancel
         
        if($acceptedWeight !=NULL && $acceptedLevel !=NULL && $slaughterFinishedDate =="1900-01-01"){
            Ox::where('id',$ox_id)->update([
                'acceptedWeight'=>NULL,
                'acceptedLevel'=>NULL,
                'slaughterFinishedDate'=>NULL,
            ]);
        }
    
        
        $OxModel = Ox::whereNotNull('purchaseDate')
                ->whereNotNull('loadDate')
                ->whereNotNull('unloadDate')
                ->whereNotNull('exportDate')
                ->whereNotNull('acceptedDateSlaughterHouse');
        $totalCnt = $OxModel->count();

        if($slaughterHouse_id != NULL){
            $OxModel = $OxModel->where('slaughterHouse_id','=',$slaughterHouse_id);
            $totalCnt =$OxModel->count();
        }
        if($slaughterState !=NULL){
            if($slaughterState == 1){
                $OxModel = $OxModel->whereNotNull('slaughterFinishedDate');
                $totalCnt =$OxModel->count();
            }
            if($slaughterState == 0){
                $OxModel = $OxModel->whereNull('slaughterFinishedDate');
                $totalCnt =$OxModel->count();
            }
        }
        
        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }
        
        $oxen = $OxModel->limit($pageSize)
        ->offset(($pageNumber - 1) * $pageSize)
        // ->orderBy('acceptedDateSlaughterHouse', 'desc')
        ->get();
        return view('common/slaughters.list',[
            'oxen'=>$oxen,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt
        ]);
    }


    public function cancel(Request $request){
      
        $acceptedWeight = $request->acceptedWeight;
        $acceptedLevel = $request->acceptedLevel;
        $slaughterFinishedDate = $request->slaughterFinishedDate;
        $ox_id = $request->ox_id;
        if($acceptedWeight !=NULL && $acceptedLevel !=NULL && $slaughterFinishedDate =="1900-01-01"){
            if(Ox::find($ox_id)->finishedState != null){
                return "CannotDelete";
            }else{
                Ox::where('id',$ox_id)->update([
                    'acceptedWeight'=>NULL,
                    'acceptedLevel'=>NULL,
                    'slaughterFinishedDate'=>NULL,
                ]);
                return "ok";
            }
                
        }
    }

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
