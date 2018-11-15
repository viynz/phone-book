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
    return view('welcome');
});

Route::get('/contacts', function () {
    return view('pages.contacts');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@getcontacts');	

Route::get('/contacts', 'ContactsController@getcontacts');

Route::get('/contacts/list', 'ContactsController@contactslist');

Route::get('/contacts/{id}', 'ContactsController@contactslist');

Route::patch('contacts/UpdateContact', 'ContactsController@UpdateContact');

Route::post('/contacts/{id}/delete', 'ContactsController@delete');

Route::delete('/contact/delete', 'ContactsController@deleteContact');

Route::POST('/contacts', 'ContactsController@addcontacts');


