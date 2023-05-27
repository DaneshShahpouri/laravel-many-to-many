<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\GuestProjectController;
use App\Http\Controllers\Guest\GuestTechnologyController;
use App\Http\Controllers\Guest\GuestTypeController;

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





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('projects', ProjectController::class)->middleware('auth', 'verified');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(
    function () {
        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
        Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
        Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug']);

        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('search', [ProjectController::class, 'search'])->name('search');
        Route::get('showroom', function () {
            return view('admin.showroom');
        })->name('showroom');
    }
);




// GUEST-index
//-------------------------------
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('admin/home', [PageController::class, 'adminindex'])->name('admin.home');
Route::resource('projects', GuestProjectController::class)->parameters(['projects' => 'project:slug']);
Route::resource('types', GuestTypeController::class)->parameters(['types' => 'type:slug']);
Route::resource('technologies', GuestTechnologyController::class)->parameters(['technologies' => 'technology:slug']);
//-------------------------------


require __DIR__ . '/auth.php';
