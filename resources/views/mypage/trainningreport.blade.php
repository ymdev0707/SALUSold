@extends('layouts.template')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
    <style>
        table,
        td,
        th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 3px;
            width: 30px;
            height: 25px;
        }

        th {
            background: #f0e6cc;
        }

        .even {
            background: #fbf8f0;
        }

        .odd {
            background: #fefcf9;
        }

    </style>
@endsection
@section('content')
    @extends('layouts.mypageheader')
    <div class="container pt-5 border-primary profile-container">
        <div class="col-md-6" style="max-width: 100%;">
            <h4 class="mb-3 border-bottom">トレーニング報告</h4>
        </div>
        <input type="date" id="target_date" value={{ $target_date }}>
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
                                <textarea class="report_value" name="trainner_comment" id="trainner_comment" cols="30"
                                    rows="10">{{ $report->TRAINNER_COMMENT }}</textarea>
                            </div>
                            <div>
                                <label>摂取カロリー</label>
                            </div>
                            <div>
                                <input class="report_value" name="ingestion_calorie" type="number" id="ingestion_calorie"
                                    value={{ $report->INGESTION_CALORIE }}>
                                <label>kcal</label>
                            </div>
                            <div>
                                <label>摂取時刻</label>
                            </div>
                            <div>
                                <input class="report_value" name="ingestion_time" type="time" id="ingestion_time"
                                    value={{ $report->INGESTION_TIME }}>
                            </div>
                            <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date"
                                value={{ $target_date }}>
                            <input type="hidden" name="meal_report_information_detail_id"
                                id="meal_report_information_detail_id"
                                value={{ $report->MEAL_REPORT_INFORMATION_DETAIL_ID }}>
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
            <button type='button' id="add_trainning">+</button>
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
                        <textarea class="report_value" name="trainner_comment" id="trainner_comment" cols="30"
                            rows="10"></textarea>
                    </div>
                    <div id="trainning_set">
                        <table>
                            <tbody>
                                <tr>
                                    <td>種類</td>
                                    <td>種目</td>
                                    <td>値</td>
                                    <td>単位</td>
                                    <td>セット数</td>
                                </tr>
                                <tr>
                                    <td><select name="example">
                                            <option value="サンプル1">サンプル1</option>
                                            <option value="サンプル2">サンプル2</option>
                                            <option value="サンプル3">サンプル3</option>
                                        </select></td>
                                    <td><select name="example">
                                            <option value="サンプル1">サンプル1</option>
                                            <option value="サンプル2">サンプル2</option>
                                            <option value="サンプル3">サンプル3</option>
                                        </select></td>
                                    <td><input type="text"></td>
                                    <td><select name="example">
                                            <option value="サンプル1">サンプル1</option>
                                            <option value="サンプル2">サンプル2</option>
                                            <option value="サンプル3">サンプル3</option>
                                        </select></td>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <td colspan="5">備考</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button type='button' id="add_trainning">+</button>
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
    <template id="trainning_template">
        <table>
            <tbody>
                <tr>
                    <td>種類</td>
                    <td>種目</td>
                    <td>値</td>
                    <td>単位</td>
                    <td>セット数</td>
                </tr>
                <tr>
                    <td><select name="example">
                            <option value="サンプル1">サンプル1</option>
                            <option value="サンプル2">サンプル2</option>
                            <option value="サンプル3">サンプル3</option>
                        </select></td>
                    <td><select name="example">
                            <option value="サンプル1">サンプル1</option>
                            <option value="サンプル2">サンプル2</option>
                            <option value="サンプル3">サンプル3</option>
                        </select></td>
                    <td><input type="text"></td>
                    <td><select name="example">
                            <option value="サンプル1">サンプル1</option>
                            <option value="サンプル2">サンプル2</option>
                            <option value="サンプル3">サンプル3</option>
                        </select></td>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td colspan="5">備考</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
            </tbody>
        </table>
    </template>
@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
