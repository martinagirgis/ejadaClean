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
    return view('login');
});
Route::get('/admin', function () {
    return redirect()->route('companies.index');
});

Route::get('/cleanMaintananceManager', function () {
    return view('cleanMaintananceManager.home');
});

Route::get('/employee', function () {
    return view('employee.home');
});

Route::get('/generalManager', function () {
    return view('generalManager.home');
});

Route::get('/supervisor', function () {
    return view('supervisor.home');
});
//Admin
Route::resource('companies','Admin\CompaniesController');
Route::get('companies/passwords/{id}','Admin\CompaniesController@getPasswords')->name('companies.passwords.view');

//GeneralManager
Route::resource('qualityManagers','GeneralManager\QualityManagerController');
Route::resource('branches','GeneralManager\BranchesController');
Route::resource('generalManagerFacilities','GeneralManager\FacilitiesController');
Route::get('/generalManager/facilities/cleanAddtimes/{facility}','GeneralManager\FacilitiesController@cleanAddtimes')->name('generalManager.facilities.cleanAddtimes');
Route::get('/generalManager/facilities/mantananceAddtimes/{facility}','GeneralManager\FacilitiesController@mantananceAddtimes')->name('generalManager.facilities.mantananceAddtimes');
Route::resource('cleanMaintananceManagers','GeneralManager\CleanMaintananceManagerController');
Route::resource('generalManagerSponsoringCompanies','GeneralManager\SponsoringCompaniesController');
Route::resource('generalManagerTeams','GeneralManager\TeamsController');
Route::resource('generalManagerSupervisors','GeneralManager\SupervisorController');
Route::resource('generalManagerEmployees','GeneralManager\EmployeesController');

//CleanMaintananceManager
Route::resource('supervisors','CleanMaintananceManager\SupervisorController');
Route::resource('employees','CleanMaintananceManager\EmployeesController');
Route::resource('teams','CleanMaintananceManager\TeamsController');
Route::resource('sponsoringCompanies','CleanMaintananceManager\SponsoringCompaniesController');
Route::resource('facilities','CleanMaintananceManager\FacilitiesController');
Route::get('/facilities/cleanAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@cleanAddtimes')->name('facilities.cleanAddtimes');
Route::get('/facilities/mantananceAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@mantananceAddtimes')->name('facilities.mantananceAddtimes');

//supervisor
Route::resource('supervisorEmployees','Supervisor\EmployeesController');
Route::get('/supervisorTaskNow/{id}','Supervisor\EmployeesController@sendTaskNow')->name('supervisor.taskNow');
Route::get('/supervisorTaskAll/{id}','Supervisor\EmployeesController@taskAll')->name('supervisor.taskAll');

//employee
Route::resource('complaints','Employee\ComplaintsController');
Route::get('/taskNow/{id}','Employee\TasksController@sendTaskNow')->name('taskNow');
Route::get('/taskWaiting/{id}','Employee\TasksController@taskWaiting')->name('taskWaiting');
Route::get('/tasDone/{id}','Employee\TasksController@tasDone')->name('tasDone');
