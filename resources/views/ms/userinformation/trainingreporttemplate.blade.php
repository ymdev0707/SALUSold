<div class="container pt-5 border-primary profile-container">
    <div class="col-md-6" style="max-width: 100%;">
        <h4 class="mb-3 border-bottom">トレーニング報告</h4>
    </div>
    <input type="date" class="target_date" value={{ $target_date }}>
    <div id="report_list_training">
        @if (isset($trainningreport))
            @foreach ($trainningreport as $key => $report)
                <form method="post">
                    @csrf
                    <div id="trainningreport-wrapper">
                        <div class="report">
                            <div>
                                <div>
                                    <label for="">ユーザーコメント</label>
                                </div>
                                <textarea class="report_value" name="user_report" id="user_report" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div>
                                <div>
                                    <label for="">トレーナーコメント</label>
                                </div>
                                <textarea class="report_value" name="trainer_comment" id="trainer_comment" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div id="training_set">
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
                                <button type='button' class="add_training">+</button>
                            </div>
                            <div>
                                <label>消費カロリー</label>
                            </div>
                            <div>
                                <input class="report_value" name="ingestion_calorie" type="number"
                                    id="ingestion_calorie">
                                <label>kcal</label>
                            </div>
                            <input type="hidden" name="form_target_date" id="form_target_date" class="form_target_date">
                            <input type="hidden" name="trainning_report_information_detail_id"
                                id="trainning_report_information_detail_id">
                            <div>
                                <input type="submit" value="削除"
                                    formaction="/ms/userinformation/detail/trainingreport/delete?user_id={{ $user_id }}&target_date={{ $param_target_date }}"
                                    formmethod="POST">
                                <input type="submit" value="更新"
                                    formaction="/ms/userinformation/detail/trainingreport/update?user_id={{ $user_id }}&target_date={{ $param_target_date }}"
                                    formmethod="POST">
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
    <div>
        <button class="add-wrapper">追加</button>
    </div>
</div>
<div id="form_template_trainingreport" hidden>
    <form method="post">
        @csrf
        <div id="mealreport-wrapper">
            <div class="report">
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
                    <textarea class="report_value" name="trainer_comment" id="trainer_comment" cols="30"
                        rows="10"></textarea>
                </div>
                <div id="training_set">
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
                    <button type='button' class="add_training" onclick="add_training_item()">+</button>
                </div>
                <div>
                    <label>消費消費カロリー</label>
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
                    <input type="submit" value="登録"
                        formaction="/ms/userinformation/detail/trainingreport/regist?user_id={{ $user_id ?? ('' ?? '') }}&target_date={{ $param_target_date ?? '' }}"
                        formmethod="POST">
                    <input type="submit" value="削除"
                        formaction="/ms/userinformation/detail/trainingreport/delete?user_id={{ $user_id ?? ('' ?? '') }}&target_date={{ $param_target_date ?? '' }}"
                        formmethod="POST">
                </div>
            </div>
        </div>
    </form>
</div>
<div>
<div id="training_template" hidden>
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
</div>
