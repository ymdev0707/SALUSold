@extends('layouts.msheader')
@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
    <style>
        .item {
            border-radius: 10px;
            background: #5d94940d;
            padding: 15px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .item p {
            text-align: center;
        }

        @media (min-width: 600px) {
            .flexbox {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }

            .item {
                width: 46%;
            }
        }

        /*タブ切り替え全体のスタイル*/
        .tabs {
            margin-top: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            width: 98%;
            margin: 0 auto;
            clear: left;
        }

        /*タブのスタイル*/
        .tab_item {
            width: calc(100%/3);
            height: 50px;
            border-bottom: 3px solid #5ab4bd;
            background-color: #565656;
            line-height: 50px;
            font-size: 16px;
            text-align: center;
            color: #565656;
            display: block;
            float: left;
            text-align: center;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .tab_item:hover {
            opacity: 0.75;
        }

        /*ラジオボタンを全て消す*/
        input[name="tab_item"] {
            display: none;
        }

        /*タブ切り替えの中身のスタイル*/
        .tab_content {
            display: none;
            padding: 40px 40px 0;
            clear: both;
            overflow: hidden;
            background: #5d94940d;
        }

        .link {
            display: block;
            color: white;
        }


        /*選択されているタブのコンテンツのみを表示*/
        #mealreport:checked~#mealreport_content,
        #trainingreport:checked~#trainingreport_content,
        #physicalinformation:checked~#physicalinformation_content {
            display: block;
        }

        /*選択されているタブのスタイルを変える*/
        .tabs input:checked+.tab_item {
            background-color: #5ab4bd;
            color: #fff;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid #ccc;
            line-height: 1.5;
        }

        table.type06 th {
            width: 150px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            background: #5ab4bd;
            color: #ffffff;
        }

        table.type06 td {
            width: 350px;
            padding: 10px;
            vertical-align: top;
        }

        .content {
            float: left;
        }

        .container {
            padding: 10px;
        }
    </style>
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">

    </script>
@endsection

@section('content')
    @extends('layouts.mstemplate')

@section('content')
    <div class="flexbox">
        <div class="item">
            <div class="userdata">
                <!-- ユーザ情報 -->
                <p>ユーザ情報</p>
                @include('ms.userinformation.userinformation')
            </div>
        </div>

        <div class="item">
            <div class="graph">
                <!-- 身体情報のグラフ -->
                <p>身体情報グラフ</p>
                @include('ms.userinformation.dashboard')
            </div>
        </div>
        <div class="item">
            <div class="graph">
                <!-- 身体情報のグラフ -->
                <p>身体情報グラフ(セッション日のみ)</p>
                @include('ms.userinformation.dashboardsession')
            </div>
        </div>

        <div class="item">
            <div class="graph">
                <!-- 摂取カロリーのグラフ -->
                <p>摂取カロリーグラフ</p>
                {{-- @include('ms.userinformation.dashboard') --}}
                未実装
            </div>
        </div>

        <div class="tabs">
            <input id="mealreport" type="radio" name="tab_item"
                {{ @$report_type == 'mealreport' ? 'checked="checked"' : '' }}>
            <label id="mealreport" class="tab_item" for="mealreport"><a class="link"
                    href="/ms/userinformation/detail/mealreport?user_id={{ $user_id }}">食事報告</a></label>
            <input id="trainingreport" type="radio" name="tab_item"
                {{ @$report_type == 'trainingreport' ? 'checked="checked"' : '' }}>
            <label id="trainingreport" class="tab_item" for="trainingreport"><a class="link"
                    href="/ms/userinformation/detail/trainingreport?user_id={{ $user_id }}">トレーニング報告</a></label>
            <input id="physicalinformation" type="radio" name="tab_item"
                {{ @$report_type == 'physicalinformationreport' ? 'checked="checked"' : '' }}>
            <label id="physicalinformation" class="tab_item" for="physicalinformation"><a class="link"
                    href="/ms/userinformation/detail/physicalinformationreport?user_id={{ $user_id }}">身体情報報告</a></label>
            <div class="tab_content" id="mealreport_content">
                <div class="tab_content_description">
                    @include("ms.userinformation.mealreporttemplate")
                </div>
            </div>
            <div class="tab_content" id="trainingreport_content">
                <div class="tab_content_description">
                    @include("ms.userinformation.trainingreporttemplate")
                </div>
            </div>
            <div class="tab_content" id="physicalinformation_content">
                <div class="tab_content_description">
                    @include("ms.userinformation.physicalinformationreporttemplate")
                </div>
            </div>
        </div>
        <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date"
            value={{ @$target_date }}>
        <input type="hidden" id="report_type" value="{{ @$report_type }}">
        <input type="hidden" id="user_id" value="{{ @$user_id }}">
        <input type="hidden" id="start_date" value="{{ @$start_date }}">
        <input type="hidden" id="end_date" value="{{ @$end_date }}">
    @endsection
@endsection
@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}
    <script type="text/javascript">

    </script>
@endsection
