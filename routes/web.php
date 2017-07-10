<?php

use App\Well;
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
    return view('index');
});

Route::get('/new_layout', function () {
  return view('new_layout');
})->name('new_layout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/wells', 'WellController@search')->name('search');
Route::get('/wells', function () { //$lat, $lon) {
  return view('search', [
    'wells' => DB::table('wells')->inRandomOrder()->limit(15)->get(),
  ]);
});

Route::get('/well/{id}', function ($id) {
  return view('well', [
    'id' => $id,
    'well' => Well::where('id', $id)->first(),
  ]);
});
