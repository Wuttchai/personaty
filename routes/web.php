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
Route::get('/phpinfo', function() {
    return phpinfo();
});
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/ww', function () {
    return view('welcome');
});
Route::get('/history', function () {
    return view('about.history');
});

Route::get('/vision', function () {
    return view('about.vision');
});
Route::get('/abouts', 'HomeController@about');


Route::get('/contact', function () {
  $this->middleware('doccumethome');
    return view('about.contact');
});

Route::get('/location', function () {
  $this->middleware('doccumethome');
    return view('about.location');
});

Route::get('/question/comment/{id}', 'HomeController@showcomment')->name('showcomment');
Route::get('/product/view/{id}', 'HomeController@productview');
Route::get('/datailuser', 'user\AddimageController@datailuser')->name('showdatailuser');
Route::post('/edit/datailuser', 'user\AddimageController@editdatailuser');
Route::get('/webboard', 'HomeController@webbord');
Route::get('/ProductAyutaya', 'HomeController@Product');
Route::get('/advertise', 'HomeController@advertise');
Route::get('/activities', 'HomeController@activities');
Route::get('/documentsh', 'HomeController@documentsh');
Route::get('/insert/receipt', 'user/AddimgcarController@index');
Route::get('/hotnews/detail{id}', 'HomeController@detailhotnew');
Route::get('/official','Official\OfficeformController@index');
Route::get('/officialapp', function () {

return redirect('/official/login');
  });

Route::get('/official/login', function () {
  if (session('login') == null) {
    return view('official.official', [
        'erx' => '',
      ]);
  }else {
    if (session('activity') == 'จัดการ') {
    return redirect('/official/add');
    }
    if (session('info') == 'จัดการ') {
      return redirect('/official/add');
    }
    if (session('product') == 'จัดการ') {
      return redirect('/official/product');

    }
    if (session('hotnews') == 'จัดการ') {
    return redirect('/official/hotnews');
    }

    if (session('prison') == 'จัดการ') {

    return redirect('/official/person');
    }
    if (session('document') == 'จัดการ') {

    return redirect('/official/document');
    }
    if (session('calender') == 'จัดการ') {

    return redirect('/official/calender');
    }
  }
})->name('officiallogin');

Route::post('/official/logout','Official\OfficialLoginController@logout' );

Route::post('/official/logfile', 'Official\AddOfficeController@logfile');
Route::get('/official/logfile', 'Official\AddOfficeController@logfile');
Route::post('/official/login', 'Official\OfficialLoginController@login');

Route::get('/official/logfile/product', 'Official\AddOfficeController@productlog');
Route::get('/official/logfile/graph', 'Official\AddOfficeController@graph');
Route::get('/official/officialform', 'Official\OfficeformController@index');
Route::post('/official/testza', 'Official\OfficeformController@insert');
Route::get('/official/testza', 'Official\OfficeformController@readItems');
Route::get('/official/editinfo/{info_id}', 'Official\OfficeformController@showedit');
Route::post('/official/updateinfo/{info_id}', 'Official\OfficeformController@update');
Route::post('/official/delete/{info_id}', 'Official\OfficeformController@delete');


Route::get('/official/add', 'Official\AddOfficeController@index');
Route::post('/official/add', 'Official\AddOfficeController@add');
Route::get('/official/officiallist', 'Official\AddOfficeController@readItems');
Route::get('/official/officiallist{official_id}', 'Official\AddOfficeController@showedit');
Route::post('/officiallist/delete/{official_id}', 'Official\AddOfficeController@delete');
Route::post('/official/updateofficial/{official_id}', 'Official\AddOfficeController@update');

Route::get('/official/person', 'Official\PersonController@index');
Route::get('/official/personlist', 'Official\PersonController@readItems');
Route::post('/official/person/add', 'Official\PersonController@insert');
Route::get('/person/edit{Person_ID}', 'Official\PersonController@showedit');
Route::post('/person/updateinfo/{Person_ID}', 'Official\PersonController@update');
Route::post('/person/delete/{Person_ID}', 'Official\PersonController@delete');

Route::get('/official/hotnews', 'Official\HotnewController@index');
Route::get('/official/hotnewslist', 'Official\HotnewController@readItems');
Route::post('/official/hotnews/add', 'Official\HotnewController@insert');
Route::get('/hotnews/edit{Hotnews_ID}', 'Official\HotnewController@showedit');
Route::post('/hotnews/update/{Hotnews_ID}', 'Official\HotnewController@update');
Route::post('/hotnews/delete{Hotnews_ID}', 'Official\HotnewController@delete');


Route::get('/official/product', 'Official\ProductController@index');
Route::get('/official/productlist', 'Official\ProductController@readItems');
Route::post('/official/product/add', 'Official\ProductController@insert');
Route::get('/product/edit{Pro_ID}', 'Official\ProductController@showedit');
Route::post('/product/update/{Pro_ID}', 'Official\ProductController@update');
Route::post('/product/delete{Pro_ID}', 'Official\ProductController@delete');
//document
Route::get('/official/document', 'Official\DocumentController@index');
Route::get('/official/documentlist', 'Official\DocumentController@readItems');
Route::post('/official/document/add', 'Official\DocumentController@insert');
Route::get('/documentlist/edit{doc_id}', 'Official\DocumentController@showedit');
Route::post('/document/update/{doc_id}', 'Official\DocumentController@update');
Route::post('/document/delete{doc_id}', 'Official\DocumentController@delete');
Route::get('/pdf/view/{id}', 'HomeController@showpdf');
Route::post('/document/status{doc_id}', 'Official\DocumentController@updatestatus');
//

Route::get('/official/productsell', 'Official\ProductsellControll@index');
Route::get('/official/productselllist', 'Official\ProductsellControll@readItems');
Route::post('/emsadd', 'Official\ProductsellControll@insert');
Route::get('/sell/view/{id}', 'Official\ProductsellControll@showdetail');
//user

//calender
Route::get('/official/calender', 'Official\CalenderController@index')->name('showcalender');
Route::post('/official/calender/add', 'Official\CalenderController@insert');
Route::get('/official/calender/detail{id}', 'Official\CalenderController@showedit');
Route::post('/official/calender/update{id}', 'Official\CalenderController@update');
Route::post('/official/calender/delete{id}', 'Official\CalenderController@delete');
//calender
Route::post('/Productaddcars', 'HomeController@addcars');

Route::post('/Producteditcars', 'HomeController@editcars');
Route::post('/Productdeletecars', 'HomeController@deletecars');
Route::get('/questiondetail/edit/{id}', 'user\ProductsellController@openedit');
Route::get('/product/invoice/', 'user\ProductsellController@index')->name('showcar');
Route::get('/showinfo/address{id}', 'user\ProductsellController@showinfo');
Route::get('/deleteinfo/address{id}', 'user\ProductsellController@deleteinfo');
Route::post('/update/infoaddress/{id}', 'user\ProductsellController@infoaddress');
Route::get('/cart/confrimadd', 'user\AddcartsControllers@confrim');
Route::get('/Product/delete', 'user\AddcartsControllers@delete');


  Route::get('/invoice-print/{id}', 'HomeController@carsprint');

  Route::get('/ProductCarorderdetail/{id}', 'user\ProductsellController@ProductCarorderdetail');
  Route::get('/ProductCarorderdelete/{id}', 'user\ProductsellController@ProductCarorderdelete');
  Route::post('/edit/question/{id}', 'user\WebboardController@editqes');
  Route::post('/insert/question', 'user\WebboardController@addqes');
  Route::get('/questiondetail/edit/{id}', 'user\WebboardController@openedit');
  Route::post('/question/addcomment/', 'user\WebboardController@store')->name('addcomment');
  Route::get('/question/addcomment/eiei', 'user\WebboardController@showcomment');
  Route::get('/ProductCardetail/{id}', 'user\ProductsellController@ProductCardetail');
  Route::get('/ProductCarOrders', 'user\ProductsellController@ProductCarOrders')->name('ProductCarOrders');
  Route::post('/insert/receipt', 'user\AddimgcarController@insertimg');
  Route::get('/insert/receipt', 'user\AddimgcarController@index');
  Route::post('/insert/receiptimg', 'user\AddimageController@insertimg');
  Route::get('/insert/receiptimg', 'user\AddimageController@index');
  Route::post('/user/editsend/{id}', 'user\ProductsellController@editsend');
  Route::post('/user/editsendcon{id}', 'user\ProductsellController@editdropdown');
  Route::get('/user/showaddres', 'user\ProductsellController@showaddres');
