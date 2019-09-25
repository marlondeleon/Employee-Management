<?php

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
    // return view('welcome');
    return redirect(route('login'));
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/employees', 'EmployeesController');
Route::get('/employees/{id}/add-pay', 'EmployeesController@addpay');
Route::post('/employees/addpayment', 'EmployeesController@add_payment')->name('addpayment');
Route::get('/employees/{id}/pay-history', 'EmployeesController@payhistory');