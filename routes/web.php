<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controlleracara;
use App\Http\Controllers\Controllerkomentar;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Models\Acara;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    $upcomingEvents = Acara::where('status', 'approved')
        ->where('Tanggal', '>=', Carbon::today())
        ->orderBy('Tanggal', 'asc')
        ->take(4)
        ->get();

    $pastEvents = Acara::where('status', 'approved')
        ->where('Tanggal', '<', Carbon::today())
        ->orderBy('Tanggal', 'desc')
        ->take(3)
        ->get();

    return view('home', compact('upcomingEvents', 'pastEvents'));
})->name('home');

// Static Pages
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Event Public Routes
Route::get('/events', [Controlleracara::class, 'index'])->name('acara.index');
Route::get('/search', [Controlleracara::class, 'search'])->name('acara.search');

// ⚠️ JANGAN TARUH Route::get('/events/{id}') DI SINI!

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ✅ Route spesifik HARUS DI ATAS route dinamis
    Route::get('/events/create', [Controlleracara::class, 'create'])->name('acara.create');
    Route::post('/events', [Controlleracara::class, 'store'])->name('acara.store');
    Route::get('/events/{id}/edit', [Controlleracara::class, 'edit'])->name('acara.edit');
    Route::put('/events/{id}', [Controlleracara::class, 'update'])->name('acara.update');
    Route::delete('/events/{id}', [Controlleracara::class, 'destroy'])->name('acara.destroy');

    // Comments Management
    Route::post('/comments', [Controllerkomentar::class, 'store'])->name('komentar.store');
    Route::delete('/comments/{id}', [Controllerkomentar::class, 'destroy'])->name('komentar.destroy');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        $userEvents = Acara::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('userEvents'));
    })->name('dashboard');
});

// ✅ PINDAHKAN KE SINI - Route dinamis {id} di paling bawah
Route::get('/events/{id}', [Controlleracara::class, 'show'])->name('acara.show');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Event Approval Management
    Route::post('/events/{id}/approve', [AdminController::class, 'approve'])->name('events.approve');
    Route::post('/events/{id}/reject', [AdminController::class, 'reject'])->name('events.reject');
    Route::delete('/events/{id}', [AdminController::class, 'destroy'])->name('events.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';