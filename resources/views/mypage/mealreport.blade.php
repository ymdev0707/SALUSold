@extends('layouts.template')
@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">
        window.onload = function() {
            // 追加ボタン押下時にレポートを追加する
            $('.add-wrapper').on('click', function() {
                // template要素を取得
                var template = document.getElementById('form_template');
                // template要素の内容を複製
                var clone = template.content.cloneNode(true);
                // div#containerの中に追加
                document.getElementById('report_list').appendChild(clone);
                var target_date = $('#target_date').val();
                $('.form_target_date').val(target_date);
            });

            $('.target_date').on('change', function(e) {
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
                location.href = '/mypage/mealreport/?target_date=' + ymd;
            });
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
        <input type="date" class="target_date" value={{ $target_date }}>
        <div id="report_list">
            @foreach ($mealreport as $key => $report)
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
                                        src="data:image/gif;base64,r0lgodlhaqabaaaaach5baekaaealaaaaaabaaeaaaictaeaow=="
                                        style="max-width:200px;">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">ユーザーコメント</label>
                                </div>
                                <textarea class="report_value" name="user_report" id="user_report" cols="30"
                                    rows="10">{{ $report->user_report }}</textarea>
                            </div>
                            <div>
                                <div>
                                    <label for="">トレーナーコメント</label>
                                </div>
                                <textarea class="report_value" name="trainer_comment" id="trainer_comment" cols="30" rows="10">{{ $report->trainer_report }}</textarea>
                            </div>
                            <div>
                                <label>摂取カロリー</label>
                            </div>
                            <div>
                                <input class="report_value" name="ingestion_calorie" type="number" id="ingestion_calorie"
                                    value={{ $report->ingestion_calorie }}>
                                <label>kcal</label>
                            </div>
                            <div>
                                <label>摂取時刻</label>
                            </div>
                            <div>
                                <input class="report_value" name="ingestion_time" type="time" id="ingestion_time"
                                    value={{ $report->ingestion_time }}>
                            </div>
                            <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date" value={{ $target_date }}>
                            <input type="hidden" name="meal_report_information_detail_id" id="meal_report_information_detail_id"
                                value={{ $report->meal_report_information_detail_id }}>
                            <div>
                                <input type="submit" value="削除" formaction="/mypage/mealreport/delete" formmethod="POST">
                                <input type="submit" value="更新" formaction="/mypage/mealreport/update" formmethod="POST">
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
        <div>
            <button id="add-wrapper">追加</button>
        </div>
    </div>
    </div>
    <template id="form_template">
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
                        <input type="submit" value="登録" formaction="/mypage/mealreport/regist" formmethod="POST">
                        <input type="submit" value="削除" formaction="/mypage/mealreport/delete" formmethod="POST">
                    </div>
                </div>
            </div>
        </form>
    </template>
@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
