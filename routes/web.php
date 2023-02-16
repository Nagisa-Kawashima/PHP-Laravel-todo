<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
// use App\Http\Controllers\DashboardController;
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
    return view('hello');
});
// Route::get('/',[TaskController::class,'index']);//一覧表示



// Route::post('/create',[TaskController::class,'create']);//タスク追加
// Route::get('/show/{id}', [TaskController::class, 'show']);

// Route::post('/edit{id}',[TaskController::class,'edit']);//タスク更新
// Route::post('/delete{id}',[TaskController::class,'delete']);//タスク削除
// Route::resource('tasks', TaskController::class);
#違う？？


Route::middleware(['auth', 'verified'])->group(function () {
});

// 上記で囲むことで、ログインされていること
// という制約
Route::post('/create',[TaskController::class,'create']);//タスク追加
Route::post('/edit',[TaskController::class,'edit']);//タスク更新
Route::post('/delete',[TaskController::class,'delete']);//タスク削除
Route::resource('tasks', TaskController::class);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    ##ここをdashboardcontrollerに変える？
  });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
