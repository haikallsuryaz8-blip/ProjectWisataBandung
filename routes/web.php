<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceCommentController;

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

// Public entry point: visitors must log in before seeing the website content.
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::redirect('/home', '/')->name('home.alias');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes for logged-in users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');

    // This route sends admin users to admin dashboard and normal users to user dashboard.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin pages
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::redirect('/', '/admin/dashboard')->name('home');
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

        // Admin content management: admins can add, edit, update, and delete website content.
        Route::resource('places', PlaceController::class)->except(['index', 'show']);
    });

    // Keep old edit URLs working, but send admins to the admin URL.
    Route::middleware('admin')->get('/places/{place}/edit', function (\App\Models\Place $place) {
        return redirect()->route('admin.places.edit', $place);
    })->name('places.edit');

    // User pages: users can view destination content after logging in.
    Route::resource('places', PlaceController::class)->only(['index', 'show']);
    Route::post('/places/{place}/comments', [PlaceCommentController::class, 'store'])->name('places.comments.store');

    // User pages
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
    });
});
