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
    //return view('welcome');
    return redirect()->route('templatelist');
});

//Route::resource('template','TemplateController');
Route::get('template', 'TemplateController@index')->name('templatelist');
Route::get('template/create', 'TemplateController@create')->name('templatecreate');
Route::post('template/create', 'TemplateController@create');

Route::get('form','FormController@index')->name('formlist');
Route::get('form/{id}','FormController@index')->name('formlink');
Route::post('form/create','FormController@create')->name('formcreate');
Route::get('form/show/{id}','FormController@show')->name('formshow');

//public routes
Route::get('leadform/{id}','LeadformController@index')->name('leadform')->where('id', '[0-9]+');
Route::post('leadform/create','LeadformController@create')->name('leadformcreate');
Route::get('leadform/thanks','LeadformController@thanks')->name('leadformthanks');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
