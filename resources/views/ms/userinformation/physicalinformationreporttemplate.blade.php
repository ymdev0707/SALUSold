{{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
<div class="container pt-5 border-primary profile-container">
    <div class="col-md-6" style="max-width: 100%;">
        <h4 class="mb-3 border-bottom">身体情報報告</h4>
    </div>
    <div id="report_list">
        <form method="post">
            @csrf
            <div id="physicalinformation-wrapper">
                <div class="report">
                    <input type="date" name="target_date" id="target_date" value={{ @$target_date }}>
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
                        <input class="report_value" name="weight" type="number" id="weight"
                            value={{ @$physicalinformation->WEIGHT }}>
                        <label>kg</label>
                    </div>
                    <div>
                        <label>体脂肪率</label>
                    </div>
                    <div>
                        <input class="report_value" name="body_fat_percentage" type="number" id="body_fat_percentage"
                            value={{ @$physicalinformation->BODY_FAT_PERCENTAGE }}>
                        <label>%</label>
                    </div>
                    <div>
                        <label>筋肉量</label>
                    </div>
                    <div>
                        <input class="report_value" name="muscle_mass" type="number" id="muscle_mass"
                            value={{ @$physicalinformation->MUSCLE_MASS }}>
                        <label>kg</label>
                    </div>
                    <div>
                        @if (@$physicalinformation)
                            <input type="submit" value="更新"
                                formaction="/ms/userinformation/detail/physicalinformationreport/update?user_id={{ $user_id }}&target_date={{ $param_target_date }}"
                                formmethod="POST">
                        @else
                            <input type="submit" value="登録"
                                formaction="/ms/userinformation/detail/physicalinformationreport/regist?user_id={{ $user_id }}&target_date={{ $param_target_date }}"
                                formmethod="POST">
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
