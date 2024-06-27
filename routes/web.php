<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportEmployeeController;
use App\Http\Controllers\AdministrativeRequestController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntityController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'twostep'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users-export', 'export')->name('users.export');
        Route::post('users-import', 'import')->name('users.import');
    });
});
Route::get('/profile/generate-pdf', [ProfileController::class, 'generatePDF'])->name('profile.generate-pdf');
Route::post('/save-player-id', function (Request $request) {
    $user = Auth::user();
    if ($user) {
        $user->onesignal_player_id = $request->player_id;
        $user->save();
    }

    return response()->json(['status' => 'Player ID saved']);
});
Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index')->name('users');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::get('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');


Route::get('/requests', [AdministrativeRequestController::class, 'index'])->name('requests.index');
Route::get('/requests/create', [AdministrativeRequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [AdministrativeRequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{request}/edit', [AdministrativeRequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{administrativeRequest}', [AdministrativeRequestController::class, 'update'])->name('requests.update');
Route::delete('/requests/{request}', [AdministrativeRequestController::class, 'destroy'])->name('requests.destroy');
Route::get('/requests/{id}/approve', [AdministrativeRequestController::class, 'approveRequest']);



Route::get('/entities', [EntityController::class, 'index'])->name('entities.index');
Route::get('/entities/create', [EntityController::class, 'create'])->name('entities.create');
Route::post('/entities', [EntityController::class, 'store'])->name('entities.store');
Route::get('/entities/{entity}/edit', [EntityController::class, 'edit'])->name('entities.edit');
Route::put('/entities/{entity}', [EntityController::class, 'update'])->name('entities.update');
Route::delete('/entities/{entity}', [EntityController::class, 'destroy'])->name('entities.destroy');

Route::post('/send-generated-pdf', [DocumentController::class, 'sendGeneratedPdf']);


Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');

Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
Route::put('/contracts/{id}', [ContractController::class, 'update'])->name('contracts.update');
Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');


require __DIR__.'/auth.php';
