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
