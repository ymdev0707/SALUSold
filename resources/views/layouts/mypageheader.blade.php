<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand " href="{{ url('/') }}">SALUS</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarsExample03" style="">
        <ul class="navbar-nav mr-auto text-right">
          <li class="nav-item active">
            <a class="nav-link" href="/home">プロフィール</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/mypage/record">記録</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">報告</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item" href="/mypage/mealreport">食事報告</a>
              <a class="dropdown-item" href="/mypage/trainningreport">運動報告</a>
              <a class="dropdown-item" href="/mypage/report?type=bodyweight">体重報告</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">お問い合わせ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('ログアウト') }}
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </ul>
      </div>
    </nav>
  </header>
</body>
</html>