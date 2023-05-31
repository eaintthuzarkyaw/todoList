<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', 'customer/createPage')->name('post#home');
Route::get('customer/createPage', [PostController::class, 'createPage'])->name('post#createPage');
Route::post('post/create', [PostController::class, 'postCreate'])->name('post#create');

Route::get('post/delete/{id}', [PostController::class, 'postDelete'])->name('postDelete');
Route::get('post/read/{id}', [PostController::class, 'read'])->name('post#read');
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post#edit');
Route::post('post/update/{id}', [PostController::class, 'update'])->name('post#update');
