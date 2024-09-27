<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

// common routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // tickets common routes
        Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');

        // admin-specific routes 
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles');
            Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');

            // ticket routes for admin only
            Route::get('tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
            Route::put('tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
            Route::delete('tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
            Route::post('/tickets/{id}/close', [TicketController::class, 'ticketClose'])->name('tickets.close');
        });
    });
});