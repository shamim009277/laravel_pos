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
//Auth::routes(['login'=>false]);
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

//Attendence 

Route::get('/attendence','AttendenceController@takeAttendence')->name('attendence.take');
Route::post('/attendence/take','AttendenceController@storeAttendence')->name('attendence.store');
Route::get('/all_attendence','AttendenceController@allAttendence')->name('attendence.all');
Route::get('/edit_attendence/{data}','AttendenceController@editAttendence')->name('edit.attendence');
Route::post('/update_attendence/{data}','AttendenceController@updateAttendence')->name('update.attendence');
Route::get('/monthly_attendence','AttendenceController@monthlyAttendence')->name('month.attendence');

//POS
Route::get('/pos','PosController@index')->name('pos');
Route::post('/add_cart','PosController@addCard')->name('product.cart');
Route::post('/update_cart','PosController@updateCard')->name('update.cart');
Route::get('/remove_cart/{id}','PosController@removeCart')->name('remove.cart');

Route::post('/invoice','PosController@createInvoice')->name('create.invoice');
Route::get('/create_invoice','PosController@showInvoice');
Route::post('/confirm_order','PosController@confirmOrder')->name('order.confirm');
Route::post('/collect/due','PosController@getDuePayment')->name('due.collect');

//Salary 
Route::get('/salary','SalaryController@index')->name('employee.salary');
Route::get('/salary_pay/{id}','SalaryController@showSalary')->name('pay.salary');
Route::post('/salary_paid','SalaryController@storeSalary')->name('salary.store');
Route::get('/salary/paid_list','SalaryController@paidList')->name('paid.list');

//Sales
Route::get('/sales/list','SalesController@salesList')->name('sales.list');

});






