<?php

namespace App\Http\Controllers\Common;
use App\Models\Common\Ox;
use App\Models\Admin\Market;
use App\Models\Admin\TransportCompany;
use App\Models\Admin\Pastoral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\View;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = strtotime("-1 Months");
        $startDate = date('Y-m-d', $month);
        return view('common/purchases.index',[
            'oxen'=>Ox::select('purchaseDate')->distinct()->get(),
            'markets'=>Market::all(),
            'pastorals'=>Pastoral::all(),
            'transportCompanies'=>TransportCompany::all(),
            'startDate'=>$startDate,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $markets = Market::all();
        $pastorals = Pastoral::all();
        $transportCompanies =TransportCompany::all();
        return view('common/purchases.create',['markets'=>$markets,'pastorals'=>$pastorals,'transportCompanies'=>$transportCompanies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'registerNumber'=>'required|string|max:255',
            'birthday'=>'required|string|max:255',
            'purchasePrice'=>'required|decimal:0,2',
        ]);
        $validateData = $request->all();

        if(Ox::where('registerNumber',$validateData['registerNumber'])->count() == 1){
            return back()->with('info','個人識別番号が重複しています。');
        }else{
            $ox = Ox::create([
                'name' => $validateData['name'],
                'registerNumber' => $validateData['registerNumber'],
                'birthday' => $validateData['birthday'],
                'sex' => (int)$validateData['sex'],
                'market_id' => (int)$validateData['market_id'],
                'purchaseTransport_Company_id' => (int)$validateData['purchaseTransport_Company_id'],
                'pastoral_id' => (int)$validateData['pastoral_id'],
                'purchasePrice' =>(float)$validateData['purchasePrice'],
                'purchaseDate'=>$validateData['purchaseDate'],
            ]);
            return redirect(route('purchases.index'))->with('registerSuccess','正確に登録されました。');;
        }
         
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
    public function edit(int $id)
    {   
        $markets = Market::all();
        $pastorals = Pastoral::all();
        $transportCompanies =TransportCompany::all();        
        return view('common/purchases.edit',['markets'=>$markets,'pastorals'=>$pastorals,'transportCompanies'=>$transportCompanies,'ox'=>Ox::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $ox_id)
    {
        $validateData = $request->all();
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'registerNumber'=>'required|string|max:255',
            'birthday'=>'required|string|max:255',
            'purchasePrice'=>'required|decimal:0,2',
        ]);
        if(Ox::where('registerNumber',$validateData['registerNumber'])->count() == 1){       
            return back()->with('info','個人識別番号が重複しています。');
        }else{
            Ox::where('id', $ox_id)       
            ->update([
                'name' => $validateData['name'],
                'registerNumber' => $validateData['registerNumber'],
                'birthday' => $validateData['birthday'],
                'sex' => (int)$validateData['sex'],
                'market_id' => (int)$validateData['market_id'],
                'purchaseTransport_Company_id' => (int)$validateData['purchaseTransport_Company_id'],
                'pastoral_id' => (int)$validateData['pastoral_id'],
                'purchasePrice' =>(float)$validateData['purchasePrice'],
                'purchaseDate'=>$validateData['purchaseDate'],
            ]);
            return redirect(route('purchases.index'))->with('updateSuccess',"正確に更新されました。");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $ox_id):RedirectResponse
    {
        $ox = Ox::find($ox_id);
        if($ox->loadDate != NULL) {
            return redirect(route('purchases.index'))->with('deleteError',"既に積載しているため削除できません。");
        }
       
        $deleted = Ox::where('id', $ox_id)->delete();
        return redirect(route('purchases.index'))->with('deleteSuccess',"正確に削除されました。");
    }

    public function getPurchaseList(Request $request) {
     
        $pageNumber = $request->pageNumber;
        $pageSize = $request->pageSize;   
     
        // search Data
        $market_id =$request->market_id;
        $transportCompany_id = $request->transportCompany_id;
        $pastoral_id = $request->pastoral_id;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if($startDate>$endDate) return "DateError";
         
        $OxModel = Ox::whereNotNull('created_at');
        $totalCnt = $OxModel->count();
        if($market_id != NULL){
            $OxModel=$OxModel->where('market_id','=',$market_id);
            $totalCnt = $OxModel->count();
        }
        if($transportCompany_id !=NULL){
            $OxModel=$OxModel->where('purchaseTransport_Company_id', '=', $transportCompany_id);
            $totalCnt = $OxModel->count();
        }
        if($pastoral_id !=NULL){
            $OxModel=$OxModel->where('pastoral_id', '=', $pastoral_id);
            $totalCnt = $OxModel->count();
        }
        if($startDate !=NULL && $endDate !=NULL){
            $OxModel=$OxModel->where('purchaseDate','>=',$startDate)
            ->where('purchaseDate','<=',$endDate) ;
            $totalCnt = $OxModel->count();
        }
        $oxen = $OxModel->limit($pageSize)
                ->offset(($pageNumber - 1) * $pageSize)
                ->orderBy('purchaseDate', 'desc')
                ->orderBy('created_at','desc')
                ->get();
        
        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        return view('common/purchases.list',[
            'oxen'=>$oxen,
            'pageCnt' => $pageCnt, 
            'pageNumber' => $pageNumber, 
            'pageSize' => $pageSize,
            'totalCnt' => $totalCnt
        ]);
    }
}
