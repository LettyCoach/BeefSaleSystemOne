<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Market;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use DB;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        return view('admin/markets.index',[
            'markets' => Market::orderByDesc('created_at')->get(),
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
        return redirect(route('markets.index'))->with('registerSuccess','正確に登録されました。');

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
        return redirect(route('markets.index'))->with('updateSuccess',"正確に更新されました。");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Market $market)
    {
        //
       /// $this->authorize('delete',$market);
        $market->delete();
        return redirect(route('markets.index'))->with('deleteSuccess',"正確に削除されました。");
    }
    
    public function getMarketsList(Request $request) {
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $marketName = $request->marketName;
        $marketPosition = $request->marketPosition;

        $marketsLists = Market::whereNotNull('created_at');
        $totalCnt = $marketsLists->count();

        if($marketName != "") {
            $marketsLists = $marketsLists->where('name', 'like', '%' . $marketName . '%');
            $totalCnt = $marketsLists->count();
        }

        if($marketPosition != "") {
            $marketsLists = $marketsLists->where('position', 'like', '%' . $marketPosition . '%');
            $totalCnt = $marketsLists->count();
        }

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        $marketsLists = $marketsLists->limit($pageSize)
            ->offset(($pageNumber - 1) * $pageSize)
            ->get();

        return view('admin.markets.list')
            ->with('marketsLists', $marketsLists)
            ->with('pageCnt', $pageCnt)
            ->with('pageNumber', $pageNumber)
            ->with('pageSize', $pageSize)
            ->with('totalCnt', $totalCnt);
    }
}
