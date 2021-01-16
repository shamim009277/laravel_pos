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
    return view('welcome');
});

Auth::routes(['verify'=>true]);

//Google Login(console.developers.google.com)
Route::get('/google', 'Auth\GoogleController@redirectToGoogle')->name('google.login');
Route::get('/google/callback', 'Auth\GoogleController@handleGoogleCallback');

//Facebook Login(https://developers.facebook.com/apps/)
Route::get('/facebook', 'Auth\FacebookController@redirectToFacebook')->name('facebook.login');
Route::get('/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

//Github Login(https://github.com/settings/apps)
Route::get('/github', 'Auth\GithubController@redirectToGithub')->name('github.login');
Route::get('/github/callback', 'Auth\GithubController@handleGithubCallback');


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('employee','EmployeeController');
	Route::resource('customer','CustomerController');
	Route::resource('supplier','SupplierController');
	Route::resource('advance_salary','AdvanceSalaryController');
	Route::resource('category','CategoryController');
	Route::resource('products','ProductController');
	Route::resource('settings','SettingController');

	Route::get('/expense','ExpenseController@index')->name('expense.list');
	Route::post('/get_category','ExpenseController@getCategory');
	Route::get('/add_expense','ExpenseController@addForm')->name('add.expense');
	Route::get('/edit_expense/{id}','ExpenseController@editExpense')->name('edit.expense');
	Route::post('/update_expense/{id}','ExpenseController@updateExpense')->name('expense.update');
	Route::post('/store_expense','ExpenseController@storeExpense')->name('expense.store');
Route::get('/expense/today_expense/','ExpenseController@todayExpense')->name('expense.today');
Route::get('/expense/monthly_expense/','ExpenseController@monthlyExpense')->name('expense.monthly');


//Monthly expense

Route::get('/expense/january_expense/','ExpenseController@expenseJanuary')->name('expense.january');
Route::get('/expense/february_expense/','ExpenseController@expenseFebruary')->name('expense.february');
Route::get('/expense/march_expense/','ExpenseController@expenseMarch')->name('expense.march');
Route::get('/expense/april_expense/','ExpenseController@expenseApril')->name('expense.april');
Route::get('/expense/may_expense/','ExpenseController@expenseMay')->name('expense.may');
Route::get('/expense/june_expense/','ExpenseController@expenseJune')->name('expense.june');
Route::get('/expense/july_expense/','ExpenseController@expenseJuly')->name('expense.july');
Route::get('/expense/august_expense/','ExpenseController@expenseAugust')->name('expense.august');
Route::get('/expense/september_expense/','ExpenseController@expenseSeptember')->name('expense.september');
Route::get('/expense/october_expense/','ExpenseController@expenseOctober')->name('expense.october');
Route::get('/expense/november_expense/','ExpenseController@expenseNovember')->name('expense.november');
Route::get('/expense/december_expense/','ExpenseController@expenseDecember')->name('expense.december');

//Attendence 

Route::get('/attendence','AttendenceController@takeAttendence')->name('attendence.take');
Route::post('/attendence/take','AttendenceController@storeAttendence')->name('attendence.store');
Route::get('/all_attendence','AttendenceController@allAttendence')->name('attendence.all');
Route::get('/edit_attendence/{data}','AttendenceController@editAttendence')->name('edit.attendence');
Route::post('/update_attendence/{data}','AttendenceController@updateAttendence')->name('update.attendence');
Route::get('/monthly_attendence','AttendenceController@monthlyAttendence')->name('month.attendence');

//Monthly Attendence

Route::get('attendence/january_expense','AttendenceController@januaryAttendence')->name('attendence.january');
Route::get('attendence/february_expense','AttendenceController@februaryAttendence')->name('attendence.february');
Route::get('attendence/march_expense','AttendenceController@marchAttendence')->name('attendence.march');
Route::get('attendence/april_expense','AttendenceController@aprilAttendence')->name('attendence.april');
Route::get('attendence/may_expense','AttendenceController@mayAttendence')->name('attendence.may');
Route::get('attendence/june_expense','AttendenceController@juneAttendence')->name('attendence.june');
Route::get('attendence/july_expense','AttendenceController@julyAttendence')->name('attendence.july');
Route::get('attendence/august_expense','AttendenceController@augustAttendence')->name('attendence.august');
Route::get('attendence/september_expense','AttendenceController@septemberAttendence')->name('attendence.september');
Route::get('attendence/october_expense','AttendenceController@octoberAttendence')->name('attendence.october');
Route::get('attendence/november_expense','AttendenceControllernovemberhAttendence')->name('attendence.november');
Route::get('attendence/december_expense','AttendenceController@decemberAttendence')->name('attendence.december');

//POS
Route::get('/pos','PosController@index')->name('pos');
Route::post('/add_cart','PosController@addCard')->name('product.cart');
Route::post('/update_cart','PosController@updateCard')->name('update.cart');
Route::get('/remove_cart/{id}','PosController@removeCart')->name('remove.cart');

Route::post('/invoice','PosController@createInvoice')->name('create.invoice');
Route::get('/create_invoice','PosController@showInvoice');
Route::post('/confirm_order','PosController@confirmOrder')->name('order.confirm');
});


