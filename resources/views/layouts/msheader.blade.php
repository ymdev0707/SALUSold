<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- 個別のjavaScript読み込み --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js"></script>
    <script src="{{ asset('js/daterangepicker.js') }}" defer></script>
    <script src="{{ asset('js/mscommon.js') }}" defer></script>
    @yield('javascript-head')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pc.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    {{-- 個別のCSS読み込み --}}
    @yield('css')
</head>

<body>
    <div id="app">
        <main class="py-4">
            {{-- コンテンツ部分読み込み --}}
            @yield('content')
        </main>
    </div>
    {{-- 個別のjavaScript読み込み --}}
    {{-- @yield('javascript-footer') --}}
</body>
<template id="form_template_mealreport">
    <form method="post">
        @csrf
        <div id="mealreport-wrapper">
            <div class="report">
                <div>
                    <div>
                        <label for="">画像</label>
                    </div>
                    <input class="report_value" name="meal_image" id="meal_image" type="file" accept='image/*'
                        onchange="preview_image(this);">
                    <div>
                        <img id="preview"
                            src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                            style="max-width:200px;">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="">ユーザーコメント</label>
                    </div>
                    <textarea class="report_value" name="user_report" id="user_report" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <div>
                        <label for="">トレーナーコメント</label>
                    </div>
                    <textarea class="report_value" name="trainer_comment" id="trainer_comment" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label>摂取カロリー</label>
                </div>
                <div>
                    <input class="report_value" name="ingestion_calorie" type="number" id="ingestion_calorie">
                    <label>kcal</label>
                </div>
                <div>
                    <label>摂取時刻</label>
                </div>
                <div>
                    <input class="report_value" name="ingestion_time" type="time" id="ingestion_time">
                </div>
                <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date">
                <input type="hidden" name="meal_report_information_detail_id" id="meal_report_information_detail_id">
                <div>
                    <input type="submit" value="登録" formaction="/ms/userinformation/detail/mealreport/regist?user_id={{ $user_id ?? '' ?? '' }}&target_date={{ $param_target_date ?? '' }}" formmethod="POST">
                    <input type="submit" value="削除" formaction="/ms/userinformation/detail/mealreport/delete?user_id={{ $user_id ?? '' ?? '' }}&target_date={{ $param_target_date ?? '' }}" formmethod="POST">
                </div>
            </div>
        </div>
    </form>
</template>
</html>
