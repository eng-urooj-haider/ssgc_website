<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Web\BusinessPolicy;
use App\Livewire\Web\CompanyOffices;
use App\Livewire\Web\CoreValues;
use App\Livewire\Web\GenderPayGap;
use App\Livewire\Web\HseHandbook;
use App\Livewire\Web\HsePolicy;
use App\Livewire\Web\MeterPlant;
use App\Livewire\Web\Mission;
use App\Livewire\Web\Profile;
use App\Livewire\Web\Vision;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Website Static Pages
Route::get('profile', Profile::class)->name('profile');
Route::get('vision', Vision::class)->name('vision');
Route::get('mission', Mission::class)->name('mission');
Route::get('core-values', CoreValues::class)->name('core-values');
Route::get('meter-plant', MeterPlant::class)->name('meter-plant');
Route::get('gender-pay-gap', GenderPayGap::class)->name('gender-pay-gap');
Route::get('company-offices', CompanyOffices::class)->name('company-offices');
Route::get('business-policy', BusinessPolicy::class)->name('business-policy');
Route::get('hse-policy', HsePolicy::class)->name('hse-policy');
Route::get('hse-handbook', HseHandbook::class)->name('hse-handbook');

require __DIR__.'/settings.php';

// admin routes
Route::livewire('/board-of-directors/create', 'cms::board-of-directors.create');
