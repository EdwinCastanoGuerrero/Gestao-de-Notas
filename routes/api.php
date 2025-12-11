
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;


// Route::get('/users', [UserController::class, 'index']);

Route::apiResource('users', UserController::class);

Route::apiResource('notes', NoteController::class);
