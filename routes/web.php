<?php
use App\Http\Controllers\Common\TransportToSlaughterHouseController;
use App\Http\Controllers\Common\TransportController;
use App\Http\Controllers\Common\FattenController;
use App\Http\Controllers\Common\ShipController;
use App\Http\Controllers\Common\PurchaseController;
use App\Http\Controllers\Admin\OXController;
use App\Http\Controllers\Admin\PartController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\SlaughterHouseController;
use App\Http\Controllers\Admin\PastoralController;
use App\Http\Controllers\Admin\TransportCompanyController;
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
// Route::resource('/admin/oxs',OXController::class)->middleware(['auth','verified']);
Route::get('/admin/oxs/select', [OXController::class, 'select'])->middleware(['auth','verified']);
Route::get('/admin/oxs/saveAppendInfo', [OXController::class, 'saveAppendInfo'])->middleware(['auth','verified']);
Route::get('/admin/oxs/bypastoralId', [OXController::class, 'SelectByPastoralId'])->middleware(['auth','verified']);

Route::resource('/common/transports',TransportController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/common/purchases',PurchaseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::post('/common/transports',[TransportController::class,'list'])->name('transports.list')->middleware(['auth','verified']);
Route::resource('/common/fatten',FattenController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/common/ship',ShipController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::resource('/common/transportToSlaughterHouses',TransportToSlaughterHouseController::class)->only(['index','store','show','create','edit','update','destroy'])->middleware(['auth','verified']);
Route::post('/common/transportToSlaughterHouses',[TransportToSlaughterHouseController::class,'list'])->name('transportToSlaughterHouses.list')->middleware(['auth','verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
