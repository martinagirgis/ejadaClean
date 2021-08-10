<?php

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

Route::get('/', function () {
    return view('admin.home');
});

Route::resource('supervisors','Admin\SupervisorController');
Route::resource('employees','Admin\EmployeesController');
Route::resource('teams','Admin\TeamsController');
Route::resource('sponsoringCompanies','Admin\SponsoringCompaniesController'); 
Route::resource('facilities','Admin\FacilitiesController'); 
