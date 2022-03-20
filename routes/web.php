<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

use App\Models\CertificationType;
use App\Models\Employee;
use App\Models\EmployeeCertification;
use Carbon\Carbon;
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
Route::get('/test', function(){
    $certif_type = CertificationType::all()->pluck('cert_types')->toArray();
    $certis = EmployeeCertification::all()->toArray();

    $arr = array();
    foreach($certis as $ca){
        $arr[] = array_combine($certif_type,explode(',',$ca['certification_type']));
    }
    $di=array();
    foreach($certis as $cert){
        $di[] = $cert;
    }
    $result = array();
    foreach($arr as $k => $v){
        $result[$k] = array_merge($di[$k],$arr[$k]);
    }
});

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum','isAdmin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/upload_file', [DashboardController::class, 'upload_file'])->name('upload_file');
    Route::get('/delano', [ImagesController::class, 'delano'])->name('delano');
    Route::post('/images-upload', [ImagesController::class, 'upload_image'])->name('upload_image');
    Route::get('/certificationData', [DashboardController::class, 'certificationData']);
    Route::post('/addData', [DashboardController::class, 'addData']);
    Route::post('/editData', [DashboardController::class, 'editData']);
    Route::post('/deleteData', [DashboardController::class, 'deleteData']);
});


Route::middleware(['auth:sanctum','isRegularUser'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

