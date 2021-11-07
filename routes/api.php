<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::get('/apiTest', function () {
        return 1;
    });

    
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
    Route::post('guard', 'Api\AuthController@getGuard');

    Route::group([
        'prefix' => 'employee',
        'namespace' => 'Api\Employee'
    ], function(){
        Route::resource('complaints','ComplaintsController');

        Route::get('tasksDone','TasksController@tasksDone');
        Route::get('taskNow','TasksController@taskNow');
        Route::get('taskWaiting','TasksController@taskWaiting');
        Route::post('tasksSendStore','TasksController@tasksSendStore');
        Route::any('tasksDelay/{id}','TasksController@tasksDelay');
        
        Route::get('taskShow/{id}','TasksController@taskShow');
        
        
        Route::get('/periodicTaskNow','PeriodicTasksController@taskNow');
        Route::get('/periodicTaskWaiting','PeriodicTasksController@taskWaiting');
        Route::get('/periodicTasksDone','PeriodicTasksController@tasksDone');
        Route::post('/periodicTaskSendStore','PeriodicTasksController@tasksSendStore');
        Route::any('/periodicTaskDelay/{id}','PeriodicTasksController@tasksDelay');

        Route::get('/periodicTaskShow/{id}','PeriodicTasksController@periodicTaskShow');

    });

    Route::group([
        'prefix' => 'supervisor',
        'namespace' => 'Api\Supervisor'
    ], function(){
        Route::resource('employees','EmployeesController');
        
        Route::get('/team/taskNow','TasksController@taskNowTeam');
        Route::get('/team/taskWaiting','TasksController@taskWaitingTeam');
        Route::get('/team/taskDone','TasksController@taskDoneTeam');
        Route::post('/team/taskStore','TasksController@taskStoreTeam');

        Route::get('/company/taskNow','TasksController@taskNowCompany');
        Route::get('/company/taskWaiting','TasksController@taskWaitingCompany');
        Route::get('/company/taskDone','TasksController@taskDoneCompany');
        Route::post('/company/taskStore','TasksController@taskStoreCompany');


        Route::get('/complaintNow','ComplaintsController@ComplaintNow');
        Route::get('/complaintAll','ComplaintsController@index');
        
        Route::get('/complaint/accept/{id}','ComplaintsController@ComplaintAccept');
        Route::get('/complaint/refused/{id}','ComplaintsController@ComplaintRefused');

                
        Route::get('/task/all','TasksController@index');
        Route::get('/task/new','TasksController@new');
        Route::get('/task/denay','TasksController@denay');
        Route::get('/task/waitingManager','TasksController@waiting');
        Route::get('/task/waitingEmp','TasksController@waitingEmp');

        Route::get('/task/show/{id}','TasksController@show');

        Route::get('/task/accept/{id}','TasksController@TaskAccept');
        Route::post('/task/refuserenew','TasksController@renewTask');
        Route::get('/taskDenay/refused/{id}','TasksController@TaskDelayRefused');
        Route::any('/task/acceptRenewDelay','TasksController@renewDelayTask');
        
        Route::get('/periodicTask/all','PeriodicTasksController@index');
        Route::get('/periodicTask/new','PeriodicTasksController@new');
        Route::get('/periodicTask/denay','PeriodicTasksController@denay');
        Route::get('/periodicTask/waitingManager','PeriodicTasksController@waiting');
        Route::get('/periodicTask/waitingEmp','PeriodicTasksController@waitingEmp');

        Route::get('/periodicTask/show/{id}','PeriodicTasksController@show');

        Route::get('/periodicTask/accept/{id}','PeriodicTasksController@TaskAccept');
        Route::post('/periodicTask/refuserenew','PeriodicTasksController@renewTask');
        Route::get('/periodicTaskDenay/refused/{id}','PeriodicTasksController@TaskDelayRefused');
        Route::any('/periodicTask/acceptRenewDelay','PeriodicTasksController@renewDelayTask');
    });

});
