@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
            <form>
                <ul>
                    <li class="name">
                        <label for="name">年齢<label>
                        <input id="name" type="text" name="name" placeholder="miku honda" size="60">
                    </li>
                    <li class="email">
                        <label for="email">身長</label>
                        <input id="email" type="text" name="email" placeholder="info@example.com" cols="40" rows="60">
                    </li>
                    <li class="email">
                        <label for="email">性別</label>
                        <input id="radio-a" type="radio" name="dinner" value="man" checked><label for="radio-a">男</label>
                        <input id="radio-b" type="radio" name="dinner" value="wemen"><label for="radio-b">女</label><br>
                    </li>
                    <li class="email">
                        <label for="email">身長</label>
                        <input id="email" type="text" name="email" placeholder="info@example.com" cols="40" rows="60">
                    </li>
                    <li class="email">
                        <label for="email">目標体重</label>
                        <input id="email" type="text" name="email" placeholder="info@example.com" cols="40" rows="60">
                    </li>
                        <input class="divsave btn" id="button" type="submit" name="button" value="登録">
                    </li>
                </ul>
            </form>
            
        </div>
    </div>
    
    <input type="checkbox" id="cp_navimenuid">
    <label class="menu" for="cp_navimenuid">
        <div class="menubar">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul>
            <li><a id="home" href="home">管理記録</a></li>
            <li><a id="fat" href="fat">体重管理</a></li>
            <li><a id="trainning" href="trainning">運動報告</a></li>
            <li><a id="eat" href="eat">食事報告</a></li>
            <li><a id="profile" href="profile">プロフィール</a></li>
        </ul>
    </label>
</div>
<form class="contact-form" action="//www-creators.com/rsc/receiver.php" method="post">
  <p>お客様の情報をご記載下さい。</p>
  <div class="item">
    <label class="label" for="name" name="name">名前</label>
    <input id="name" type="text">
  </div>
  <div class="item">
    <label class="label" for="e-mail">メール</label>
    <input id="e-mail" type="email" name="email">
  </div>
  <div class="item">
    <label class="label" for="message">本文</label>
    <textarea rows="4" id="message" placeholder="ご意見をお寄せ下さい。" name="comment"></textarea>
  </div>
  <div class="item">
    <p class="label">購入理由</p>
    <div class="radio-group">
      <label><input type="radio" name="source">友達から聞いた</label><br>
      <label><input type="radio" name="source">CMを見た</label><br>
      <label><input type="radio" name="source">ネット広告を見た</label>
    </div>
  </div>
  <div class="item no-label">
    <label><input type="checkbox" name="magazine">メルマガを希望する</label>
  </div>
  <div class="item no-label">
    <input type="submit">
  </div>
</form>

<style>
.contact-form {
  border: 1px solid #ccc;
  padding: 10px;
  font-size: 13px;
  font-family: sans-serif;
}
.contact-form .item {
  display: block;
  overflow: hidden;
  margin-bottom: 10px;
}
.contact-form .item.no-label {
  padding: 5px 0px 5px 60px;
}
.contact-form .item .label {
  float: left;
  padding: 5px;
  margin:0;
}
.contact-form .item .radio-group{
  padding: 5px 0px 5px 60px;
}
.contact-form .item input[type=text],
.contact-form .item input[type=email],
.contact-form .item textarea {
  display: block;
  margin-left: 60px;
  width: 200px;
  padding: 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-size: 13px;
}
.contact-form .item ::placeholder {
  color: #ccc;
}
.contact-form .item textarea {
  outline: none;
  border: 1px solid #ccc;
  resize: vertical;
}
input[type=submit] {
  border: none;
  outline: none;
  display: block;
  line-height: 30px;
  width: 160px;
  text-align: center;
  font-size: 13px;
  color: #fff;
  background-color: #696;
  border-bottom: 4px solid #464;
  cursor:pointer;

  box-sizing: content-box;
  transition:0.3s ease all
}
input[type=submit]:hover{
  border-bottom-width:0;
  transform:translateY(4px)
}
</style>
@endsection
