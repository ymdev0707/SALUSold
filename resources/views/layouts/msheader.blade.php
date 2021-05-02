<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-success">
      <a class="navbar-brand " href="{{ url('/') }}">SALUS</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarsExample03" style="">
        <ul class="navbar-nav mr-auto text-right">
          <li class="nav-item active">
            <a class="nav-link" href="/ms/userinformation">ユーザ管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ms/trainnerinformation">トレーナー管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ms/outputdata">各種データ出力</a>
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