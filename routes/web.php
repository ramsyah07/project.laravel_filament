<?php

use Illuminate\Support\Facades\Route;

//Route::get('/admin', function () {
//   return view('auth.admin'); // atau redirect ke halaman login Anda
//})->name('admin');

//Route::view('/admin/login', 'welcome')->name('admin.login');

// Redirect root ke halaman login Filament admin
Route::redirect('/', '/admin/login');
