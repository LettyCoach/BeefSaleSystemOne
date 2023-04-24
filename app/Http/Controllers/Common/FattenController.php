<?php

namespace App\Http\Controllers\Common;

use App\Models\Common\Ox;
use App\Models\Admin\Pastoral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FattenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pastorals = Pastoral::all();
        return view('common/fattens.index',['Pastorals' => $Pastorals]);
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

    public function getFattenList(Request $request) {
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $pastoralId = $request->pastoralId;

            $OxModel = Ox::whereNotNull('purchaseDate')
            ->whereNotNull('loadDate')
            ->whereNotNull('unloadDate');

        //if current user is not admin
        if(!Auth::user()->hasRole('admin')){
            $company_id = User::find(Auth::user()->id)['company_id'];
            $OxModel = $OxModel->where('company_id',$company_id);  
        }

        if($pastoralId == 0) {

            $totalCnt = $OxModel->count();
            
            if(($totalCnt % $pageSize) == 0) {
                $pageCnt = $totalCnt / $pageSize;
            } else {
                $pageCnt = $totalCnt / $pageSize;
                $pageCnt = (int)$pageCnt + 1;
            }

            $oxs = $OxModel->orderBy('unloadDate', 'desc')
                ->limit($pageSize)
                ->offset(($pageNumber - 1) * $pageSize)
                ->get();
                
        } else {
            $totalCnt = $OxModel->where('pastoral_id', $pastoralId)
                ->count();

            if(($totalCnt % $pageSize) == 0) {
                $pageCnt = $totalCnt / $pageSize;
            } else {
                $pageCnt = $totalCnt / $pageSize;
                $pageCnt = (int)$pageCnt + 1;
            }

            $oxs = $OxModel->where('pastoral_id', $pastoralId)
                ->orderBy('unloadDate', 'desc')
                ->limit($pageSize)
                ->offset(($pageNumber - 1) * $pageSize)
                ->get();
        }

        return view('common/fattens.list',[
            'oxs'=>$oxs,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt
        ]);
    }

    public function getAppendInfoByOxId(Request $request) {
        $id = $request->id;
        $ox = Ox::find($id);
        return $ox;
    }

    public function saveAppendInfo(Request $request) {
        $id = $request->oxId;
        $appendInfo = $request->appendInfo;
        $ox = Ox::find($id);
        $ox->appendInfo = $appendInfo;
        $ox->save();
        return "OK";
    }
}
