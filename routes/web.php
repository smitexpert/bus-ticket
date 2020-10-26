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
    return view('website.index.index');
});

Route::get('/time', function () {
    return date("H:i");
});

Route::post('ticket/cancel', 'WebsiteController@ticketCancel')->name('website.ticket.cancel');
// Route::get('layout', 'WebsiteController@index');

Route::get('location/get', 'LocationController@location')->name('location.get');

// Route::prefix('bus')->namespace('website')->group(function(){
//     Route::post('routes')->name('website.bus.routes');
// });

Route::prefix('search')->namespace('Search')->group(function(){
    Route::prefix('bus')->group(function(){
        Route::post('get', 'BusController@get')->name('search.bus.get');
        Route::post('detail', 'BusController@detail')->name('search.bus.detail');
        Route::post('buy', 'BusController@buy')->name('search.bus.buy');
    });

    Route::prefix('cancel')->group(function(){
        Route::post('ticket', 'CancelTicketController@get')->name('search.cancel.ticket');
    });
});


Route::prefix('admin')->namespace('Admin')->group(function(){

    Route::get('home', function () {
        return redirect(route('admin.dashboard'));
    })->name('admin.home');

    // Route::get('agent/role', 'AgentRoleController@index')->name('agent.role.index');

    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('location', 'LocationController@index')->name('admin.location');
    Route::post('location', 'LocationController@create')->name('admin.location.create');

    Route::get('profile', 'ProfileController@index')->name('admin.profile');
    Route::post('profile/info/update', 'ProfileController@updateInfo')->name('admin.profile.info.update');

    Route::prefix('bus')->namespace('Bus')->group(function(){

        Route::get('reports', 'ReportController@index')->name('admin.bus.report.index');
        Route::get('reports/get', 'ReportController@get')->name('admin.bus.report.get');
        
        Route::get('ticket', 'TicketController@index')->name('admin.ticket.index');
        Route::post('ticket', 'TicketController@details')->name('admin.ticket.details');

        Route::get('organization', 'OrganizationController@index')->name('admin.bus.organization');
        Route::post('organization', 'OrganizationController@create')->name('admin.bus.organization.create');

        Route::get('agent', 'AgentController@index')->name('admin.bus.agent');
        Route::post('agent', 'AgentController@create')->name('admin.bus.agent.create');

        Route::get('counter', 'CounterController@index')->name('admin.bus.counter');
        Route::post('counter/agents', 'CounterController@agentByOrganization')->name('admin.bus.counter.agents');
        Route::post('counter', 'CounterController@create')->name('admin.bus.counter.create');

        Route::get('seatplan', 'SeatPlanController@index')->name('admin.bus.seatplan');
        Route::post('seatplan', 'SeatPlanController@create')->name('admin.bus.seatplan.create');

        Route::get('buses', 'BusController@index')->name('admin.bus.buses');
        Route::get('buses/new', 'BusController@new')->name('admin.bus.buses.new');
        Route::post('buses/new', 'BusController@create')->name('admin.bus.buses.new.create');

        Route::get('routes', 'RouteController@index')->name('admin.bus.routes');
        Route::post('routes', 'RouteController@create')->name('admin.bus.routes.create');

        Route::get('schedules', 'ScheduleController@index')->name('admin.bus.schedules');
        Route::post('schedules/agents', 'ScheduleController@get_agents')->name('admin.bus.schedules.get_agents');
        Route::post('schedules/routes', 'ScheduleController@get_routes')->name('admin.bus.schedules.get_routes');
        Route::post('schedules/buses', 'ScheduleController@get_buses')->name('admin.bus.schedules.get_buses');
        Route::post('schedules/seatplan', 'ScheduleController@get_seatplan')->name('admin.bus.schedules.get_seatplan');
        Route::post('schedules/boarder', 'ScheduleController@get_boarder')->name('admin.bus.schedules.get_boarder');
        Route::post('schedules', 'ScheduleController@create')->name('admin.bus.schedules.create');
    });
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
