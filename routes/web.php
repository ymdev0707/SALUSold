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

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});
=======
Auth::routes();

// --------------------------------------------------POST--------------------------------------------------

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


// --------------------------------------------------管理画面--------------------------------------------------
// ユーザ管理
Route::post('/ms/userinformation/search', 'Ms\User\UserInformationController@search');
Route::post('/ms/userinformation/add', 'Ms\User\UserInformationController@add');
Route::post('/ms/userinformation/regist', 'Ms\User\UserInformationController@regist');
Route::post('/ms/userinformation/detail', 'Ms\User\UserInformationController@detail');

// ユーザ詳細 
// 食事報告
Route::post('/ms/userinformation/detail/mealreport/', 'Ms\User\MealReportController@index');
Route::post('/ms/userinformation/detail/mealreport/regist', 'Ms\User\MealReportController@regist');
Route::post('/ms/userinformation/detail/mealreport/update', 'Ms\User\MealReportController@update');

// トレーニング報告
Route::post('/ms/userinformation/detail/trainningreport/', 'Ms\User\TrainningReportController@index');
Route::post('/ms/userinformation/detail/trainningreport/regist', 'Ms\User\TrainningReportController@regist');
Route::post('/ms/userinformation/detail/trainningreport/update', 'Ms\User\TrainningReportController@update');

// 身体情報報告
Route::post('/ms/userinformation/detail/physicalinformationreport/', 'Ms\User\PhysicalInformationReportController@index');
Route::post('/ms/userinformation/detail/physicalinformationreport/regist', 'Ms\User\PhysicalInformationReportController@regist');
Route::post('/ms/userinformation/detail/physicalinformationreport/update', 'Ms\User\PhysicalInformationReportController@update');



// --------------------------------------------------GET--------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});


// // ログインが必要なページ
Route::middleware('auth')->group(function(){

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

    // --------------------------------------------------管理画面--------------------------------------------------
    
    // ユーザ管理
    Route::get('/ms/userinformation', 'Ms\User\UserInformationController@index');
    Route::get('/ms/userinformation/search', 'Ms\User\UserInformationController@search');
    Route::get('/ms/userinformation/add', 'Ms\User\UserInformationController@add');
    Route::get('/ms/userinformation/regist', 'Ms\User\UserInformationController@regist');
    Route::get('/ms/userinformation/detail/', 'Ms\User\UserInformationController@detail');

    // ユーザ詳細 
    // 食事報告
    Route::get('/ms/userinformation/detail/mealreport/', 'Ms\User\MealReportController@index');
    // トレーニング報告
    Route::get('/ms/userinformation/detail/trainningreport/', 'Ms\User\TrainningReportController@index');
    // 身体情報報告
    Route::get('/ms/userinformation/detail/physicalinformationreport/', 'Ms\User\PhysicalInformationReportController@index');
});
>>>>>>> origin/master
