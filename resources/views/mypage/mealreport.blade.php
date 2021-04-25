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
                var last_report_id = increment_target_id_by_class('report-id', "report");
                var target_id = $("#" + last_report_id);

                // 最後に追加したレポートをを追加して初期化する
                $(target_id).parent("#mealreport-wrapper").clone().insertAfter('#mealreport-wrapper');
                var last_report_id = increment_target_id_by_class('report-id', "report");
                init_report(last_report_id);
                var last_report_id2 = increment_target_name_by_class("report");
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
                var month = toDoubleDigits(today.getMonth() +1);
                var day = toDoubleDigits(today.getDate());
                var ymd = year += month += day;
                location.href = '/mypage/mealreport/?target_date=' + ymd;
            });
        }
        

        function increment_target_id_by_class(increment_name, target_class_name) {
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

        function increment_target_name_by_class(target_class_name) {
            //複数のdiv要素に動的なidをつける
            var tmp = document.getElementsByClassName(target_class_name);
            var report_value = document.getElementsByClassName('report_value');
            var report_id = '';
            // 配列に変換
            var elements = Array.from(tmp);
            // var arr_report_value = Array.from( report_value ) ;
            $('.report').each(function(index, element) {
                var arr_report_value = Array.from(element);
                console.log(toString.call(element));
                console.log(element);
                arr_report_value.forEach(function(val) {
                    console.log(val);
                });
            })
            // elements.forEach( function( value, index ) {
            //     // console.log(toString.call(value));
            //     var arr_report_value = Array.from( value ) ;
            //     for (let item of value) {
            //         console.log(item.id);
            //     }
            //     arr_report_value.forEach(function(item){
            //         console.log(item);
            //         var id =value.id;
            //         var n = 9;
            //         var number = id.toString().substr((id.length-n,n));
            //         // console.log(number);
            //         item.setAttribute("name", 'report[' + number + ']' + '[' + item.id +']');
            //     });
            //     // console.log(value);
            //     // arr_report_value.forEach(function (item){
            //     //     var id =value.id;
            //     //     var n = 9;
            //     //     var number = id.toString().substr((id.length-n,n));
            //     //     // console.log(id);
            //     //     // console.log(number);
            //     //     item.setAttribute("name", 'report[' + number + ']' + '[' + item.id +']');
            //     // });
            // });
            // return report_id;
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
        <input type="date" id="target_date" value={{$target_date}} >
        @foreach ($mealreport as $key => $report)
            <form method="post">
                @csrf
                <div id="mealreport-wrapper">
                    <div class="report">
                        <div>
                            <div>
                                <label for="">画像</label>
                            </div>
                            <input class="report_value" name="meal_image" id="meal_image" type="file"
                                accept='image/*' onchange="preview_image(this);">
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
                            <textarea class="report_value" name="user_report" id="user_report" cols="30"
                                rows="10">{{ $report->USER_REPORT }}</textarea>
                        </div>
                        <div>
                            <div>
                                <label for="">トレーナーコメント</label>
                            </div>
                            <textarea class="report_value" name="trainner_comment" id="trainner_comment"
                                cols="30" rows="10">{{ $report->TRAINNER_COMMENT }}</textarea>
                        </div>
                        <div>
                            <label>消費カロリー</label>
                        </div>
                        <div>
                            <input class="report_value" name="ingestion_calorie" type="number"
                                id="ingestion_calorie" value={{ $report->INGESTION_CALORIE }}>
                            <label>kcal</label>
                        </div>
                        <div>
                            <label>摂取時刻</label>
                        </div>
                        <div>
                            <input class="report_value" name="ingestion_time" type="time"
                                id="ingestion_time" value={{ $report->INGESTION_TIME }}>
                        </div>
                        <input type="hidden" name="form_target_date" id="form_target_date" value={{$target_date}}>
                        <input type="hidden" name="meal_report_information_detail_id" id="meal_report_information_detail_id" value={{$report->MEAL_REPORT_INFORMATION_DETAIL_ID}}>
                        <div>
                            <input type="submit" value="登録" formaction="/mypage/mealreport/regist" formmethod="POST">
                            <input type="submit" value="削除" formaction="/mypage/mealreport/delete" formmethod="POST">
                            <input type="submit" value="更新" formaction="/mypage/mealreport/update" formmethod="POST">
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
        <div>
            <button id="add-wrapper">追加</button>
        </div>
    </div>
    </div>

@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
