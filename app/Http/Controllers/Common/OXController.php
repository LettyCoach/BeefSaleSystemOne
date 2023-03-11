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

    public function SelectByPastoralId(Request $request) {
        $pastoralId = $request->pastoralId;
        if($pastoralId == 0) {
            $oxs = Ox::all();
        }
        else {
            $oxs = Ox::where('pastoral_id', $pastoralId)->get();
        }

        return view('common/fattens.list',['oxs'=>$oxs]);
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
}
