<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Part;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        return view('admin/parts.index',[
            'parts'=>Part::orderByDesc('created_at')->get(),
        ]);
    }
    public function getPartsList(Request $request){
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        
        //Search
        $partName = $request->partName;
        $partPosition = $request->partPosition;

        $partModel = part::whereNotNull('created_at');
        $totalCnt = $partModel->count();

        if($partName != NULL){
            $partModel = $partModel->where('name','like','%' . $partName . '%');
            $totalCnt = $partModel->count();
        }
       
        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        $parts = $partModel->limit($pageSize)
            ->offset(($pageNumber - 1) * $pageSize)
            ->orderBy('created_at','desc')
            ->get();
        return view('admin/parts.list',[
            'parts'=>$parts,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Part $part):View
    {
        //
        return view('admin/parts.create',[
            'part'=>$part,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
         //
         $validated = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $part=Part::create($validated);
        return redirect(route('parts.index'))->with('registerSuccess','正確に登録されました。');

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
    public function edit(Part $part):View
    {
        //
       // $this->authorize('update',$part);
        return view('admin/parts.edit',[
            'part'=>$part,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Part $part):RedirectResponse
    {
        //
      //  $this->authorize('update',$part);
        $validated = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $part->update($validated);
        return redirect(route('parts.index'))->with('updateSuccess',"正確に更新されました。");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        //
       /// $this->authorize('delete',$part);
        $part->delete();
        return redirect(route('parts.index'))->with('deleteSuccess',"正確に削除されました。");
    }
    
}
