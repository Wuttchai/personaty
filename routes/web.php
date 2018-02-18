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
Auth::routes();
Route::get('/', function () {
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/official', function () {
  if (session('login') == null) {
    return view('official.official', [
        'erx' => '',
      ]);
  }else {
    return view('official.officialform');
  }

});
Route::get('/officialapp', function () {

    return view('layouts.offcialapp');
  });

Route::get('/official/login', function () {
  if (session('login') == null) {
    return view('official.official', [
        'erx' => '',
      ]);
  }else {
    return view('official.officialform');
  }
});
Route::post('/official/logout', function () {
  Session::forget('login');
  Session::forget('idoffice');
    Session::forget('nameoffice');
    Session::forget('cottonoffice');
  return view('official.official', [
      'erx' => '',
    ]);
});
Route::get('/official/addoffice', 'Official\AddOfficeController@index');

Route::post('/official/login', 'Official\OfficialLoginController@login');
Route::get('/official/officialform', 'Official\OfficeformController@index');

Route::post('/official/testza', 'Official\OfficeformController@insert');

Route::get('/official/testza', 'Official\OfficeformController@readItems');

Route::get('/official/editinfo/{info_id}', 'Official\OfficeformController@showedit');

Route::post('/official/updateinfo/{info_id}', 'Official\OfficeformController@update');

Route::post('/official/delete/{info_id}', 'Official\OfficeformController@delete');

Route::post('/official/add', 'Official\AddOfficeController@add');

Route::get('/official/officiallist', 'Official\AddOfficeController@readItems');

Route::get('/official/officiallist{official_id}', 'Official\AddOfficeController@showedit');
Route::post('/officiallist/delete/{official_id}', 'Official\AddOfficeController@delete');
