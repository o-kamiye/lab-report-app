<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Main Application controller
Route::match(['get', 'post'], '/config', 'Main\SetupController@index');
Route::match(['get', 'post'], '/config/proceed', 'Main\SetupController@complete_account_creation');

Route::match(['get', 'post'], '/', 'Main\ApplicationController@index');
Route::match(['get', 'post'], '/login', 'Main\ApplicationController@index');
Route::match(['get', 'post'], '/complete_login', 'Main\ApplicationController@complete_login');

// User controller
Route::get('/dashboard', 'Main\UserController@index');
// do not forget to handle /patient route to point to a default location
Route::match(['get', 'post'], '/patient/add', 'Main\UserController@add_patient');
Route::match(['get'], '/patient/show_all', 'Main\UserController@show_all_patients');
Route::match(['get'], '/patient/delete/{patient_id}', 'Main\UserController@delete_patient');
Route::match(['get', 'post'], '/patient/edit/{patient_id}', 'Main\UserController@edit_patient');

Route::match(['get', 'post'], '/operator/add', 'Main\UserController@add_operator');

Route::match(['get', 'post'], '/report/add', 'Main\UserController@add_report');
Route::match(['get'], '/report/show_all', 'Main\UserController@show_all_reports');
Route::match(['get'], '/report/delete/{report_id}', 'Main\UserController@delete_report');
Route::match(['get'], '/report/list', 'Main\PatientController@show_all_reports');

Route::match(['get'], '/report/view/{report_id}', 'Main\PatientController@show_report_details');
Route::match(['get'], '/report/download/{report_id}', 'Main\PatientController@download_report');

Route::match(['get'], '/test/show_all', 'Main\UserController@show_all_tests');
Route::match(['get', 'post'], '/test/add', 'Main\UserController@add_test');

Route::match(['get'], '/signout', 'Main\ApplicationController@signout');
