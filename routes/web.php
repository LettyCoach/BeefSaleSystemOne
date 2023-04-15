<?php                    
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\Common\MeatController;
use App\Http\Controllers\Common\SlaughterController;
use App\Http\Controllers\Common\TransportToSlaughterHouseController;
use App\Http\Controllers\Common\TransportController;
use App\Http\Controllers\Common\FattenController;
use App\Http\Controllers\Common\ShipController;
use App\Http\Controllers\Common\PurchaseController;
use App\Http\Controllers\Common\PurchaseReportController;
use App\Http\Controllers\Common\PurchaseTransportReportController;
use App\Http\Controllers\Common\FattenReportController;
use App\Http\Controllers\Common\ShipReportController;
use App\Http\Controllers\Common\TransportToSlaughterHouseReportController;
use App\Http\Controllers\Common\SlaughterReportController;
use App\Http\Controllers\Common\MeatReportController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Common\OXController;
use App\Http\Controllers\Admin\PartController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\SlaughterHouseController;
use App\Http\Controllers\Admin\PastoralController;
use App\Http\Controllers\Admin\TransportCompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/chirps',                              ChirpController::class)->only(['index','store','edit','update','destroy'])->middleware(['auth','verified']);

Route::resource('/admin/markets',                       MarketController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/admin/getMarketsList',                     [MarketController::class, 'getMarketsList'])->middleware(['auth','verified']);

Route::resource('/admin/pastorals',                     PastoralController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/admin/getPastoralsList',                   [PastoralController::class,'getPastoralsList'])->middleware(['auth','verified']);

Route::resource('/admin/transportCompanies',            TransportCompanyController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/admin/getTransportCompaniesList',          [TransportCompanyController::class,'getTransportCompaniesList'])->middleware(['auth','verified']);

Route::resource('/admin/slaughterHouses',               SlaughterHouseController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/admin/getSlaughterHousesList',             [SlaughterHouseController::class, 'getSlaughterHousesList'])->middleware(['auth','verified']);

Route::resource('/admin/parts',                         PartController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/admin/getPartsList',                       [PartController::class,'getPartsList'])->middleware(['auth','verified']);

Route::resource('/admin/users',                         UserController::class)->only(['index','store','create','edit','update'])->middleware(['auth','verified']);
Route::get('/admin/users/getUserById',                  [UserController::class, 'getUserById'])->middleware(['auth','verified']);
Route::post('/admin/userRoleAdd',                       [UserController::class, 'userRoleAdd'])->middleware(['auth','verified']);
Route::get('/admin/userDestroy',                        [UserController::class, 'destroy'])->middleware(['auth','verified']);
Route::get('/admin/getUserList',                        [UserController::class, 'getUserList'])->middleware(['auth','verified']);


//買った牛を運び込みと積み下ろしの報告
Route::resource('/common/transports',                   TransportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:transport']);
Route::get('/common/getPurchaseTransportList',          [TransportController::class,'getPurchaseTransportList'])->middleware(['auth','verified']);
Route::get('/common/getPurchaseTransDataByOxId',        [TransportController::class,'getPurchaseTransDataByOxId'])->middleware(['auth','verified']);
Route::get('/common/registerLoadDate',                  [TransportController::class,'registerLoadDate'])->middleware(['auth','verified']);
Route::resource('/common/purchaseTransportReport',      PurchaseTransportReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:transport']);
Route::get('/common/getPurchaseTransportReportList',    [PurchaseTransportReportController::class,'getPurchaseTransportReportList'])->middleware(['auth','verified']);
Route::get('/common/cancelPurchaseTransLoad',           [TransportController::class,'cancelPurchaseTransLoad'])->middleware(['auth','verified']);
Route::get('/common/cancelPurchaseTransUnload',           [TransportController::class,'cancelPurchaseTransUnload'])->middleware(['auth','verified']);


// 肥育（牛の生育状況の登録）
Route::resource('/common/fatten',                       FattenController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:fatten']);
Route::get('/common/getFattenList',                     [FattenController::class, 'getFattenList'])->middleware(['auth','verified']);
Route::get('/common/getAppendInfoByOxId',               [FattenController::class, 'getAppendInfoByOxId'])->middleware(['auth','verified']);
Route::post('/common/saveAppendInfo',                   [FattenController::class, 'saveAppendInfo'])->middleware(['auth','verified']);
Route::resource('/common/fattenReport',                 FattenReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:fatten']);
Route::get('/common/getFattenReportList',               [FattenReportController::class, 'getFattenReportList'])->middleware(['auth','verified']);



Route::get('/common/oxs/getOxNameById',                 [OXController::class, 'getOxNameById'])->middleware(['auth','verified']);



Route::resource('/common/purchases',                    PurchaseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:purchase']);
Route::get('/common/getPurchaseList',                   [PurchaseController::class,'getPurchaseList'])->middleware(['auth','verified']);
Route::resource('/common/purchaseReport',               PurchaseReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:purchase']);
Route::get('/common/getPurchaseReportList',             [PurchaseReportController::class,'getPurchaseReportList'])->middleware(['auth','verified']);

Route::resource('/common/ship',                         ShipController::class)->only(['index','store','create','edit','update'])->middleware(['auth','verified','role:ship']);
Route::resource('/common/shipReport',                   ShipReportController::class)->only(['index','store','create','edit','update'])->middleware(['auth','verified']);
Route::get('/common/getShipReportList',                 [ShipReportController::class,'getShipReportList'])->middleware(['auth','verified']);
Route::get('/common/getShipList',                       [ShipController::class, 'getShipList'])->middleware(['auth','verified','role:ship']);
Route::get('/common/getOxRegisterNumberListByPastoral', [ShipController::class, 'getOxRegisterNumberListByPastoral'])->middleware(['auth','verified']);
Route::get('/common/getOxNameById',                     [ShipController::class, 'getOxNameById'])->middleware(['auth','verified']);
Route::get('/common/getOxById',                         [ShipController::class, 'getOxById'])->middleware(['auth','verified']);
Route::get('/common/shipDestroy',                       [ShipController::class, 'destroy'])->middleware(['auth','verified']);

Route::resource('/common/transportToSlaughterHouses',   TransportToSlaughterHouseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:transport']);
Route::get('/common/getExportTransportCompanyList',     [TransportToSlaughterHouseController::class,'getExportTransportCompanyList'])->middleware(['auth','verified']);
Route::post('/common/transportToSlaughterHouses',       [TransportToSlaughterHouseController::class,'list'])->name('transportToSlaughterHouses.list')->middleware(['auth','verified']);
Route::post('/common/transportToSlaughterCancel',       [TransportToSlaughterHouseController::class,'cancel'])->middleware(['auth','verified']);
Route::resource('/common/transportToSlaughterHouseReport', TransportToSlaughterHouseReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/common/getTransportToSlaughterHouseReportList', [TransportToSlaughterHouseReportController::class,'getTransportToSlaughterHouseReportList'])->middleware(['auth','verified']);

Route::resource('/common/slaughters',                   SlaughterController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:slaughter']);
Route::get('/common/slaughterList',                     [SlaughterController::class,'slaughterList'])->middleware(['auth','verified']);
Route::post('/common/slaughterCancel',                  [SlaughterController::class,'cancel'])->middleware(['auth','verified']);
Route::resource('/common/slaughterReport',              SlaughterReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::get('/common/getSlaughterReportList',            [SlaughterReportController::class,'getSlaughterReportList'])->middleware(['auth','verified','role:slaughter']);

Route::resource('/common/meats',                        MeatController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:meat']);
Route::get('/common/getMeatList',                       [MeatController::class,'getMeatList'])->middleware(['auth','verified']);
Route::post('/common/meatCancel',                       [MeatController::class,'meatCancel'])->middleware(['auth','verified']);
Route::get('/common/getRegisterList',                   [MeatController::class,'getRegisterList'])->middleware(['auth','verified']);
Route::get('/common/addPartRegister',                   [MeatController::class,'addPartRegister'])->middleware(['auth','verified']);
Route::get('/common/updatePartRegister',                [MeatController::class,'updatePartRegister'])->middleware(['auth','verified']);
Route::get('/common/deletePartRegister',                [MeatController::class,'deletePartRegister'])->middleware(['auth','verified']);
Route::resource('/common/meatReport',                   MeatReportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:meat']);
Route::get('/common/getMeatReportList',                 [MeatReportController::class,'getMeatReportList'])->middleware(['auth','verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile',                              [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',                            [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',                           [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pagination',                               [PaginationController::class, 'index'])->name('pagination.index');
Route::get('pagination/fetch_data',                     [PaginationController::class, 'fetch_data'])->name('pagination.fetch_data');

Route::get('send-mail', [MailController::class, 'index']);

require __DIR__.'/auth.php';
