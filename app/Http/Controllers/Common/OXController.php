<?php

namespace App\Http\Controllers\Common;

use App\Models\Common\Ox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OXController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function select(Request $request) {
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

    public function getOxList(Request $request) {
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $pastoralId = $request->pastoralId;
        if($pastoralId == 0) {
            $totalCnt = Ox::whereNotNull('unloadDate')->count();
            if(($totalCnt % $pageSize) == 0) {
                $pageCnt = $totalCnt / $pageSize;
            } else {
                $pageCnt = $totalCnt / $pageSize;
                $pageCnt = (int)$pageCnt + 1;
            }
            $oxs = Ox::whereNotNull('unloadDate')
                ->limit($pageSize)
                ->offset(($pageNumber - 1) * $pageSize)
                ->get();
        }
        else {
            $totalCnt = Ox::whereNotNull('unloadDate')
                ->where('pastoral_id', $pastoralId)
                ->count();
            if(($totalCnt % $pageSize) == 0) {
                $pageCnt = $totalCnt / $pageSize;
            } else {
                $pageCnt = $totalCnt / $pageSize;
                $pageCnt = (int)$pageCnt + 1;
            }
            $oxs = Ox::whereNotNull('unloadDate')
                ->where('pastoral_id', $pastoralId)
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

    public function getOxRegisterNumberListByPastoral(Request $request) {
        $pastoralId = $request->pastoralId;
        $oxen = Ox::where('pastoral_id', $pastoralId)->where('exportDate', NULL)->get();
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
