<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/change-password', [AuthController::class,'showChangePassword'])->name('change-password');
Route::get('/forgot-password', [AuthController::class,'showForgotPassword'])->name('forgot-password');

Route::get("/", [DashboardController::class,"showDashboard"])->name("dashboard");

Route::get("/user", [UserController::class,"showUser"])->name('user');
Route::get("/user/create", [UserController::class,"create"])->name('user.create');
Route::post('/user/store', [UserController::class,'store'])->name('user.store');






Route::get("/form", [DashboardController::class,"showForm"])->name('form');
