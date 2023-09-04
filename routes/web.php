<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/', 'welcome')->name('homepage');
Route::view('/users/create', 'users.create' )->name('user.create');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/user-create', [UserController::class, 'store']);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/users/export-users', [ExportController::class, 'export'])->name('export.users');






//learn
Route::get('/terms', function(){
    return response('Hello this is terms!')->cookie(
        'terms_cookie', 'this_is_temp_cookie', 1
    );
})->middleware('cache.headers:public;max_age=121212;etag');

Route::middleware('cache.headers:public;max_age=11111111')->group(function(){
    Route::get('/response', function(){
        return response('this response is from object',200)
                ->header('Content-type', 'text');
    });
});
