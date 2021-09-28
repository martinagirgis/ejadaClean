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
Auth::routes();
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::any('/checkAuthLogin', 'HomeController@checkAuthLogin')->name('check.auth.login');
Route::any('/adminLogin/{password}/{email}', 'Auth\AdminLoginController@login')->name('admin.login.toty');
Route::any('/companyGeneralManagerLogin/{password}/{email}', 'Auth\GeneralManagerLoginController@login')->name('company_general_manager.login');
Route::any('/qualityManagerLogin/{password}/{email}', 'Auth\QualityManagerLoginController@login')->name('quality_manager.login');
Route::any('/cleanMantananceManager/{password}/{email}', 'Auth\CleanMaintananceManagerLoginController@login')->name('clean_mantanance_manager.login');
Route::any('/supervisorLogin/{password}/{email}', 'Auth\SupervisorLoginController@login')->name('supervisor.login');
Route::any('/userLogin/{password}/{email}', 'Auth\EmployeeLoginController@login')->name('employee.login');

///////////////////////////////////////////////////////////////////////////////

//Admin
Route::get('/admin', function () {
    return redirect()->route('companies.index');
})->name('admin.companies.index');
Route::resource('companies','Admin\CompaniesController');
Route::get('companies/passwords/{id}','Admin\CompaniesController@getPasswords')->name('companies.passwords.view');

/////////////////////////////////////////////////////////////////

//GeneralManager
Route::get('/generalManager','GeneralManager\HomeController@index')->name('company_general_manager.dashboard');
Route::resource('qualityManagers','GeneralManager\QualityManagerController');
Route::resource('branches','GeneralManager\BranchesController');
Route::resource('cleanMaintananceManagers','GeneralManager\CleanMaintananceManagerController');
Route::resource('generalManagerSupervisors','GeneralManager\SupervisorController');
Route::resource('generalManagerEmployees','GeneralManager\EmployeesController');
Route::get('/generalManagerEmployees/tasks/{id}','GeneralManager\EmployeesController@allTasks')->name('generalManagerEmployees.tasks');
Route::get('/generalManagerEmployees/task/show/{id}','GeneralManager\EmployeesController@showTask')->name('generalManagerEmployees.task.show');


//////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////

//CleanMaintananceManager
Route::get('/cleanMaintananceManager', 'CleanMaintananceManager\HomeController@index')->name('clean_mantanance_manager.dashboard');

Route::resource('supervisors','CleanMaintananceManager\SupervisorController');

Route::resource('employees','CleanMaintananceManager\EmployeesController');
Route::get('/cleanManagerEmployees/tasks/{id}','CleanMaintananceManager\EmployeesController@allTasks')->name('cleanManagerEmployees.tasks');
Route::get('/cleanManagerEmployees/task/show/{id}','CleanMaintananceManager\EmployeesController@showTask')->name('cleanManagerEmployees.task.show');

Route::resource('teams','CleanMaintananceManager\TeamsController');
Route::any('/team/member/delete/{id}','CleanMaintananceManager\TeamsController@deleteMember')->name('teamMember.delete');

Route::resource('sponsoringCompanies','CleanMaintananceManager\SponsoringCompaniesController');
Route::get('/cleanManagerCompany/company/tasks/{id}','CleanMaintananceManager\SponsoringCompaniesController@allTasks')->name('cleanManagerCompany.tasks');
Route::get('/cleanManagerCompany/company/task/show/{id}','CleanMaintananceManager\SponsoringCompaniesController@showTask')->name('cleanManagerCompany.task.show');

Route::resource('facilities','CleanMaintananceManager\FacilitiesController');
Route::get('/facilities/cleanAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@cleanAddtimes')->name('facilities.cleanAddtimes');
Route::any('/facilities/cleanStoretimes/{facility}','CleanMaintananceManager\FacilitiesController@cleanStoretimes')->name('facilities.cleanStoretimes');
Route::get('/facilities/mantananceAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@mantananceAddtimes')->name('facilities.mantananceAddtimes');
Route::any('/facilities/mantananceStoretimes/{facility}','CleanMaintananceManager\FacilitiesController@mantananceStoretimes')->name('facilities.mantananceStoretimes');
Route::any('/facilities/times/delete/{time}','CleanMaintananceManager\FacilitiesController@deleteTime')->name('facilities.times.delete');

/////////////////////////////////////////////////////////////////////////////////

//supervisor
Route::get('/supervisor', 'Supervisor\HomeController@index')->name('supervisor.dashboard');
Route::resource('supervisorEmployees','Supervisor\EmployeesController');

Route::get('/supervisorEmployees/tasks/{id}','Supervisor\EmployeesController@allTasks')->name('supervisorEmployees.tasks');
Route::get('/supervisorEmployees/task/show/{id}','Supervisor\EmployeesController@showTask')->name('supervisorManagerEmployees.task.show');

Route::get('/supervisorTaskNow/{id}','Supervisor\EmployeesController@sendTaskNow')->name('supervisor.taskNow');
Route::get('/supervisorTaskAll/{id}','Supervisor\EmployeesController@taskAll')->name('supervisor.taskAll');


////////////////////////////////////////////////////////////////////////////
//employee
Route::get('/employee', 'Employee\HomeController@index')->name('employee.dashboard');
Route::resource('complaints','Employee\ComplaintsController');
Route::get('/taskNow/{id}','Employee\TasksController@sendTaskNow')->name('taskNow');
Route::get('/taskWaiting/{id}','Employee\TasksController@taskWaiting')->name('taskWaiting');
Route::get('/tasDone/{id}','Employee\TasksController@tasDone')->name('tasDone');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
