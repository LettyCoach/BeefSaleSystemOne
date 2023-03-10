<?php

namespace App\Http\Controllers\Common;

use App\Models\Common\Ox;
use App\Models\Admin\Pastoral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FattenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oxen = Ox::orderByDesc('created_at')->paginate(10);
        $Pastorals = Pastoral::all();
        return view('common/fattens.index',['oxen'=>$oxen, 'Pastorals' => $Pastorals]);
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
