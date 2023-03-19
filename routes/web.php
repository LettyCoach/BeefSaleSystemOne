<?php                    
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\Common\MeatController;
use App\Http\Controllers\Common\SlaughterController;
use App\Http\Controllers\Common\TransportToSlaughterHouseController;
use App\Http\Controllers\Common\TransportController;
use App\Http\Controllers\Common\FattenController;
use App\Http\Controllers\Common\ShipController;
use App\Http\Controllers\Common\PurchaseController;
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

Route::resource('/chirps',ChirpController::class)->only(['index','store','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/markets',MarketController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/pastorals',PastoralController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/transportCompanies',TransportCompanyController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/slaughterHouses',SlaughterHouseController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/parts',PartController::class)->only(['index','store','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/admin/users',UserController::class)->only(['index','store','create','edit','update'])->middleware(['auth','verified']);
Route::get('/admin/users/getUserById', [UserController::class, 'getUserById'])->middleware(['auth','verified']);
Route::post('/admin/userRoleAdd', [UserController::class, 'userRoleAdd'])->middleware(['auth','verified']);
Route::get('/admin/userDestroy', [UserController::class, 'destroy'])->middleware(['auth','verified']);
Route::get('/admin/getUserList', [UserController::class, 'getUserList'])->middleware(['auth','verified']);
// Route::resource('/admin/oxs',OXController::class)->middleware(['auth','verified']);


//買った牛を運び込みと積み下ろしの報告
Route::resource('/common/transports',               TransportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:transport']);
Route::get('/common/getPurchaseTransportList',      [TransportController::class,'getPurchaseTransportList'])->middleware(['auth','verified']);
Route::get('/common/getPurchaseTransDataByOxId',    [TransportController::class,'getPurchaseTransDataByOxId'])->middleware(['auth','verified']);
Route::get('/common/registerLoadDate',              [TransportController::class,'registerLoadDate'])->middleware(['auth','verified']);


// 肥育（牛の生育状況の登録）
Route::resource('/common/fatten',                   FattenController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:fatten']);
Route::get('/common/getFattenList',                 [FattenController::class, 'getFattenList'])->middleware(['auth','verified']);
Route::get('/common/getAppendInfoByOxId',           [FattenController::class, 'getAppendInfoByOxId'])->middleware(['auth','verified']);
Route::post('/common/saveAppendInfo',               [FattenController::class, 'saveAppendInfo'])->middleware(['auth','verified']);



Route::get('/common/oxs/getOxNameById', [OXController::class, 'getOxNameById'])->middleware(['auth','verified']);
Route::get('/common/oxs/getOxById', [OXController::class, 'getOxById'])->middleware(['auth','verified']);


Route::resource('/common/purchases',PurchaseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:purchase']);

Route::resource('/common/ship',ShipController::class)->only(['index','store','show','create','edit','update'])->middleware(['auth','verified','role:ship']);
Route::get('/common/shipDestroy', [ShipController::class, 'destroy'])->middleware(['auth','verified']);

Route::resource('/common/transportToSlaughterHouses',TransportToSlaughterHouseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:transport']);
Route::get('/common/getExportTransportCompanyList',[TransportToSlaughterHouseController::class,'getExportTransportCompanyList'])->middleware(['auth','verified']);
Route::post('/common/transportToSlaughterHouses',[TransportToSlaughterHouseController::class,'list'])->name('transportToSlaughterHouses.list')->middleware(['auth','verified']);

Route::resource('/common/slaughters',SlaughterController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:slaughter']);
Route::get('/common/slaughterList',[SlaughterController::class,'slaughterList'])->middleware(['auth','verified']);

Route::resource('/common/meats',MeatController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified','role:meat']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/pagination', [PaginationController::class, 'index'])->name('pagination.index');
Route::get('pagination/fetch_data', [PaginationController::class, 'fetch_data'])->name('pagination.fetch_data');
require __DIR__.'/auth.php';
