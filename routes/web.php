<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// asset
Route::get('/asset-list', [AssetController::class, 'assetList'])->name('assetList');
Route::get('/create-asset', [AssetController::class, 'createAsset'])->name('createAsset');
Route::post('/store-asset', [AssetController::class, 'storeAsset'])->name('storeAsset');
Route::get('/edit-asset/{id}', [AssetController::class, 'editAsset'])->name('editAsset');
Route::post('/update-asset', [AssetController::class, 'updateAsset'])->name('updateAsset');
Route::get('/delete-asset/{id}', [AssetController::class, 'deleteAsset'])->name('deleteAsset');
// data
Route::get('/data-list', [DataController::class, 'dataList'])->name('dataList');
Route::get('/create-data', [DataController::class, 'createData'])->name('createData');
Route::post('/store-data', [DataController::class, 'storeData'])->name('storeData');
Route::get('/edit-data/{id}', [DataController::class, 'editData'])->name('editData');
Route::post('/update-data', [DataController::class, 'updateData'])->name('updateData');
Route::get('/delete-data/{id}', [DataController::class, 'deleteData'])->name('deleteData');
// report
Route::get('/get-report-list', [ReportController::class, 'getReportList'])->name('getReportList');
Route::get('/type-report', [ReportController::class, 'typeReport'])->name('typeReport');
Route::get('/asset-report', [ReportController::class, 'assetReport'])->name('assetReport');
Route::get('/monthly-report', [ReportController::class, 'monthlyReport'])->name('monthlyReport');
Route::get('/get-month',[ReportController::class,'getMonth'])->name('getMonth');
