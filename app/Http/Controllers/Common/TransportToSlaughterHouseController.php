<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TransportCompany;
use App\Models\Common\Ox;


class TransportToSlaughterHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transportCompanies = TransportCompany::all();
        return view("common/transportToSlaughterHouses.index",['transportCompanies'=>$transportCompanies]);
    }
    public function list(Request $request){
        $company_id = $request->input('SelectCompany');
        $statu = $request->input('statu');
        $acceptedDateSlaughterHouse = $request->input('acceptedDateSlaughterHouse');
        $ox_id = $request->input('ox_id');
        if(isset($ox_id) && ($acceptedDateSlaughterHouse == '1900-01-01')){
            $acceptedDateSlaughterHouse = NULL;
            Ox::where('id',$ox_id)->update(['acceptedDateSlaughterHouse'=>$acceptedDateSlaughterHouse]);
        }
        if(isset($ox_id) && isset($acceptedDateSlaughterHouse)){
            Ox::where('id',$ox_id)->update(['acceptedDateSlaughterHouse'=>$acceptedDateSlaughterHouse]);           
        }else{
            if($statu == 2){
                $oxen =TransportCompany::find($company_id)->oxen()->where('exportDate','<>',NULL)->where('acceptedDateSlaughterHouse','<>',NULL)->get(); 
            }elseif($statu == 1){
                $oxen = TransportCompany::find($company_id)->oxen()->where('exportDate','<>',NULL)->where('acceptedDateSlaughterHouse','=',NULL)->get();
            }else{
                $oxen = TransportCompany::find($company_id)->oxen()->where('exportDate','<>',NULL)->get();
            }
        }
        return view('common/transportToSlaughterHouses.list',['oxen'=>$oxen]);
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
