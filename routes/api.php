<?php

use App\Http\Controllers\Api\ContactController as ApiContactController;
use App\Http\Controllers\Api\SearchController as ApiSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/search', [ApiSearchController::class, 'search'])->name('api.search');
Route::post('/contact', [ApiContactController::class, 'store'])->name('api.contact');

