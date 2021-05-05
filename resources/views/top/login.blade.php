@extends('layouts.template')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}

@endsection

@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}

@endsection

@section('content')
    @extends('layouts.header')
    <div class="container text-center pt-5">
        @csrf
        <form class="form-signin" method="POST" action="/home">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                height="72">
            <h1 class="h3 mb-3 font-weight-normal">ログイン</h1>
            <label for="email" id="email" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> ログイン情報を保存
                </label>
            </div>
            <button class="btn btn-dark btn-primary btn-block" type="submit">ログイン</button>
            <div class="mt-5">
                <a href="/signup">新規登録へ</a>
            </div>
            <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
        </form>
    </div>
@endsection

@section('javascript-footer')
    {{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
