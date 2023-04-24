<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Auth;

use DB;

class CompanyController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index( Request $request ):View {
        return view( 'admin/companies.index', [
            'companies' => Company::orderByDesc( 'created_at' )->get(),
        ] );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create( Company $company):View {
        //
        return view( 'admin/companies.create', [
            'company'=>$company
        ] );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ):RedirectResponse {
        //
        $validated = $request->validate( [
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ] );
        $companies= Company::create( $validated );
        return redirect( route( 'companies.index' ) )->with( 'registerSuccess', '正確に登録されました。' );

    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Company $company):View {
        //
        // $this->authorize( 'update', $companie);
        return view( 'admin/companies.edit', [
            'company'=>$company
        ] );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, Company $company):RedirectResponse {
        
        $validated = $request->validate( [
            'name'=>'required|string|max:255',
            'position'=>'required|string|max:255',
            'note'=>'required|string|max:255',
        ] );
        $company->update( $validated );
        return redirect( route( 'companies.index' ) )->with( 'updateSuccess', '正確に更新されました。' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Company $company) {
        //
        /// $this->authorize( 'delete', $companie);
        $company->delete();
        return redirect( route( 'companies.index' ) )->with( 'deleteSuccess', '正確に削除されました。' );
    }

    public function getCompaniesList( Request $request ) {
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;
        $companyName = $request->companyName;
        $companyPosition = $request->companyPosition;

        $companiesLists = Company::whereNotNull( 'created_at' );
        $totalCnt = $companiesLists->count();

        if ( $companyName != '' ) {
            $companiesLists = $companiesLists->where( 'name', 'like', '%' . $companyName . '%' );
            $totalCnt = $companiesLists->count();
        }

        if ( $companyPosition != '' ) {
            $companiesLists = $companiesLists->where( 'position', 'like', '%' . $companyPosition . '%' );
            $totalCnt = $companiesLists->count();
        }

        if ( ( $totalCnt % $pageSize ) == 0 ) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = ( int )$pageCnt + 1;
        }

        $companiesLists = $companiesLists->limit( $pageSize )
        ->offset( ( $pageNumber - 1 ) * $pageSize )
        ->get();
        return view( 'admin.companies.list' )
        ->with( 'companiesLists', $companiesLists )
        ->with( 'pageCnt', $pageCnt )
        ->with( 'pageNumber', $pageNumber )
        ->with( 'pageSize', $pageSize )
        ->with( 'totalCnt', $totalCnt );
    }
}
