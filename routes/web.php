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

// 上記で囲むことで、ログインされていること
// という制約


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//verifiedはメールアドレスの認証にする機能　ログインする前の登録した段階でメール送信等の機能認証をする為のもの

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); //ok
    
    Route::post('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); //ok
    //タスク追加

    Route::get('/tasks/show/{id}', [TaskController::class, 'show'])->name('tasks.show'); //ok
    // タスク詳細 

    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit'); //ok


    Route::post('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
    //taskステータス更新、編集後の更新

    Route::post('/tasks/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
   //タスク削除
    // Route::resource('tasks', TaskController::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
