@extends('layouts.msheader')

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
    @extends('layouts.mstemplate')
@section('content')
    <form action="{{ url('/ms/userinformation/search') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>ユーザーID</label>
            <input type="text" class="form-control col-md-5" placeholder="" name="user_id">
        </div>
        <div class="form-group">
            <label>姓名 / セイメイ</label>
            <input type="text" class="form-control col-md-5" placeholder="" name="name">
        </div>
        <div class="form-group">
            <label>性別</label>
            <select class="form-control col-md-5" name="sex">
                <option value="">---</option>
                <option value="100">男</option>
                <option value="101">女</option>
            </select>
        </div>
        <div class="form-group">
            <label>担当者</label>
            <input type="text" class="form-control col-md-5" placeholder="" name="staff">
        </div>
        <div class="form-group">
            <label>在籍店舗</label>
            <select class="form-control col-md-5" name="sex2">
                <option value="">---</option>
                <option value="1">男</option>
                <option value="0">女</option>
            </select>
        </div>
        <div class="form-group">
            <label>在籍区分</label>
            <input type="checkbox" name="enrollment_type[]" value="200" >一般
            <input type="checkbox" name="enrollment_type[]" value="201">管理者
        </div>

        <input type="submit" class="btn btn-primary" value="検索">
        <a href="/ms/userinformation/add" class="btn btn-primary" role="button">新規登録</a>
    </form>
    @if (session('flash_message'))
        <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message') }}</div>
    @endif
    <div style="margin-top:50px;">
        <h1>ユーザー一覧</h1>
        <table class="table">
            <tr>
                <th>ユーザーID</th>
                <th>姓名/セイメイ</th>
                <th>年齢</th>
                <th>性別</th>
                <th>在籍区分</th>
                <th>担当者</th>
                <th>在籍店舗</th>
                <th>詳細</th>
            </tr>
            @isset($user_info)
                @foreach ($user_info as $user)
                    <tr>
                        <td>{{ $user->USER_ID }}</td>
                        <td>{{ $user->CONCATNAME }}</td>
                        <td>{{ $user->BIRTH }}</td>
                        <td>{{ $user->SEX }}</td>
                        <td>{{ $user->IS_ADMIN }}</td>
                        <td>{{ $user->STAFF }}</td>
                        <td>{{ $user->STORE_NAME }}</td>
                        <td>
                            <a href="/ms/userinformation/detail/?user_id={{$user->USER_ID}}" title="詳細">詳細</a>
                        </td>
                    </tr>
                @endforeach    
            @endisset
        </table>
    </div>
@endsection

@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection
