<?php

use App\Http\Controllers\VendorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\UserController;
use App\Models\Uraian;
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
    return view('guest.login');
})->middleware('guest')->name('login');

Route::get('/kontrak/{uraian}', function (Uraian $uraian) {
    return view('auth.uraian.kontrak', [
        'kontrak' => $uraian
    ]);
})->name('kontrak.view');

// Login
Route::post('/login', [LoginController::class, "authenticate"])->name('logon');

// Logout
Route::post('/logout', [LoginController::class, "logout"])->name('logout');

// Dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

// Tender
Route::get('tender/{id}/restore', [TenderController::class, 'restore'])->name('tender.restore');
Route::get('tender/{id}/permanent', [TenderController::class, 'permanent'])->name('tender.permanent');
Route::get('tender/trash', [TenderController::class, 'trash'])->name('tender.trash');
Route::get('tender/{name}/filter', [TenderController::class, 'filter'])->name('tender.filter');
Route::get('/tender/{tender:slug}', [TenderController::class, 'show'])->name('tender.show');
Route::patch('/tender/update', [TenderController::class, 'update'])->name('tender.update');
Route::resource('/tender', TenderController::class, [
    'except' => ['show', 'update']
]);

// Vendor
Route::patch('/vendor/update', [VendorController::class, 'update'])->name('vendor.update');
Route::resource('/vendor', VendorController::class, [
    'except' => ['create', 'edit', 'update', 'show']
]);

// Bagian
Route::patch('/bagian/update', [BagianController::class, 'update'])->name('bagian.update');
Route::resource('/bagian', BagianController::class, [
    'except' => ['create', 'edit', 'update', 'show']
]);

// Pekerjaan
Route::get('/rincian', [PekerjaanController::class, 'rincian'])->name('rincian.all');
Route::get('/pekerjaan/{tender}/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
Route::post('/pekerjaan/{tender}/store', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
Route::get('/pekerjaan/{pekerjaan}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
Route::patch('/pekerjaan/update', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
Route::delete('/pekerjaan/{pekerjaan}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');
Route::get('/pekerjaan/{tender}/history', [PekerjaanController::class, 'historyView'])->name('pekerjaan.history');
Route::get('/pekerjaan/{tender}/view', [PekerjaanController::class, 'importView'])->name('pekerjaan.view');
Route::post('/pekerjaan/{tender}/import', [PekerjaanController::class, 'import'])->name('pekerjaan.import');
Route::get('/pekerjaan/{import}/file', [PekerjaanController::class, 'download'])->name('pekerjaan.download');
Route::get('/pekerjaan/{tender}/pdf', [PekerjaanController::class, 'pdf'])->name('pekerjaan.pdf');

//Uraian
Route::get('/uraian/{tender}', [UraianController::class, 'index'])->name('uraian.index');
Route::post('/uraian/{tender}/store', [UraianController::class, 'store'])->name('uraian.store');
Route::delete('/uraian/{uraian}', [UraianController::class, 'destroy'])->name('uraian.destroy');
Route::get('/uraian/{uraian}/edit', [UraianController::class, 'index'])->name('uraian.edit');
Route::patch('/uraian/{uraian}/update', [UraianController::class, 'update'])->name('uraian.update');
Route::get('/uraian/{uraian}/file', [UraianController::class, 'download'])->name('uraian.download');

// User
Route::patch('/user/{user}/reset', [UserController::class, "resetPassword"])->name('user.reset');
Route::get('/user/log', [UserController::class, "userLog"])->name('user.log');
Route::resource('/user', UserController::class, ['except' => ['show']]);
Route::get('/panduan-pengguna', [DashboardController::class, 'manual'])->name('manual');
