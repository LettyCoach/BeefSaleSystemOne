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
        return view('admin.slaughterHouses.index',[
            'slaughterHouses' => SlaughterHouse::orderByDesc('created_at')->get(),
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
        return redirect(route('slaughterHouses.index'))->with('registerSuccess','正確に登録されました。');

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
        return redirect(route('slaughterHouses.index'))->with('updateSuccess',"正確に更新されました。");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlaughterHouse $slaughterHouse)
    {
        //
       /// $this->authorize('delete',$slaughterHouse);
        $slaughterHouse->delete();
        return redirect(route('slaughterHouses.index'))->with('deleteSuccess',"正確に削除されました。");
    }

    public function getSlaughterHousesList(Request $request) {
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $slaughterHouseName = $request->slaughterHouseName;
        $slaughterHousePosition = $request->slaughterHousePosition;

        $slaughterHousesLists = SlaughterHouse::whereNotNull('created_at');
        $totalCnt = $slaughterHousesLists->count();

        if($slaughterHouseName != "") {
            $slaughterHousesLists = $slaughterHousesLists->where('name', 'like', '%' . $slaughterHouseName . '%');
            $totalCnt = $slaughterHousesLists->count();
        }

        if($slaughterHousePosition != "") {
            $slaughterHousesLists = $slaughterHousesLists->where('position', 'like', '%' . $slaughterHousePosition . '%');
            $totalCnt = $slaughterHousesLists->count();
        }

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        $slaughterHousesLists = $slaughterHousesLists->limit($pageSize)
            ->offset(($pageNumber - 1) * $pageSize)
            ->get();

        return view('admin.slaughterHouses.list')
            ->with('slaughterHousesLists', $slaughterHousesLists)
            ->with('pageCnt', $pageCnt)
            ->with('pageNumber', $pageNumber)
            ->with('pageSize', $pageSize)
            ->with('totalCnt', $totalCnt);
    }
    
}
