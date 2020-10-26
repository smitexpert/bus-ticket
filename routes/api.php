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

// Login Route
Route::namespace('Agent\Api')->group(function(){
    Route::post('agent/login', 'AuthController@login');
});

// This Middleware for agent Super Admin
Route::middleware('auth:api')->namespace('Agent\Api')->group(function(){
    
    Route::get('agent/users/role', 'AgentRoleController@index');

    Route::get('agent/users', 'AgentController@index');
    Route::post('agent/users', 'AgentController@store');
    Route::get('agent/users/{id}', 'AgentController@show');
    Route::put('agent/users/{id}', 'AgentController@update');
    Route::delete('agent/users/{id}', 'AgentController@delete');

    Route::prefix('agent')->group(function(){
        Route::get('counters', 'CounterController@index');
        Route::post('counters', 'CounterController@store');
        Route::get('counters/{id}', 'CounterController@show');
        Route::put('counters/{id}', 'CounterController@update');
        Route::delete('counters/{id}', 'CounterController@delete');
    });

    Route::prefix('agent')->group(function(){
        Route::get('clases', 'BusController@clases');
        Route::get('seat_plan', 'BusController@seat_plan');

        Route::get('buses', 'BusController@index');
        Route::post('buses', 'BusController@store');
        Route::get('buses/{id}', 'BusController@show');
        Route::put('buses/{id}', 'BusController@update');
        Route::delete('buses/{id}', 'BusController@delete');
    });

    Route::prefix('agent')->group(function(){
        Route::get('districts', 'RouteController@districts');

        Route::get('routes', 'RouteController@index');
        Route::post('routes', 'RouteController@store');
        Route::get('routes/{id}', 'RouteController@show');
        Route::put('routes/{id}', 'RouteController@update');
        Route::delete('routes/{id}', 'RouteController@delete');
    });

    Route::prefix('agent')->group(function(){
        Route::get('schedules', 'ScheduleController@index');
        Route::post('schedules', 'ScheduleController@store');
        Route::get('schedules/{id}', 'ScheduleController@show');
        Route::put('schedules/{id}', 'ScheduleController@update');
        Route::delete('schedules/{id}', 'ScheduleController@delete');
    });

    Route::prefix('agent')->group(function(){
        Route::get('tickets', 'TicketController@tickets');
        Route::get('tickets/details/{id}', 'TicketController@details');

        Route::get('tickets/search/{no}', 'TicketController@search');
        Route::put('tickets/cancel/{no}', 'TicketController@cancel');

        Route::post('schedules/search', 'TicketController@schedules');
        Route::get('schedules/details/{id}/{date}', 'TicketController@scheduleDetails');
        Route::get('agent/counter/{id}', 'TicketController@agentCounter');

        Route::post('tickets/sell', 'TicketController@sell');

        Route::get('manifest', 'ManifestController@index');
        Route::get('manifest/{id}', 'ManifestController@show');

        Route::post('reserves', 'TicketReservation@reserve');
        Route::get('reserves/{id}/{date}', 'TicketReservation@seats');
        Route::get('reserves/{seat}/{id}/{date}', 'TicketReservation@remove');

        Route::post('select', 'SelectTicketController@select');
        Route::get('select/{seat}/{id}/{date}', 'SelectTicketController@get');
        Route::post('select/{seat}/{id}/{date}', 'SelectTicketController@remove');

        // Route::get('test/{seat}/{id}/{date}', 'SelectTicketController@test');
        Route::post('agentsalesreport', 'SalesReportController@index');
    });
});
