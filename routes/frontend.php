<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'homepage')->name('homepage');

    Route::get('/catagory/{id}', 'catagoryPost')->name('catagory.post.all');
    Route::get('/subcatagory/{id}', 'subcatagoryPost')->name('subcatagory.post.all');
    Route::get('/user/{id}', 'userPost')->name('user.post.all');
    Route::get('/postDetails/{slug}', 'postDetails')->name('postDeatails.all');

    Route::get('/search-post', 'searchPost')->name('search.post');
    Route::post('/Comment', 'CommentStore')->name('comment.store');

    Route::get('/Parent_name', 'toGetParentName')->name('toGetParentName');
    Route::delete('/commentDelete', 'commentDelete')->name('commentDelete');

    // socialite login route
    Route::get('/auth/google-redirect/socialite', 'redirect')->name('redirect.anotherLogin');

    Route::get('/auth/callback/socialite', 'callback')->name('callbak.inWebsite');

    Route::get('/auth/facebook-redirect/socialite', 'facebookRedirect')->name('facebook.anotherLogin');

    Route::get('/auth/facebook-callback/socialite', 'facebookCallback')->name('facebook.inWebsite');
});
