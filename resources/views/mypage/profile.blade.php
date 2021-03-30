@extends('layouts.template')

@section('css')
{{-- この場所に画面毎のcssを記述する --}}

@endsection

@section('javascript-head')
{{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}

@endsection

@section('content')
@extends('layouts.mypageheader')
    <div class="container pt-5 border-primary profile-container">
      <div class="col-md-6" style="max-width: 100%;">
        <h4 class="mb-3 border-bottom">プロフィール確認・編集</h4>
        <form action="/mypage/profile/update" method="POST" class="needs-validation profile-form" style="padding-top: 10%;" novalidate="">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6 mb-3">
              <div>
                <label class="form-label">会員番号</label>
              </div>
              <div>
                <label name="personalNumber" id="personalNumber">{{$id}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="lastName" class="form-label">姓</label>
              <input type="text" class="form-control profile-input"name="lastName" id="lastName" placeholder="田中" value="{{$last_name}}" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="firstName" class="form-label">名</label>
              <input type="text" class="form-control profile-input" name="firstName" id="firstName" placeholder="太郎" value="{{$first_name}}" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
          </div>
            
          <div class="mb-3">
            <label for="email" class="form-label">メールアドレス<span class="text-muted"></span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{$email}}">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <button class="btn btn-primary btn-dark btn-block profile-submit" type="submit">更新</button>
        </form>
      </div>
    </div>
</div>
@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection