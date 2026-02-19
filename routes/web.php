<?php

use App\Http\Controllers\Admin\ImpersonateUserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');
Route::get('/admin/users/{user}/impersonate', ImpersonateUserController::class)
    ->middleware('auth')
    ->name('admin.users.impersonate');
