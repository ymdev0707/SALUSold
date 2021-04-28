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
Route::post('/mypage/mealreport/regist', 'Mypage\Report\MealReportController@regist');
Route::post('/mypage/mealreport/delete', 'Mypage\Report\MealReportController@delete');
Route::post('/mypage/mealreport/update', 'Mypage\Report\MealReportController@update');

// 身体情報報告
Route::post('/mypage/physicalinformationreport', 'Mypage\Report\PhysicalInformationReportController@index');
Route::post('/mypage/physicalinformationreport/regist', 'Mypage\Report\PhysicalInformationReportController@regist');
Route::post('/mypage/physicalinformationreport/update', 'Mypage\Report\PhysicalInformationReportController@update');

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

    // トレーニング報告
    Route::get('/mypage/trainningreport', 'Mypage\Report\TrainningReportController@index');
    
    // 身体情報報告
    Route::get('/mypage/physicalinformationreport', 'Mypage\Report\PhysicalInformationReportController@index');
    Route::get('/mypage/physicalinformationreport/regist', 'Mypage\Report\PhysicalInformationReportController@regist');
    Route::get('/mypage/physicalinformationreport/update', 'Mypage\Report\PhysicalInformationReportController@update');
});