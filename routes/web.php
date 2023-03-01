<?php

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //programs routes
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs');
    Route::get('/program/{program}', [ProgramController::class, 'show'])->name('program');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs/create');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs/delete');
    Route::get('/programs/edit/{program}', [ProgramController::class, 'edit'])->name('programs/edit');
    Route::patch('/programs/{program}', [ProgramController::class, 'update'])->name('programs/update');


    //bug reporting routes
    Route::post('/report', [ReportController::class, 'store'])->name('report');
    Route::get('/program/{program}/report/create', [ReportController::class, 'create'])->name('report/create');
});
