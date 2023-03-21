<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Pastoral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class PastoralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        return view('admin/pastorals.index',[
            'pastorals'=>Pastoral::orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pastoral $pastoral):View
    {
        //
        return view('admin/pastorals.create',[
            'pastoral'=>$pastoral,
        ]);
    }
    public function getPastoralsList(Request $request){
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        
        //Search
        $pastoralName = $request->pastoralName;
        $pastoralPosition = $request->pastoralPosition;

        $pastoralModel = Pastoral::whereNotNull('created_at');
        $totalCnt = $pastoralModel->count();

        if($pastoralName != NULL){
            $pastoralModel = $pastoralModel->where('name','like','%' . $pastoralName . '%');
            $totalCnt = $pastoralModel->count();
        }
        if($pastoralPosition != NULL){
            $pastoralModel = $pastoralModel->where('name','like','%' . $pastoralPosition . '%');
            $totalCnt = $pastoralModel->count();
        }

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        $pastorals = $pastoralModel->limit($pageSize)
            ->offset(($pageNumber - 1) * $pageSize)
            ->orderBy('created_at','desc')
            ->get();
        return view('admin/pastorals.list',[
            'pastorals'=>$pastorals,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt
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
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ]);
        $pastoral=Pastoral::create($validated);
        return redirect(route('pastorals.index'))->with('registerSuccess','正確に登録されました。');

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
    public function edit(Pastoral $pastoral):View
    {
        //
       // $this->authorize('update',$pastoral);
        return view('admin/pastorals.edit',[
            'pastoral'=>$pastoral,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pastoral $pastoral):RedirectResponse
    {
        //
      //  $this->authorize('update',$pastoral);
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ]);
        $pastoral->update($validated);
        return redirect(route('pastorals.index'))->with('updateSuccess',"正確に更新されました。");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pastoral $pastoral)
    {
        //
       /// $this->authorize('delete',$pastoral);
        $pastoral->delete();
        return redirect(route('pastorals.index'))->with('deleteSuccess',"正確に削除されました。");
    }
    
}
