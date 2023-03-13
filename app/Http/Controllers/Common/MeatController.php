<?php

namespace App\Http\Controllers\Common;
use App\Models\Common\Ox;
use App\Models\Admin\Part;
use App\Models\Common\Meat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('common/meats.index',[
            'oxen'=>Ox::where('slaughterFinishedDate','<>',NULL)->get(),
            'parts'=>Part::all(),
            'partsCount'=>Part::all()->max(),
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $id = $request->input('id');
        $ox = Ox::find($id);
       return $ox;//response()->json(['ox'=>$ox]);      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Meat::where('ox_id',$request->input('ox_id'))->count()>0)
            return response()->json(['msg'=>'register']);
        else{
            $count =Meat::all()->count();
            for($i=1;$i<=5;$i++){
                $PartIdTemp = 'PartName'.$i;
                $WeightTemp = 'Weight'.$i;
                $PriceTemp = 'Price'.$i;
                $ox_id = $request->input('ox_id');
                $part_id = Part::where('name',$request->input($PartIdTemp))->first(['id'])->id;
                $weight = $request->input($WeightTemp);
                $price = $request->input($PriceTemp);   
                
                Meat::create([
                    'ox_id'=>$ox_id,
                    'part_id'=>$part_id,
                    'weight'=>$weight,
                    'price'=>$price,
                ]);
                
            }   
            return response()->json(["msg"=>"ok"]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('common/meats.show',['ox'=>Ox::find($id),'part'=>Part::all()]);
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
    public function destroy(int $id)
    {
          dd($id);
        // Meat::where('ox_id', $id)->delete();
        return redirect(route('meats.index'));
    }
    
        
}
