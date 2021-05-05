@extends('layouts.template')

@section('css')
{{-- この場所に画面毎のcssを記述する --}}

@endsection

@section('javascript-head')
{{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}

@endsection

@section('content')
@extends('layouts.header')
<div class="container pt-5 border-primary profile-container">
  <div class="col-md-6" style="max-width: 100%;">
    <form class="needs-validation profile-form" method="POST" action="{{ route('register') }}" style="padding-top: 10%;" novalidate="">
      <img class="mb-4 img-logo" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h4 class="h3 mb-3 font-weight-normal" style="text-align: center">新規登録</h4>
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6 mb-3"> <label for="lastName" class="form-label">姓</label> <input type="text" class="form-control profile-input" id="lastName" placeholder="田中" value="" required="">
          <div class="invalid-feedback"> Valid last name is required. </div>
        </div>
        <div class="col-md-6 mb-3"> <label for="firstName" class="form-label">名</label> <input type="text" class="form-control profile-input" id="firstName" placeholder="太郎" value="" required="">
          <div class="invalid-feedback"> Valid first name is required. </div>
        </div>
      </div>
      <div class="mb-3"> <label for="email" class="form-label">生年月日<span class="text-muted"></span></label> <input type="date" class="form-control profile-input" id="calendar"> </div>
      <div class="mb-3"> <label for="email" class="form-label">メールアドレス<span class="text-muted"></span></label> <input type="email" class="form-control" id="email" placeholder="you@example.com">
        <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
      </div>
      <div class="mb-3"> <label for="email" class="form-label">性別<span class="text-muted"></span></label>
        <div> <input type="radio" name="gender" value="male" checked="" required="">男性 <input type="radio" style="margin-left: 10px;" name="gender" value="female">女性 </div>
      </div> <button class="btn btn-primary btn-dark btn-block profile-submit" type="submit">登録</button>
      <div class="text-center">
        <a href="/login">ログインへ</a>
        <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
      </div>
    </form>
    </form>
  </div>
</div>
@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection