@extends('layouts.template')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">
        window.onload = function() {
            // レポートのテンプレートを読み込む
            // $("#mealreport-wrapper").load("/template/report/mealreport-wrapper.blade.php");

            // 追加ボタン押下時にレポートを追加する
            $('#add-wrapper').on('click', function() {
                // idを動的にふる
                var last_report_id = increment_target_id_by_class('report-wrapper', 'report-id', "report");
                var target_id = $("#" + last_report_id);

                // 最後に追加したレポートをを追加して初期化する
                $(target_id).parent("#mealreport-wrapper").clone().insertAfter('#mealreport-wrapper');
                var last_report_id = increment_target_id_by_class('mealreport-wrapper', 'report-id', "report");
                init_report(last_report_id);
            });

            $('#report-delete').on('click', function() {
                console.log($(this).parent().attr('id'));
            });
        }

        function increment_target_id_by_class(target_id, increment_name, target_class_name) {
            //複数のdiv要素に動的なidをつける
            var moji = increment_name
            var tmp = document.getElementsByClassName(target_class_name);
            var report_id = '';
            for (var i = 0; i <= tmp.length - 1; i++) {
                //id追加
                report_id = moji + i;
                tmp[i].setAttribute("id", report_id);
            }

            return report_id;
        }

        function init_report(target_report_id) {
            var target_id = $("#" + target_report_id);
            $(target_id).find("textarea").val("");
            $(target_id).find("input").val("");
        }

        function preview_image(obj) {
            var fileReader = new FileReader();
            fileReader.onload = (function() {
                document.getElementById('preview').src = fileReader.result;
            });
            fileReader.readAsDataURL(obj.files[0]);
        }

    </script>
@endsection

@section('content')
    @extends('layouts.mypageheader')
    <div class="container pt-5 border-primary profile-container">
        <div class="col-md-6" style="max-width: 100%;">
            <h4 class="mb-3 border-bottom">食事報告</h4>
        </div>
        <form action="/mypage/report/regist">
            @foreach ($mealreport as $report)
                <div id="mealreport-wrapper">
                    <div class="report" id="report-id0">
                        <div>
                            <div>
                                <label for="">画像</label>
                            </div>
                            <input type="file" accept='image/*' onchange="preview_image(this);">
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
                            <textarea name="" id="user-comment" cols="30" rows="10">{{$report->USER_REPORT}}</textarea>
                        </div>
                        <div>
                            <div>
                                <label for="">トレーナーコメント</label>
                            </div>
                            <textarea name="" id="trainer-comment" cols="30" rows="10">{{$report->TRAINNER_COMMENT}}</textarea>
                        </div>
                        <div>
                            <label>消費カロリー</label>
                        </div>
                        <div>
                            <input type="number" id="cal" value="{{$report->INGESTION_CALORIE}}">
                            <label>kcal</label>
                        </div>
                        <div>
                            <label>摂取時刻</label>
                        </div>
                        <div>
                            <input type="time" id="get-time" value="{{$report->INGESTION_TIME}}">
                        </div>
                        <div>
                            <button id="report-delete">削除</button>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="登録">
                </div>
        </form>
        <div>
            <button id="add-wrapper">追加</button>
        </div>
        @endforeach

    </div>
    </div>

@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
