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
        $pageSize = $request->input('pageSize');
        if(empty($pageSize)) $pageSize=15;
        return view('admin/pastorals.index',[
            'pastorals'=>Pastoral::orderByDesc('created_at')->paginate($pageSize),
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
        return redirect(route('pastorals.index'));

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
        return redirect(route('pastorals.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pastoral $pastoral)
    {
        //
       /// $this->authorize('delete',$pastoral);
        $pastoral->delete();
        return redirect(route('pastorals.index'));
    }
    
}
