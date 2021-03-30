<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand " href="{{ url('/') }}">SALUS</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarsExample03" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">SALUSとは <span class="sr-only">(current)</span></a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            {{-- ログインしている場合 --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">マイページへ <span
                                        class="sr-only">(current)</span></a>
                            </li>
                        @else
                            {{-- ログインしていない場合 --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/register') }}">新規登録 <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/login') }}">ログイン <span
                                            class="sr-only">(current)</span></a>
                                </li>
                            @endif
                        @endauth
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">お問い合わせ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>

</html>
