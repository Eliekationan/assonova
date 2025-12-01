<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Onboarding/Index');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});


Route::get("/register-association", function(){
    return Inertia::render('Onboarding/AssoInfo');
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/member',[MembreController::class, 'index'])->name('member.index');
    Route::get('/member/insert',[MembreController::class, 'insert'])->name('member.insert');
    Route::get('/member/invite',[MembreController::class, 'invite'])->name('member.invite');


    Route::get('/cotisations',[CotisationController::class, 'index'])->name('cotisation.index');
    Route::get('/cotisations/rules-list',[CotisationController::class, 'rulesList'])->name('cotisation.ruleList');
    Route::get('/cotisations/new-rule',[CotisationController::class, 'newRule'])->name('cotisation.newRule');

    Route::get('/payments/initiate', [PaymentController::class, 'initiate'])->name('payments.initiate');
    Route::get('/payments/status/{payment}', [PaymentController::class, 'status'])->name('payments.status');
    // Callback/webhook from provider:
    Route::post('/payments/webhook', [PaymentController::class, 'webhook'])->name('payments.webhook');
});

require __DIR__.'/auth.php';
