<table class="type06">
    <tbody>
        <tr>
            <th>ユーザーid</th>
            <td>{{ $user_information->user_id }}</td>
        </tr>
        <tr>
            <th>会員番号</th>
            <td>{{ $user_information->personal_number }}</td>
        </tr>
        <tr>
            <th>氏名</th>
            <td>{{ $user_information->name }}</td>
        </tr>
        <tr>
            <th>氏名カナ</th>
            <td>{{ $user_information->namekana }}</td>
        </tr>
        <tr>
            <th>生年月日(年齢)</th>
            <td>{{ $user_information->birth }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $user_information->sex }}</td>
        </tr>
        <tr>
            <th>在籍区分</th>
            <td>{{ $user_information->is_admin }}</td>
        </tr>
        <tr>
            <th>担当</th>
            <td>{{ $user_information->staff }}</td>
        </tr>
        <tr>
            <th>在籍店舗</th>
            <td></td>
        </tr>
        <tr>
            <th>在籍期間</th>
            <td></td>
        </tr>
    </tbody>
</table>
