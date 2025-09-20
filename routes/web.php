<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeamMemberController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::middleware('role:SuperAdmin')->group(function(){
        Route::get('/clients', [ClientController::class,'index'])->name('clients.index');
        Route::get('/clients/create', [ClientController::class,'create'])->name('clients.create');
        Route::post('/clients', [ClientController::class,'store'])->name('superadmin.clients.store');
    });

    Route::middleware('role:Admin')->group(function(){
        Route::get('/team-members', [TeamMemberController::class,'index'])->name('team.index');
        Route::get('/team-members/create', [TeamMemberController::class,'create'])->name('team.create');
        Route::post('/team-members', [TeamMemberController::class,'store'])->name('team.store');
    });

    Route::get('/short-urls', [ShortUrlController::class,'index'])->name('short-urls.index');
    Route::post('/short-urls', [ShortUrlController::class,'store'])->name('short-urls.store');
    Route::get('/short-urls/download', [ShortUrlController::class,'download'])->name('short-urls.download');

    Route::get('/r/{code}', [ShortUrlController::class,'resolve'])->name('short-urls.resolve');
});
