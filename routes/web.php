<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

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


Route::get('/',function () {
    return view('home');
})->name('home');



//view for author 
//Route::view('author','blog/author/index');
Route::view('create','blog/author/create');
Route::get('author',[AuthorController::class,'show']);
Route::post('store',[AuthorController::class,'store'])->name('store');

//edit for author
Route::get('edit/{id}',[AuthorController::class,'edit'])->name('edit');
Route::PATCH('update/{id}',[AuthorController::class,'update'])->name('update');

//delete for author
Route::DELETE('delete/{id}',[AuthorController::class,'destroy'])->name('delete');



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




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
