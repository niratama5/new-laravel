<form method="POST" action="{{route('send_email')}}">
  @csrf
  <div>
    <label for="email">メールアドレスを入力して仮登録ボタンを押してください
      <input type="email" id="email" name="email" required></label>
  </div>
  <button type="submit">仮登録</button>
</form>