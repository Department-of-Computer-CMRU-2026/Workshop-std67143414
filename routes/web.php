<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        $eventsCount = \App\Models\Event::count();
        $registrationsCount = \App\Models\Registration::count();
        $usersCount = \App\Models\User::where('role', 'user')->count();
        return view('admin.dashboard', compact('eventsCount', 'registrationsCount', 'usersCount'));
    }
    
    $userRegistrations = auth()->user()->registrations()->with('event')->get();
    return view('dashboard', compact('userRegistrations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/workshops', function () {
    $events = \App\Models\Event::withCount('registrations')->get();
    return view('workshops', compact('events'));
})->middleware(['auth', 'verified'])->name('workshops');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('events.register');



    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/registrations', [\App\Http\Controllers\EventController::class, 'registrations'])->name('admin.registrations');
        Route::resource('events', \App\Http\Controllers\EventController::class);
    });
});

require __DIR__.'/auth.php';
