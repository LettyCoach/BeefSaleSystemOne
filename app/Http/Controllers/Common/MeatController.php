<?php

namespace App\Http\Controllers\Common;
use App\Models\Common\Ox;
use App\Models\Admin\Part;
use App\Models\Common\Meat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
            'meats'=>Meat::all(),
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
        if(Meat::where('ox_id',$request->input('ox_id'))->count()>0){
           // return response()->json(['msg'=>'already register']);
           Meat::where('ox_id',$request->input('ox_id'))->delete();
        }
            $partList = Part::all();
            $count =Meat::all()->count();
            foreach($partList as $part){ //how to use 
                $PartIdTemp = 'PartName'.$part->id;
                $WeightTemp = 'Weight'.$part->id;
                $PriceTemp = 'Price'.$part->id;
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
            Ox::where('id',$ox_id)->update(['finishedState'=>1]);
            return response()->json(["msg"=>"ok"]);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
       
    }

    /**
     * index part of ox 
     */
    public function edit(int $id)
    {
        return view('common/meats.register',['ox'=>Ox::find($id),'parts'=>Part::all()]);
    }
   
    public function getRegisterList(Request $request){
        $id = $request->input('ox_id');
        return view('common/meats.registerList',['ox'=>Ox::find($id)]);
    }
   public function addPartRegister(Request $request){
        $ox_id = $request->input('ox_id');
        $part_id = $request->input('part_id');
        $weight = $request->input('weight');
        $price = $request->input('price');
        $exist = Meat::where('ox_id','=',$ox_id)
            ->where('part_id','=',$part_id)
            ->count();
        if($exist>0)
            return "Duplicate";
        else
            Meat::create([
                'ox_id' => $ox_id,
                'part_id' => $part_id,
                'weight' => $weight,
                'price' => $price,
            ]);
        return view('common/meats.registerList',['ox'=>Ox::find($ox_id)]);
   }

   public function updatePartRegister(Request $request){
        $ox_id = $request->input('ox_id');
        $part_id = $request->input('part_id');
        $weight = $request->input('weight');
        $price = $request->input('price');
        $partName = $request->input('partName');
        Meat::where('ox_id','=',$ox_id)
            ->where('part_id','=',$part_id)
            ->update([
                'weight' => $weight,
                'price' => $price,
            ]);
        return view('common/meats.registerList',['ox'=>Ox::find($ox_id)]);
    }
    public function deletePartRegister(Request $request){
        $ox_id = $request->input('ox_id');
        $part_id = $request->input('part_id');
        $meat = Meat::where('ox_id','=',$ox_id)
            ->where('part_id','=',$part_id);
        $meat->delete();
        return view('common/meats.registerList',['ox'=>Ox::find($ox_id)]);
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
          
        Meat::where('ox_id', $id)->delete();
        Ox::find($id)->delete();
        return redirect(route('meats.index'));
    }
    public function meatCancel(Request $request)
    {
        $ox_id = $request->ox_id;
        Meat::where('ox_id', $ox_id)->delete();
        Ox::find($ox_id)->delete();
        return "ok";
    }
    public function getMeatList(Request $request){
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize; 
        $meatState = $request->meatState;

        $OxModel = Ox::whereNotNull('purchaseDate')
                ->whereNotNull('loadDate')
                ->whereNotNull('unloadDate')
                ->whereNotNull('exportDate')
                ->whereNotNull('acceptedDateSlaughterHouse')
                ->where('slaughterFinishedDate','<>',NULL);

        //if current user is not admin
        if(!Auth::user()->hasRole('admin'))
        $OxModel = $OxModel->where('user_id',Auth::user()->id);

        $totalCnt = $OxModel->count();

        if($meatState != NULL){
            if($meatState ==1){
                $OxModel = $OxModel->where('finishedState','=',1);
                $totalCnt = $OxModel->count();
            }
            if($meatState ==0){
                $OxModel = $OxModel->where('finishedState','=',0);
                $totalCnt = $OxModel->count();
            }
        }
        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }
        
        $oxen = $OxModel->limit($pageSize)
        ->offset(($pageNumber - 1) * $pageSize)
        // ->orderBy('acceptedDateSlaughterHouse', 'desc')
        ->get();
        
        return view('common/meats.list',[
            'oxen'=>$oxen,
            // 'parts'=>Part::all(),
            // 'partsCount'=>Part::all()->max(),
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt,
        ]);
        
    }
    
        
}
