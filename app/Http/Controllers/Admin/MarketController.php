<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Market;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('admin/markets.index',[
            'markets'=>Market::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Market $market):View
    {
        //
        return view('admin/markets.create',[
            'market'=>$market,
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
        $market=Market::create($validated);
        return redirect(route('markets.index'));

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
    public function edit(Market $market):View
    {
        //
       // $this->authorize('update',$market);
        return view('admin/markets.edit',[
            'market'=>$market,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Market $market):RedirectResponse
    {
        //
      //  $this->authorize('update',$market);
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ]);
        $market->update($validated);
        return redirect(route('markets.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Market $market)
    {
        //
       /// $this->authorize('delete',$market);
        $market->delete();
        return redirect(route('markets.index'));
    }
    
}
