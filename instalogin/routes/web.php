<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class);

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profiles.show');

Route::get('/logged_in', [ProfileController::class, 'loggedIn'])
    ->name('profiles.logged_in');

Route::get('/list_of_emails', [ProfileController::class, 'listOfEmails'])
    ->name('profiles.list_of_emails');

Route::get('/delete_email_address/{userEmail}', [ProfileController::class, 'deleteEmailAddress'])
    ->name('profiles.delete_email_address');

Route::get('/delete_email/{email}', [ProfileController::class, 'deleteEmail'])
    ->name('profiles.delete_email');

Route::get('/show_email/{email}', [ProfileController::class, 'showEmail'])
    ->name('profiles.show_email');

Route::get('/last_email', [ProfileController::class, 'lastEmailId'])
    ->name('profiles.last_email');


require __DIR__.'/auth.php';
