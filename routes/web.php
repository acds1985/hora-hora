<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\DashboardController;
use App\Models\Certificados;
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


Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth'], ['roles' => 'admin']], function(){

    Route::any('/certificate-search', [CertificadosController::class, 'search'])->name('certificate.search');
    Route::get('/certificate-approve/{id}', [CertificadosController::class, 'approve'])->name('certificate.approve');
    Route::get('/certificate-notApprove/{id}', [CertificadosController::class, 'notApprove'])->name('certificate.notapprove');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
});

Route::group(['middleware' => ['auth'], ['roles' => 'student']], function(){
    Route::get('/certificate-create', [CertificadosController::class, 'create'])->name('certificate.create');
    Route::get('/certificate-edit/{id}', [CertificadosController::class, 'edit'])->name('certificate.edit');
    Route::put('/certificate-update/{id}', [CertificadosController::class, 'update'])->name('certificate.update');
    Route::get('/certificate-delete/{id}', [CertificadosController::class, 'destroy'])->name('certificate.delete');
    Route::post('/store', [CertificadosController::class, 'store'])->name('certificados.store');
});

require __DIR__.'/auth.php';
