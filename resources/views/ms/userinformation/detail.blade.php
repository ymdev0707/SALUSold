@extends('layouts.mstemplate')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
    <style>
        /*タブ切り替え全体のスタイル*/
        .tabs {
            margin-top: 50px;
            padding-bottom: 40px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 98%;
            margin: 0 auto;
        }

        /*タブのスタイル*/
        .tab_item {
            width: calc(100%/3);
            height: 50px;
            border-bottom: 3px solid #5ab4bd;
            background-color: #d9d9d9;
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
        }

        .link {
            display: block;
        }


        /*選択されているタブのコンテンツのみを表示*/
        #mealreport:checked~#mealreport_content,
        #trainningreport:checked~#trainningreport_content,
        #physicalinformation:checked~#physicalinformation_content {
            display: block;
        }

        /*選択されているタブのスタイルを変える*/
        .tabs input:checked+.tab_item {
            background-color: #5ab4bd;
            color: #fff;
        }

    </style>
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">
        window.onload = function() {
            // 追加ボタン押下時にレポートを追加する
            $('#add-wrapper').on('click', function() {
                // template要素を取得
                var template = document.getElementById('form_template');
                // template要素の内容を複製
                var clone = template.content.cloneNode(true);
                // div#containerの中に追加
                document.getElementById('report_list').appendChild(clone);
                var target_date = $('#target_date').val();
                $('.form_target_date').val(target_date);
            });

            $('#target_date').on('change', function(e) {
                $('#form_target_date').val(e.target.value);
                var toDoubleDigits = function(num) {
                    num += "";
                    if (num.length === 1) {
                        num = "0" + num;
                    }
                    return num;
                };
                var today = new Date(e.target.value);
                var year = today.getFullYear();
                var month = toDoubleDigits(today.getMonth() + 1);
                var day = toDoubleDigits(today.getDate());
                var ymd = year += month += day;
                var report_type = $('#report_type').val();
                var user_id = $('#user_id').val();
                location.href = '/ms/userinformation/detail/' + report_type +'/?target_date=' + ymd + '&user_id=' + user_id;
            });
        }

    </script>
@endsection

@section('content')
    @extends('layouts.msheader')
@section('content')
    <div class="tabs">
        <input id="mealreport" type="radio" name="tab_item" {{ @$report_type == 'mealreport' ? 'checked="checked"' : '' }}>
        <label id="mealreport" class="tab_item" for="mealreport"><a class="link"
                href="/ms/userinformation/detail/mealreport?user_id={{ $user_id }}">食事報告</a></label>
        <input id="trainningreport" type="radio" name="tab_item"
            {{ @$report_type == 'trainningreport' ? 'checked="checked"' : '' }}>
        <label id="trainningreport" class="tab_item" for="trainningreport"><a class="link"
                href="/ms/userinformation/detail/trainningreport?user_id={{ $user_id }}">トレーニング報告</a></label>
        <input id="physicalinformation" type="radio" name="tab_item"
            {{ @$report_type == 'physicalinformationreport' ? 'checked="checked"' : '' }}>
        <label id="physicalinformation" class="tab_item" for="physicalinformation"><a class="link"
                href="/ms/userinformation/detail/physicalinformationreport?user_id={{ $user_id }}">身体情報報告</a></label>
        <div class="tab_content" id="mealreport_content">
            <div class="tab_content_description">
            </div>
        </div>
        <div class="tab_content" id="trainningreport_content">
            <div class="tab_content_description">
            </div>
        </div>
        <div class="tab_content" id="physicalinformation_content">
            <div class="tab_content_description">
                @include("ms.userinformation.physicalinformationreporttemplate")
            </div>
        </div>
    </div>
    <input type="hidden" id="report_type" value="{{@$report_type}}">
    <input type="hidden" id="user_id" value="{{@$user_id}}">
@endsection

@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
