<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\TransportCompany;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class TransportCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        //
        $pageSize = $request->input('pageSize');
        if(empty($pageSize)) $pageSize=15;
        return view('admin/transportCompanies.index',[
            'transportCompanies'=>TransportCompany::orderByDesc('created_at')->paginate($pageSize),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TransportCompany $transportCompany):View
    {
        //
        return view('admin/transportCompanies.create',[
            'transportCompany'=>$transportCompany,
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
        $transportCompany=TransportCompany::create($validated);
        return redirect(route('transportCompanies.index'));

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
    public function edit(transportCompany $transportCompany):View
    {
        //
       // $this->authorize('update',$transportCompany);
        return view('admin/transportCompanies.edit',[
            'transportCompany'=>$transportCompany,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportCompany $transportCompany):RedirectResponse
    {
        //
      //  $this->authorize('update',$transportCompany);
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ]);
        $transportCompany->update($validated);
        return redirect(route('transportCompanies.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportCompany $transportCompany)
    {
        //
       /// $this->authorize('delete',$transportCompany);
        $transportCompany->delete();
        return redirect(route('transportCompanies.index'));
    }
    
}
