<?php

Route::group(['namespace' => 'Agent'], function() {
    
    Route::get('role', 'CheckRoleController@get');

    Route::get('change/password', 'LoginChangePassword@changePassword')->name('agent.login.change.password');
    Route::post('change/password', 'LoginChangePassword@updatePassword')->name('agent.login.update.password');

    Route::get('/', 'HomeController@index')->name('agent.dashboard');
    Route::get('/dashboard', 'HomeController@index')->name('agent.dashboard');
    Route::get('/dashboard', 'HomeController@index')->name('agent.home');

    Route::get('manage', 'ManageAgentController@index')->name('agent.manage')->middleware("agent_role:super");
    Route::post('manage', 'ManageAgentController@create')->name('agent.manage.create')->middleware("agent_role:super");

    Route::get('counter', 'CounterController@get')->name('agent.counter.get')->middleware("agent_role:super");
    Route::post('counter', 'CounterController@create')->name('agent.counter.create')->middleware("agent_role:super");

    Route::get('buses', 'BusController@get')->name('agent.buses.get')->middleware("agent_role:super");
    Route::get('create', 'BusController@create')->name('agent.buses.create')->middleware("agent_role:super");
    Route::post('create', 'BusController@store')->name('agent.buses.store')->middleware("agent_role:super");

    Route::get('routes', 'RouteController@get')->name('agent.routes.get')->middleware("agent_role:super");
    Route::post('routes', 'RouteController@create')->name('agent.routes.create')->middleware("agent_role:super");


    Route::get('schedules', 'ScheduleController@get')->name('agent.schedules.get')->middleware("agent_role:super");
    Route::post('schedules/seatplan', 'ScheduleController@get_seat_plan')->name('agent.schedules.seatplan')->middleware("agent_role:super");
    Route::post('schedules', 'ScheduleController@create')->name('agent.schedules.create')->middleware("agent_role:super");

    Route::get('ticket', 'TicketController@index')->name('agent.ticket.index')->middleware("agent_role:super");
    Route::post('ticket', 'TicketController@details')->name('agent.ticket.details')->middleware("agent_role:super");

    Route::get('ticket/search', 'TicketController@search')->name('agent.ticket.search')->middleware("agent_role:super");
    Route::get('ticket/{ticket}/print', 'TicketController@print')->name('agent.ticket.print');
    Route::post('ticket/search', 'TicketController@searchResult')->name('agent.ticket.search.result');
    Route::get('reports', 'ReportController@index')->name('agent.reports.index');
    Route::get('reports/get', 'ReportController@get')->name('agent.reports.get');


    // Login
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('agent.login');
    // Route::post('login', 'Auth\LoginController@login');

    Route::namespace('Login')->group(function(){
        Route::get('login', 'LoginController@index')->name('agent.login.show');
        Route::post('login', 'LoginController@attempt')->name('agent.login.attempt');
    });
    Route::post('logout', 'Auth\LoginController@logout')->name('agent.logout');

    // Register
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('agent.register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('agent.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('agent.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('agent.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('agent.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('agent.verification.notice');
    Route::get('email/verify/{id}/{hash}','Auth\VerificationController@verify')->name('agent.verification.verify');

    Route::prefix('counter')->namespace('Counter')->group(function(){
        Route::get('sell', 'SellTicketController@index')->name('counter.sell.ticket');
        Route::post('sell', 'SellTicketController@search')->name('counter.sell.ticket.search');
        Route::get('sell/{id}/{date}', 'SellTicketController@sell')->name('counter.sell.ticket.sell');
        Route::post('sell/store', 'SellTicketController@store')->name('counter.sell.ticket.sell.store');
        Route::post('ticketdetails', 'SellTicketController@ticket_details')->name('counter.ticket.details');
    });

    Route::get('manifest', 'ManifastController@index')->name('agent.manifest.index');
    Route::get('manifest/{id}/view', 'ManifastController@view')->name('agent.manifest.view');
    
    Route::get('manifest/counter', 'ManifastController@counter')->name('agent.manifest.counter');
});