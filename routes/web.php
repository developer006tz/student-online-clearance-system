<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClearController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\PermissionController;

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
})->name('login');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('students', [StudentController::class, 'index'])->name(
            'students.index'
        );
        Route::post('students', [StudentController::class, 'store'])->name(
            'students.store'
        );
        Route::get('students/create', [
            StudentController::class,
            'create',
        ])->name('students.create');
        Route::get('students/{student}', [
            StudentController::class,
            'show',
        ])->name('students.show');
        Route::get('students/{student}/edit', [
            StudentController::class,
            'edit',
        ])->name('students.edit');
        Route::put('students/{student}', [
            StudentController::class,
            'update',
        ])->name('students.update');
        Route::delete('students/{student}', [
            StudentController::class,
            'destroy',
        ])->name('students.destroy');

        Route::get('users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('users/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name(
            'users.edit'
        );
        Route::put('users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name(
            'users.destroy'
        );

        Route::get('clearances', [ClearanceController::class, 'index'])->name(
            'clearances.index'
        );
        Route::post('clearances', [ClearanceController::class, 'store'])->name(
            'clearances.store'
        );
        Route::get('clearances/create', [
            ClearanceController::class,
            'create',
        ])->name('clearances.create');
        Route::get('clearances/{clearance}', [
            ClearanceController::class,
            'show',
        ])->name('clearances.show');
        Route::get('clearances/{clearance}/edit', [
            ClearanceController::class,
            'edit',
        ])->name('clearances.edit');
        Route::put('clearances/{clearance}', [
            ClearanceController::class,
            'update',
        ])->name('clearances.update');
        Route::delete('clearances/{clearance}', [
            ClearanceController::class,
            'destroy',
        ])->name('clearances.destroy');

        Route::get('clears', [ClearController::class, 'index'])->name(
            'clears.index'
        );
        Route::post('clears', [ClearController::class, 'store'])->name(
            'clears.store'
        );
        Route::get('clears/create', [ClearController::class, 'create'])->name(
            'clears.create'
        );
        Route::get('clears/{clear}', [ClearController::class, 'show'])->name(
            'clears.show'
        );
        Route::get('clears/{clear}/edit', [
            ClearController::class,
            'edit',
        ])->name('clears.edit');
        Route::put('clears/{clear}', [ClearController::class, 'update'])->name(
            'clears.update'
        );
        Route::delete('clears/{clear}', [
            ClearController::class,
            'destroy',
        ])->name('clears.destroy');
    });
