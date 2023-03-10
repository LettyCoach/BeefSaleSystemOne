<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\OX;
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
        $ox = OX::find($id);
        return $ox;
    }

    public function saveAppendInfo(Request $request) {
        $id = $request->oxId;
        $appendInfo = $request->appendInfo;
        $ox = OX::find($id);
        $ox->appendInfo = $appendInfo;
        $ox->save();
        return "OK";
    }

    public function SelectByPastoralId(Request $request) {
        $pastoralId = $request->pastoralId;
        if($pastoralId == 0) {
            $oxs = OX::all();
        }
        else {
            $oxs = OX::where('pastoral_id', $pastoralId)->get();
        }

        return view('common/fattens.list',['oxs'=>$oxs]);
    }
}
