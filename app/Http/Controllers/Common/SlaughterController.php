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

     public function list(Request $request){
        $slaughterHouse_id = $request->input('SlaughterHouse');
        $statu = $request->input('statu');
        $slaughterFinishedDate = $request->input('slaughterFinishedDate');
        $unslaughterFinishedDate = $request->input('unslaughterFinishedDate');
        $ox_id = $request->input('ox_id');
        $acceptedWeight = $request->input('acceptedWeight');
        $acceptedLevel = $request->input('acceptedLevel');
        
        if(isset($ox_id) && ($slaughterFinishedDate == '1900-01-01')){
            $slaughterFinishedDate = NULL;
            $acceptedWeight = 0;
            $acceptedLevel = 0;
            Ox::where('id',$ox_id)->update([
                'slaughterFinishedDate'=>$slaughterFinishedDate,
                'acceptedWeight'=>$acceptedWeight,
                'acceptedLevel'=>$acceptedLevel
            ]);
        }else if(isset($ox_id) && isset($slaughterFinishedDate)){
            
            Ox::where('id',$ox_id)->update([
                'slaughterFinishedDate'=>$slaughterFinishedDate,
                'acceptedWeight'=>$acceptedWeight,
                'acceptedLevel'=>$acceptedLevel
            ]);
        }else{
            if($statu == 2){
              
            }elseif($statu == 1){
                
            }else{
                $oxen = Ox::where('slaughterHouse_id','=',$slaughterHouse_id)->get();
            }
        }
       
        return view('common/slaughters.list',['oxen'=>$oxen]);
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
