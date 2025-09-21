<?php

use App\Filament\Widgets\ScheduleCalendar;
use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\SchoolDashboardWidget;

//Route::get('/admin', function () {
//   return view('auth.admin'); // atau redirect ke halaman login Anda
//})->name('admin');

//Route::view('/admin/login', 'welcome')->name('admin.login');

// Redirect root ke halaman login Filament admin
Route::redirect('/', '/admin/login');

// Route for calendar events
Route::get('/admin/schedule-events', function () {
    $widget = new ScheduleCalendar();
    return response()->json($widget->getScheduleEvents());
})->name('admin.schedule.events');
