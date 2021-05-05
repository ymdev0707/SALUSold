<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
</head>

<body>
    <div class="container pt-5 border-primary profile-container">
        <div class="col-md-6" style="max-width: 100%;">
            <h4 class="mb-3 border-bottom">運動報告</h4>
        </div>
        <div>
            <label>コメント</label>
        </div>
        <div>
            <textarea name="kanso" rows="4" cols="40">ここに感想を記入してください。</textarea><br>
        </div>
        <div>
            <label>トレーナーコメント</label>
        </div>
        <div>
            <textarea name="kanso" rows="4" cols="40">ここに感想を記入してください。</textarea><br>
        </div>
        <div>
            <label>消費カロリー</label>
        </div>
        <div>
            <input type="number">
            <label>kcal</label>
        </div>
        <div>
            <label>摂取時刻</label>
        </div>
        <div>
            <input type="time">
        </div>
    </div>
</body>

</html>
