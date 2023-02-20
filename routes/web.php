<?php

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

Route::get('/',[App\Http\Controllers\Category::class, 'index'])->name('index');

Route::controller(\App\Http\Controllers\Ads::class)->group(function(){
    Route::get('/{slug}', 'index')->name('ads.index');
    Route::post('/{slug}', 'store')->name('ads.store');

});

Route::resource('comments', \App\Http\Controllers\CommentController::class)->only([
    'index','store'
]);

Route::controller(\App\Http\Controllers\CommentController::class)->prefix('admin/comments')->group(function(){
    Route::get('/', 'adminCommentsIndex');
    Route::post('/update/{id}', 'update')->name('admin.comments.update');
    Route::get('/delete/{id}', 'destroy')->name('admin.comments.destroy');

});

Route::post('/answer/{id}',  [App\Http\Controllers\AnswerController::class, 'store'])->name('answers.store');

Route::controller(\App\Http\Controllers\AnswerController::class)->prefix('admin/answers')->group(function(){
    Route::post('/update/{id}', 'update')->name('admin.answers.update');
    Route::get('/delete/{id}', 'destroy')->name('admin.answers.destroy');

});
