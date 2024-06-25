<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/surat', [HomeController::class, 'showSurat']); 
    Route::post('/addSurat', [HomeController::class, 'addSurat'])->name('addSurat');
    Route::get('/deleteSurat/{id}', [HomeController::class, 'deleteSurat']);
    Route::get('/viewFile/{kondisi}/{filename}', [HomeController::class, 'viewFile'])->name('viewFile');

    Route::get('/suratKeluar', [HomeController::class, 'showSuratKeluar']); 
    Route::post('/addSuratKeluar', [HomeController::class, 'addSuratKeluar'])->name('addSuratKeluar');
    Route::get('/deleteSuratKeluar/{id}', [HomeController::class, 'deleteSuratKeluar']);

    Route::get('/disposisi', [HomeController::class, 'disposisi']);
    Route::post('/addDisposisi', [HomeController::class, 'addDisposisi'])->name('addDisposisi');
    Route::post("/updateDisposisi/{id}", [HomeController::class, "updateDisposisi"]);

    Route::get('/user', [UserController::class, 'index']);
    Route::post("/user/promote/{id}", [UserController::class, "promote"]);
    Route::post("/user/demote/{id}", [UserController::class, "demote"]);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/blank-page', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');

});