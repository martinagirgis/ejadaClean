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
Route::get('/', function () {
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
Route::get('/cleanManagerTeam/team/tasks/{id}','CleanMaintananceManager\TeamsController@allTasks')->name('cleanManager.team.tasks');
Route::get('/cleanManagerTeam/team/task/show/{id}','CleanMaintananceManager\TeamsController@showTask')->name('cleanManager.team.task.show');

Route::resource('sponsoringCompanies','CleanMaintananceManager\SponsoringCompaniesController');
Route::get('/cleanManagerCompany/company/tasks/{id}','CleanMaintananceManager\SponsoringCompaniesController@allTasks')->name('cleanManagerCompany.tasks');
Route::get('/cleanManagerCompany/company/task/show/{id}','CleanMaintananceManager\SponsoringCompaniesController@showTask')->name('cleanManagerCompany.task.show');

Route::resource('facilities','CleanMaintananceManager\FacilitiesController');
Route::get('/facilities/cleanAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@cleanAddtimes')->name('facilities.cleanAddtimes');
Route::any('/facilities/cleanStoretimes/{facility}','CleanMaintananceManager\FacilitiesController@cleanStoretimes')->name('facilities.cleanStoretimes');
Route::get('/facilities/mantananceAddtimes/{facility}','CleanMaintananceManager\FacilitiesController@mantananceAddtimes')->name('facilities.mantananceAddtimes');
Route::any('/facilities/mantananceStoretimes/{facility}','CleanMaintananceManager\FacilitiesController@mantananceStoretimes')->name('facilities.mantananceStoretimes');
Route::any('/facilities/times/delete/{time}','CleanMaintananceManager\FacilitiesController@deleteTime')->name('facilities.times.delete');

Route::get('/managerCleanComplaintNow','CleanMaintananceManager\ComplaintsController@ComplaintNow')->name('managerClean.ComplaintNow');
Route::get('/managerCleanComplaintAll','CleanMaintananceManager\ComplaintsController@index')->name('managerClean.ComplaintAll');
Route::get('/managerClean/complaints/index/searsh/{id}','CleanMaintananceManager\ComplaintsController@indexSerch')->name('CleanMaintananceManager.complaints.index.searsh');
Route::get('/managerClean/complaints/now/searsh/{id}','CleanMaintananceManager\ComplaintsController@nowSearsh')->name('CleanMaintananceManager.task.now.searsh');

Route::get('/managerCleanComplaint/accept/{id}','CleanMaintananceManager\ComplaintsController@ComplaintAccept')->name('managerClean.Complaint.accept');
Route::get('/managerCleanComplaint/refused/{id}','CleanMaintananceManager\ComplaintsController@ComplaintRefused')->name('managerClean.Complaint.refused');

Route::get('/managerCleanTasksNow','CleanMaintananceManager\TasksController@taskNow')->name('managerClean.taskNow');
Route::get('/managerCleanTasksAll','CleanMaintananceManager\TasksController@tasksAll')->name('managerClean.tasksAll');
Route::get('/managerClean/task/index/searsh/{id}','CleanMaintananceManager\TasksController@indexSerch')->name('CleanMaintananceManager.task.index.searsh');
Route::get('/managerClean/task/now/searsh/{id}','CleanMaintananceManager\TasksController@nowSearsh')->name('CleanMaintananceManager.task.now.searsh');

Route::get('/managerCleanTasksNew/{id}','CleanMaintananceManager\TasksController@createTaskComplaint')->name('managerClean.createTaskComplaint');
Route::get('/managerCleanTasksNew','CleanMaintananceManager\TasksController@createTask')->name('managerClean.createTask');
Route::post('/managerCleanTasksStore','CleanMaintananceManager\TasksController@StoreTask')->name('managerClean.StoreTask');
Route::any('/managerCleanTaskEdit/{id}','CleanMaintananceManager\TasksController@editTask')->name('managerClean.editTask');
Route::any('/managerCleanTaskUpdate/{id}','CleanMaintananceManager\TasksController@updateTask')->name('managerClean.updateTask');
Route::delete('/managerCleanTasksDelete/{id}','CleanMaintananceManager\TasksController@DeleteTask')->name('managerClean.DeleteTask');
Route::any('/managerCleanTaskShow/{id}','CleanMaintananceManager\TasksController@show')->name('managerClean.show');
Route::get('/managerCleanTask/accept/{id}','CleanMaintananceManager\TasksController@TaskAccept')->name('managerClean.Task.accept');
Route::get('/managerCleanTask/refused/{id}','CleanMaintananceManager\TasksController@TaskRefused')->name('managerClean.Task.refused');
Route::get('/managerCleanTask/renewTask/{id}','CleanMaintananceManager\TasksController@renewTask')->name('managerClean.Task.renew');

Route::get('/getTypeMempers','CleanMaintananceManager\TasksController@getTypeMempers');

Route::get('/managerCleanTask/confirmPeriodicTask/{id}','CleanMaintananceManager\PeriodicTasksController@confirmPeriodicTask')->name('confirm.periodic.task');
Route::get('/managerCleanTask/addPeriodicTask','CleanMaintananceManager\PeriodicTasksController@addPeriodicTask')->name('add.periodic.task');

Route::get('/managerCleanPeriodicTasksNow','CleanMaintananceManager\PeriodicTasksController@taskNow')->name('managerClean.PeriodicTasks.Now');
Route::get('/managerCleanPeriodicTasksAll','CleanMaintananceManager\PeriodicTasksController@tasksAll')->name('managerClean.PeriodicTasks.All');
Route::get('/managerClean/PeriodicTasks/index/searsh/{id}','CleanMaintananceManager\PeriodicTasksController@indexSerch')->name('CleanMaintananceManager.PeriodicTasks.index.searsh');
Route::get('/managerClean/PeriodicTasks/now/searsh/{id}','CleanMaintananceManager\PeriodicTasksController@nowSearsh')->name('CleanMaintananceManager.PeriodicTasks.now.searsh');

Route::get('/managerCleanPeriodicTasksNew/{id}','CleanMaintananceManager\PeriodicTasksController@createTaskComplaint')->name('managerClean.create.PeriodicTasks.Complaint');
Route::get('/managerCleanPeriodicTasksNew','CleanMaintananceManager\PeriodicTasksController@createTask')->name('managerClean.create.PeriodicTasks');
Route::post('/managerCleanPeriodicTasksStore','CleanMaintananceManager\PeriodicTasksController@StoreTask')->name('managerClean.Store.PeriodicTasks');
Route::any('/managerCleanPeriodicTaskEdit/{id}','CleanMaintananceManager\PeriodicTasksController@editTask')->name('managerClean.edit.PeriodicTasks');
Route::any('/managerCleanPeriodicTaskUpdate/{id}','CleanMaintananceManager\PeriodicTasksController@updateTask')->name('managerClean.update.PeriodicTasks');
Route::delete('/managerCleanPeriodicTasksDelete/{id}','CleanMaintananceManager\PeriodicTasksController@DeleteTask')->name('managerClean.Delete.PeriodicTasks');
Route::any('/managerCleanPeriodicTasksShow/{id}','CleanMaintananceManager\PeriodicTasksController@show')->name('managerClean.PeriodicTasks.show');
Route::get('/managerCleanPeriodicTasks/accept/{id}','CleanMaintananceManager\PeriodicTasksController@TaskAccept')->name('managerClean.PeriodicTasks.accept');
Route::get('/managerCleanPeriodicTasks/refused/{id}','CleanMaintananceManager\PeriodicTasksController@TaskRefused')->name('managerClean.PeriodicTasks.refused');
Route::get('/managerCleanPeriodicTasks/renewTask/{id}','CleanMaintananceManager\PeriodicTasksController@renewTask')->name('managerClean.PeriodicTasks.renew');

Route::resource('complaintsLists','CleanMaintananceManager\ComplaintsListController');

/////////////////////////////////////////////////////////////////////////////////

//supervisor
Route::get('/supervisor', 'Supervisor\HomeController@index')->name('supervisor.dashboard');
Route::resource('supervisorEmployees','Supervisor\EmployeesController');

Route::get('/supervisorEmployees/tasks/{id}','Supervisor\EmployeesController@allTasks')->name('supervisorEmployees.tasks');
Route::get('/supervisorEmployees/task/show/{id}','Supervisor\EmployeesController@showTask')->name('supervisorManagerEmployees.task.show');

Route::get('/supervisorTaskNow/{id}','Supervisor\EmployeesController@sendTaskNow')->name('supervisor.taskNow');
Route::get('/employee/taskNow/searsh/{id}','Employee\TasksController@taskNowSearsh')->name('employee.taskNow.searsh');

Route::get('/supervisorTaskAll/{id}','Supervisor\EmployeesController@taskAll')->name('supervisor.taskAll');

Route::get('/supervisorComplaintNow','Supervisor\ComplaintsController@ComplaintNow')->name('supervisor.ComplaintNow');
Route::get('/supervisorComplaintAll','Supervisor\ComplaintsController@index')->name('supervisor.ComplaintAll');
Route::get('/supervisor/complaints/index/searsh/{id}','Supervisor\ComplaintsController@indexSerch')->name('supervisor.complaints.index.searsh');
Route::get('/supervisor/complaints/now/searsh/{id}','Supervisor\ComplaintsController@nowSearsh')->name('supervisor.task.now.searsh');

Route::get('/supervisorComplaint/accept/{id}','Supervisor\ComplaintsController@ComplaintAccept')->name('supervisor.Complaint.accept');
Route::get('/supervisorComplaint/refused/{id}','Supervisor\ComplaintsController@ComplaintRefused')->name('supervisor.Complaint.refused');

Route::any('/supervisorTaskIndex','Supervisor\TasksController@index')->name('supervisor.task.index');
Route::get('/supervisor/tasks/all/searsh/{id}','Supervisor\TasksController@tasksallSearsh')->name('supervisor.tasksall.searsh');
Route::get('/supervisor/tasks/new/searsh/{id}','Supervisor\TasksController@newSearsh')->name('supervisor.task.new.searsh');
Route::get('/supervisor/tasks/denay/searsh/{id}','Supervisor\TasksController@denaySearsh')->name('supervisor.task.denay.searsh');
Route::get('/supervisor/tasks/waiting/searsh/{id}','Supervisor\TasksController@waitingSearsh')->name('supervisor.task.waiting.searsh');
Route::get('/supervisor/tasks/waitingEmp/searsh/{id}','Supervisor\TasksController@taskswaitingEmpSearsh')->name('supervisor.task.waitingEmp.searsh');

Route::any('/supervisorTaskShow/{id}','Supervisor\TasksController@show')->name('supervisor.task.show');

Route::get('/supervisorTask/accept/{id}','Supervisor\TasksController@TaskAccept')->name('supervisor.Task.accept');
Route::get('/supervisorTask/refused/{id}','Supervisor\TasksController@TaskRefused')->name('supervisor.Task.refused');
Route::any('/supervisorTask/renewTask','Supervisor\TasksController@renewTask')->name('supervisor.Task.renew');
Route::get('/supervisorTaskDenay/accept/{id}','Supervisor\TasksController@TaskDelayAccept')->name('supervisor.Task.DelayAccept');
Route::get('/supervisorTaskDenay/refused/{id}','Supervisor\TasksController@TaskDelayRefused')->name('supervisor.Task.DelayRefused');
Route::any('/supervisorTask/renewDelayTask','Supervisor\TasksController@renewDelayTask')->name('supervisor.Task.renewDelay');

Route::any('/supervisorTaskNew','Supervisor\TasksController@new')->name('supervisor.task.new');
Route::any('/supervisorTaskdenay','Supervisor\TasksController@denay')->name('supervisor.task.denay');
Route::any('/supervisorTaskwaiting','Supervisor\TasksController@waiting')->name('supervisor.task.waiting');
Route::any('/supervisorTaskwaitingEmployee','Supervisor\TasksController@waitingEmp')->name('supervisor.task.waitingEmp');

Route::get('/taskNowTeam','Supervisor\TasksController@taskNowTeam')->name('supervisor.task.NowTeam');
Route::get('/taskWaitingTeam','Supervisor\TasksController@taskWaitingTeam')->name('supervisor.task.WaitingTeam');
Route::get('/taskDoneTeam','Supervisor\TasksController@taskDoneTeam')->name('supervisor.task.DoneTeam');
Route::get('/taskSendTeam/{id}','Supervisor\TasksController@taskSendTeam')->name('supervisor.task.SendTeam');
Route::any('/taskStoreTeam','Supervisor\TasksController@taskStoreTeam')->name('supervisor.task.StoreTeam');

Route::get('/supervisor/tasks/team/done/searsh/{id}','Supervisor\TasksController@teamDoneSearsh')->name('supervisor.team.done.searsh');
Route::get('/supervisor/tasks/team/now/searsh/{id}','Supervisor\TasksController@teamnowSearsh')->name('supervisor.team.now.searsh');
Route::get('/supervisor/tasks/team/waiting/searsh/{id}','Supervisor\TasksController@teamwaitingSearsh')->name('supervisor.team.waiting.searsh');

Route::get('/supervisor/tasks/company/done/searsh/{id}','Supervisor\TasksController@companyDoneSearsh')->name('supervisor.company.done.searsh');
Route::get('/supervisor/tasks/company/now/searsh/{id}','Supervisor\TasksController@companynowSearsh')->name('supervisor.company.now.searsh');
Route::get('/supervisor/tasks/company/waiting/searsh/{id}','Supervisor\TasksController@companySearsh')->name('supervisor.company.waiting.searsh');

Route::get('/taskNowCompany','Supervisor\TasksController@taskNowCompany')->name('supervisor.task.NowCompany');
Route::get('/taskWaitingCompany','Supervisor\TasksController@taskWaitingCompany')->name('supervisor.task.WaitingCompany');
Route::get('/taskDoneCompany','Supervisor\TasksController@taskDoneCompany')->name('supervisor.task.DoneCompany');
Route::get('/taskSendCompany/{id}','Supervisor\TasksController@taskSendCompany')->name('supervisor.task.SendCompany');
Route::any('/taskStoreCompany','Supervisor\TasksController@taskStoreCompany')->name('supervisor.task.StoreCompany');



Route::any('/supervisorPeriodicTasksIndex','Supervisor\PeriodicTasksController@index')->name('supervisor.PeriodicTasks.index');
Route::any('/supervisorPeriodicTasksShow/{id}','Supervisor\PeriodicTasksController@show')->name('supervisor.PeriodicTasks.show');

Route::get('/supervisorPeriodicTasks/accept/{id}','Supervisor\PeriodicTasksController@TaskAccept')->name('supervisor.PeriodicTasks.accept');
Route::get('/supervisorPeriodicTasks/refused/{id}','Supervisor\PeriodicTasksController@TaskRefused')->name('supervisor.PeriodicTasks.refused');
Route::any('/supervisorPeriodicTasks/renewTask','Supervisor\PeriodicTasksController@renewTask')->name('supervisor.PeriodicTasks.renew');
Route::get('/supervisorPeriodicTasksDenay/accept/{id}','Supervisor\PeriodicTasksController@TaskDelayAccept')->name('supervisor.PeriodicTasks.DelayAccept');
Route::get('/supervisorPeriodicTasksDenay/refused/{id}','Supervisor\PeriodicTasksController@TaskDelayRefused')->name('supervisor.PeriodicTasks.DelayRefused');
Route::any('/supervisorPeriodicTasks/renewDelayTask','Supervisor\PeriodicTasksController@renewDelayTask')->name('supervisor.PeriodicTasks.renewDelay');

Route::any('/supervisorPeriodicTasksNew','Supervisor\PeriodicTasksController@new')->name('supervisor.PeriodicTasks.new');
Route::any('/supervisorPeriodicTasksdenay','Supervisor\PeriodicTasksController@denay')->name('supervisor.PeriodicTasks.denay');
Route::any('/supervisorPeriodicTaskswaiting','Supervisor\PeriodicTasksController@waiting')->name('supervisor.PeriodicTasks.waiting');
Route::any('/supervisorPeriodicTaskswaitingEmployee','Supervisor\PeriodicTasksController@waitingEmp')->name('supervisor.PeriodicTasks.waitingEmp');

Route::get('/supervisor/periodic/all/searsh/{id}','Supervisor\PeriodicTasksController@allSearsh')->name('supervisor.periodic.all.searsh');
Route::get('/supervisor/periodic/new/searsh/{id}','Supervisor\PeriodicTasksController@newSearsh')->name('supervisor.periodic.new.searsh');
Route::get('/supervisor/periodic/denay/searsh/{id}','Supervisor\PeriodicTasksController@denaySearsh')->name('supervisor.periodic.denay.searsh');
Route::get('/supervisor/periodic/waiting/searsh/{id}','Supervisor\PeriodicTasksController@waitingSearsh')->name('supervisor.periodic.waiting.searsh');
Route::get('/supervisor/periodic/waitingEmp/searsh/{id}','Supervisor\PeriodicTasksController@taskswaitingEmpSearsh')->name('supervisor.periodic.waitingEmp.searsh');


////////////////////////////////////////////////////////////////////////////
//employee
Route::get('/employee', 'Employee\HomeController@index')->name('employee.dashboard');
Route::resource('complaints','Employee\ComplaintsController');
Route::get('/employee/complaints/searsh/{id}','Employee\ComplaintsController@complaintsSearsh')->name('employee.complaints.searsh');

Route::get('/taskNow','Employee\TasksController@taskNow')->name('taskNow');
Route::get('/employee/taskNow/searsh/{id}','Employee\TasksController@taskNowSearsh')->name('employee.taskNow.searsh');

Route::get('/taskWaiting','Employee\TasksController@taskWaiting')->name('taskWaiting');
Route::get('/employee/taskWaiting/searsh/{id}','Employee\TasksController@taskWaitingSearsh')->name('employee.taskWaiting.searsh');

Route::get('/tasksDone','Employee\TasksController@tasksDone')->name('tasksDone');
Route::get('/employee/tasksDone/searsh/{id}','Employee\TasksController@tasksDoneSearsh')->name('employee.tasksDone.searsh');

Route::get('/tasksSend/{id}','Employee\TasksController@tasksSend')->name('tasksSend');
Route::any('/tasksSendStore','Employee\TasksController@tasksSendStore')->name('tasksSendStore');

Route::any('/tasksDelay/{id}','Employee\TasksController@tasksDelay')->name('tasksDelay');

Route::any('/taskShow/{id}','Employee\TasksController@taskShow')->name('task.show');


Route::get('/periodicTaskNow','Employee\PeriodicTasksController@taskNow')->name('periodicTask.Now');
Route::get('/employee/periodicTaskNow/searsh/{id}','Employee\PeriodicTasksController@periodicTaskNowSearsh')->name('employee.periodicTaskNow.searsh');

Route::get('/periodicTaskWaiting','Employee\PeriodicTasksController@taskWaiting')->name('periodicTask.Waiting');
Route::get('/employee/periodicTaskWaiting/searsh/{id}','Employee\PeriodicTasksController@periodicTaskWaitingSearsh')->name('employee.periodicTaskWaiting.searsh');

Route::get('/periodicTasksDone','Employee\PeriodicTasksController@tasksDone')->name('periodicTask.Done');
Route::get('/employee/periodicTasksDone/searsh/{id}','Employee\PeriodicTasksController@periodicTasksDoneSearsh')->name('employee.periodicTasksDone.searsh');

Route::get('/periodicTaskSend/{id}','Employee\PeriodicTasksController@tasksSend')->name('periodicTask.Send');
Route::any('/periodicTaskSendStore','Employee\PeriodicTasksController@tasksSendStore')->name('periodicTask.SendStore');
Route::any('/periodicTaskDelay/{id}','Employee\PeriodicTasksController@tasksDelay')->name('periodicTask.Delay');

Route::any('/periodicTaskShow/{id}','Employee\PeriodicTasksController@periodicTaskShow')->name('periodicTask.show');

Route::get('/complaintslist/complaintsLists','Employee\ComplaintsController@getComplaintsLists');


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
