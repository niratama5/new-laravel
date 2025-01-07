@extends('layouts.app')

@section('content')
<div id="confirm_container">
  <h1>本登録画面</h1>
  <form action="{{route('register.complete')}}" method="POST">
    @csrf
    <div>
      <label for="mail">
        <input type="hidden" value="{{$mail}}" name="mail" id="mail">
      </label>
    </div>
    <div>
      <label for="nick_name">ニックネームを入力してください
        <input type="text" id="nick_name" name="nick_name" required>
      </label>
    </div>
    <div>
      <label for="password">パスワードを入力してください
        <input type="password" id="password" name="password" required>
      </label>
    </div>
    <div>
      <label for="password_confirmation">パスワード確認用
        <input type="password" id="password_confirmation" name="password_confirmation" required>
      </label>
    </div>
    <button type="submit">本登録</button>
  </form>
</div>
@endsection