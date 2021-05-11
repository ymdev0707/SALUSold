<table class="type06">
    <tbody>
        <tr>
            <th>ユーザーid</th>
            <td>{{ $user_information->USER_ID }}</td>
        </tr>
        <tr>
            <th>氏名</th>
            <td>{{ $user_information->NAME }}</td>
        </tr>
        <tr>
            <th>氏名カナ</th>
            <td>{{ $user_information->NAMEKANA }}</td>
        </tr>
        <tr>
            <th>生年月日(年齢)</th>
            <td>{{ $user_information->BIRTH }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $user_information->SEX }}</td>
        </tr>
        <tr>
            <th>在籍区分</th>
            <td>{{ $user_information->IS_ADMIN }}</td>
        </tr>
        <tr>
            <th>担当</th>
            <td>{{ $user_information->STAFF }}</td>
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
