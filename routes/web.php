<?php

use App\Http\Controllers\Backend\CatagoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCatagoryController;
use App\Http\Controllers\HomeController;
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

Route::middleware(['auth', 'isBan'])->prefix('/admin')->group(function () {
    Route::middleware('isBan')->get('/daseboard', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/user/all', [HomeController::class, 'allUser'])->name('user.alldata');
    Route::get('/user/ban/{id}', [HomeController::class, 'banUser'])->name('user.ban');
    Route::get('/user/notban/{id}', [HomeController::class, 'notbanUser'])->name('user.notban');

    Route::put('/profile-info-update', [HomeController::class, 'profileInfoUpdate'])->name('profile.info.update');
    Route::put('/profile-password-update', [HomeController::class, 'profilePasswordUpdate'])->name('profile.password.update');

    Route::middleware('role:admin|writer')->prefix('/catagory')->controller(CatagoryController::class)->name('catagory.')->group(function () {
        Route::get('/', 'allCatagory')->name('all');
        Route::post('/add-catagory', 'addCatagory')->name('addCatagory');
        Route::get('/edit/{slug}', 'editCatagory')->name('edit');
        Route::put('/update/{slug}', 'updateCatagory')->name('update');
        Route::Delete('/delete/{id}', 'deleteCatagory')->name('delete');
    });
    Route::prefix('subCatagory')->controller(SubCatagoryController::class)->name('subCatagory.')->group(function () {
        Route::get('/', 'allSubCatagory')->name('all');
        Route::post('/add-subcatagory', 'addSubCatagory')->name('addSubCatagory');
        Route::get('/edit/{slug}', 'editSubCatagory')->name('edit');
        Route::put('/update/{slug}', 'updateSubCatagory')->name('update');
        Route::Delete('/delete/{id}', 'deleteSubCatagory')->name('delete');
    });

    Route::prefix('/Post')->controller(PostController::class)->name('Post.')->group(function () {
        Route::get('/addPost', 'addpost')->name('add');
        Route::get('/getDataforForm', 'getDataforForm')->name('getDataforForm');
        Route::post('/storePost', 'storePost')->name('storePost');
    });
});
