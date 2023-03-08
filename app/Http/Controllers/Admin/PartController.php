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
        $pageSize = $request->input('pageSize');
        if(empty($pageSize)) $pageSize=15;
        return view('admin/parts.index',[
            'parts'=>Part::orderByDesc('created_at')->paginate($pageSize),
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
        return redirect(route('parts.index'));

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
        return redirect(route('parts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        //
       /// $this->authorize('delete',$part);
        $part->delete();
        return redirect(route('parts.index'));
    }
    
}
