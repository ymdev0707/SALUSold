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
                    <textarea class="report_value" name="trainner_comment" id="trainner_comment" cols="30" rows="10"></textarea>
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