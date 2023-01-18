<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IndexController;
use App\Models\Category;
use App\Models\Image;

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
Auth::routes();
Route::get('/dashboard',function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/',[IndexController::class,'showFrontend'])->name('home');

//Category post
Route::get('home/cat/{id}',[IndexController::class,'getCategory'])->name('home/cat');
//single page post show
Route::get('page-post/{id}', [IndexController::class, 'singlePostShow'])->name('page');

//juery
// Route::post('/getCategory',[IndexController::class,'getCategory']);



// ----------------Routes for Author------------------------------

Route::group(['middleware'=>'auth'],function(){
Route::get('author',[AuthorController::class,'show'])->name('author.index');

//create new author
Route::view('create','blog/author/create')->name('author.create');
Route::post('store',[AuthorController::class,'store'])->name('author.store');

//edit for author
Route::get('edit/{id}',[AuthorController::class,'edit'])->name('author.edit');
Route::PATCH('update/{id}',[AuthorController::class,'update'])->name('author.update');

//delete for author
Route::DELETE('delete/{id}',[AuthorController::class,'destroy'])->name('author.delete');
});


// ----------------Routes for category------------------------------

Route::group(['prefix'=>'category','middleware'=>'auth'],function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    Route::get('/show/{category}',[CategoryController::class,'show'])->name('category.show');
    route::get('/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('/update/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
});

// .........................Routes for post..................

route::group(['prefix'=>'post','middleware'=>'auth'],function(){
    route::get('/',[PostController::class,'index'])->name('post.index');
    route::get('/create',[PostController::class,'create'])->name('post.create'); 
    route::post('/store',[PostController::class,'store'])->name('post.store');
    route::get('/show/{post}',[PostController::class,'show'])->name('post.show');
    route::get('/edit/{post}',[PostController::class,'edit'])->name('post.edit');
    route::put('/update/{post}',[PostController::class,'update'])->name('post.update');
    route::delete('/delete/{post}',[PostController::class,'delete'])->name('post.delete');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




