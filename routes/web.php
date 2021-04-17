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

Auth::routes();

Route::post('/home', 'Top\LoginController@index');
Route::post('/mypage/profile/update', 'Mypage\ProfileController@update');

Route::post('/mypage/record', 'Mypage\RecordController@index');

//食事報告
// Route::post('/mypage/mealreport', 'Mypage\Report\MealReportController@index');
// Route::post('/mypage/mealreport/regist', 'Mypage\Report\MealReportController@regist');

// // ログインが必要名ページ
Route::middleware('auth')->group(function(){

    // プロフィール
    // Route::get('/home', function () {
    //     return view('mypage/profile');
    // });

    Route::get('/home', 'Top\LoginController@index');

    Route::get('/mypage/record', 'Mypage\RecordController@index');
    Route::get('/mypage/report', 'Mypage\ReportController@index');

    // 食事報告
    Route::get('/mypage/mealreport', 'Mypage\Report\MealReportController@index');
    Route::get('/mypage/mealreport/regist', 'Mypage\Report\MealReportController@regist');
});