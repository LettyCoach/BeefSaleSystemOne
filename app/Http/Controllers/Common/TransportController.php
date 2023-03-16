<?php

namespace App\Http\Controllers\Common;
use App\Models\Admin\TransportCompany;
use App\Models\Common\Ox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        $transportCompanies = TransportCompany::all();
        return view( 'common/transports.index', [ 'transportCompanies'=>$transportCompanies ] );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

    }

    public function list( Request $request ) {
        $company_id = $request->input( 'SelectCompany' );
        $statu = $request->input( 'statu' );
        $loadDate = $request->input( 'loadDate' );
        $unloadDate = $request->input( 'unloadDate' );
        $ox_id = $request->input( 'ox_id' );
        $oxen = NULL;
        if ( isset( $ox_id ) && ( $unloadDate == '1900-01-01' ) ) {
            if(isset(Ox::find($ox_id)->appendInfo)) {
                return 0;
            }
            $unloadDate = NULL;
            Ox::where( 'id', $ox_id )->update( [ 'unloadDate'=>$unloadDate ] );
            $oxen = TransportCompany::find( $company_id )->oxen()->get();
        } else if ( isset( $ox_id ) && ( $loadDate == '1900-01-01' ) ) {
            if(isset(Ox::find($ox_id)->unloadDate)) {
                return 0;
            }
            $loadDate = NULL;
            Ox::where( 'id', $ox_id )->update( [ 'loadDate'=>$loadDate ] );
            $oxen = TransportCompany::find( $company_id )->oxen()->get();
        } else if ( isset( $ox_id ) && isset( $loadDate ) ) {
            Ox::where( 'id', $ox_id )->update( [ 'loadDate'=>$loadDate ] );
            $oxen = TransportCompany::find( $company_id )->oxen()->get();
        } else if ( isset( $ox_id ) && isset( $unloadDate ) ) {
            Ox::where( 'id', $ox_id )->update( [ 'unloadDate'=>$unloadDate ] );
            $oxen = TransportCompany::find( $company_id )->oxen()->get();
        } else {
            if ( $statu == 2 ) {
                $oxen = TransportCompany::find( $company_id )->oxen()->where( 'loadDate', '<>', NULL )->get();

            } elseif ( $statu == 1 ) {
                $oxen = TransportCompany::find( $company_id )->oxen()->where( 'loadDate', '=', NULL )->get();
            } else {
                $oxen = TransportCompany::find( $company_id )->oxen()->get();
            }
        }
        return view( 'common/transports.list', [ 'oxen'=>$oxen ] );
    }
    /**
    * Display the specified resource.
    */

    public function show( string $id ) {

    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        //
    }
}
