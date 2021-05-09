<div class="container pt-5 border-primary profile-container">
    <div class="col-md-6" style="max-width: 100%;">
        <h4 class="mb-3 border-bottom">食事報告</h4>
    </div>
    <input type="date" id="target_date" value={{ @$target_date }}>
    <div id="report_list">
        @if (isset($mealreport))
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
                                <textarea class="report_value" name="trainner_comment" id="trainner_comment" cols="30"
                                    rows="10">{{ $report->TRAINNER_COMMENT }}</textarea>
                            </div>
                            <div>
                                <label>摂取カロリー</label>
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
                                <input class="report_value" name="ingestion_time" type="time" id="ingestion_time"
                                    value={{ $report->INGESTION_TIME }}>
                            </div>
                            <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date"
                                value={{ @$target_date }}>
                            <input type="hidden" name="meal_report_information_detail_id"
                                id="meal_report_information_detail_id"
                                value={{ $report->MEAL_REPORT_INFORMATION_DETAIL_ID }}>
                            <div>
                                <input type="submit" value="削除" formaction="/ms/userinformation/detail/mealreport/delete?user_id={{ $user_id }}&target_date={{ $param_target_date }}" formmethod="POST">
                                <input type="submit" value="更新" formaction="/ms/userinformation/detail/mealreport/update?user_id={{ $user_id }}&target_date={{ $param_target_date }}" formmethod="POST">
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
    <div>
        <button id="add-wrapper">追加</button>
    </div>
</div>