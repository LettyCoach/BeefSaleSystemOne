<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SlaughterHouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SlaughterHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        $pageSize = $request->input('pageSize');
        if(empty($pageSize)) $pageSize=15;
        return view('admin/slaughterHouses.index',[
            'slaughterHouses'=>SlaughterHouse::orderByDesc('created_at')->paginate($pageSize),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SlaughterHouse $slaughterHouse):View
    {
        //
        return view('admin/slaughterHouses.create',[
            'slaughterHouse'=>$slaughterHouse,
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
        $slaughterHouse=SlaughterHouse::create($validated);
        return redirect(route('slaughterHouses.index'));

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
    public function edit(SlaughterHouse $slaughterHouse):View
    {
        //
       // $this->authorize('update',$slaughterHouse);
        return view('admin/slaughterHouses.edit',[
            'slaughterHouse'=>$slaughterHouse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SlaughterHouse $slaughterHouse):RedirectResponse
    {
        //
      //  $this->authorize('update',$slaughterHouse);
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ]);
        $slaughterHouse->update($validated);
        return redirect(route('slaughterHouses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlaughterHouse $slaughterHouse)
    {
        //
       /// $this->authorize('delete',$slaughterHouse);
        $slaughterHouse->delete();
        return redirect(route('slaughterHouses.index'));
    }
    
}
