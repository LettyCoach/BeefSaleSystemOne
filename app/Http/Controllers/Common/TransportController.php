<?php

namespace App\Http\Controllers\Common;
use App\Models\Admin\TransportCompany;
use App\Models\Common\Ox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $transportCompanies = TransportCompany::all();
        return view('common/transports.index',['transportCompanies'=>$transportCompanies]);
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

        
    }
    public function list(){
        $transportCompany = TransportCompany::find(8);      
        
        return view('common/transports.list',['transportCompany'=>$transportCompany]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        
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
