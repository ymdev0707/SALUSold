@extends('layouts.template')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">
        window.onload = function() {
            // レポートのテンプレートを読み込む
            // $("#physicalinformationreport-wrapper").load("/template/report/physicalinformationreport-wrapper.blade.php");

            // 追加ボタン押下時にレポートを追加する
            $('#add-wrapper').on('click', function() {
                // template要素を取得
                var template = document.getElementById('form_template');
                // template要素の内容を複製
                var clone = template.content.cloneNode(true);
                // div#containerの中に追加
                document.getElementById('report_list').appendChild(clone);
                var target_date = $('#target_date').val();
                console.log(target_date);
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
                location.href = '/mypage/physicalinformationreport/?target_date=' + ymd;
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
            <h4 class="mb-3 border-bottom">身体情報報告</h4>
        </div>
        <div id="report_list">
            <form method="post">
                @csrf
                <div id="physicalinformation-wrapper">
                    <div class="report">
                        <input type="date" name="target_date" id="target_date" value={{ $target_date }}>
                        <div>
                            <label>身長</label>
                        </div>
                        <div>
                            <input class="report_value" name="height" type="number" id="height"
                                value={{ @$physicalinformation->HEIGHT }}>
                            <label>cm</label>
                        </div>
                        <div>
                            <label>体重</label>
                        </div>
                        <div>
                            <input class="report_value" name="weight" type="number" id="weight" value={{ @$physicalinformation->WEIGHT }}>
                            <label>kg</label>
                        </div>
                        <div>
                            <label>体脂肪率</label>
                        </div>
                        <div>
                            <input class="report_value" name="body_fat_percentage" type="number" id="body_fat_percentage" value={{ @$physicalinformation->BODY_FAT_PERCENTAGE }}>
                            <label>%</label>
                        </div>
                        <div>
                            <label>筋肉量</label>
                        </div>
                        <div>
                            <input class="report_value" name="muscle_mass" type="number" id="muscle_mass" value={{ @$physicalinformation->MUSCLE_MASS }}>
                            <label>kg</label>
                        </div>
                        <div>
                            @if($physicalinformation)
                                <input type="submit" value="更新" formaction="/mypage/physicalinformationreport/update" formmethod="POST">    
                            @else
                                <input type="submit" value="登録" formaction="/mypage/physicalinformationreport/regist" formmethod="POST">
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
