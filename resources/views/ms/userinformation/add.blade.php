@extends('layouts.mstemplate')

@section('css')
    {{-- この場所に画面毎のcssを記述する --}}
@endsection
@section('javascript-head')
    {{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
    <script type="text/javascript">
        window.onload = function() {}

    </script>
@endsection

@section('content')
    @extends('layouts.msheader')
@section('content')
    <form action="{{ url('/ms/userinformation/regist') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 mb-3"> <label for="last_name" class="form-label">姓</label> <input type="text"
                    class="form-control profile-input" name="last_name" placeholder="田中" value="" required="">
                <div class="invalid-feedback"> Valid last name is required. </div>
            </div>
            <div class="col-md-6 mb-3"> <label for="first_name" class="form-label">名</label> <input type="text"
                    class="form-control profile-input" name="first_name" placeholder="太郎" value="" required="">
                <div class="invalid-feedback"> Valid first name is required. </div>
            </div>
            <div class="col-md-6 mb-3"> <label for="last_name_lana" class="form-label">セイ</label> <input type="text"
                    class="form-control profile-input" name="last_name_kana" placeholder="タナカ" value="" required="">
                <div class="invalid-feedback"> Valid last name is required. </div>
            </div>
            <div class="col-md-6 mb-3"> <label for="first_name_kana" class="form-label">メイ</label> <input type="text"
                    class="form-control profile-input" name="first_name_kana" placeholder="タロウ" value="" required="">
                <div class="invalid-feedback"> Valid first name is required. </div>
            </div>
        </div>
        <div class="mb-3"> <label for="email" class="form-label">生年月日<span class="text-muted"></span></label> <input
                type="date" name="birth" class="form-control profile-input" id="calendar"> </div>
        <div class="mb-3"> <label for="email" class="form-label">メールアドレス<span class="text-muted"></span></label> <input
                type="email" class="form-control" name="email" placeholder="you@example.com">
            <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
        </div>
        <div class="mb-3"> <label for="email" class="form-label">性別<span class="text-muted"></span></label>
            <div> <input type="radio" name="sex" value="100" checked="" required="">男性 <input type="radio"
                    style="margin-left: 10px;" name="sex" value="101">女性 </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Confirm Password') }}
                    </button>

                </div>
            </div>
        </div> <button class="btn btn-primary btn-dark btn-block profile-submit" type="submit">登録</button>
    </form>
    @if (session('flash_message'))
        <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message') }}</div>
    @endif
@endsection

@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
