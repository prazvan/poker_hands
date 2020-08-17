<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Register the typical authentication routes for an application.
 * Laravel handles the registration/auth out of the box.
 */
Auth::routes();

// home will always redirect to the dashboard :)
Route::redirect('/', 'dashboard');

// auth routes
Route::middleware(['auth'])->group(function ()
{
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/reports', 'ReportsController@index')->name('reports');

    Route::post('/upload-files', 'UploadController@process')->name('upload-files');
});