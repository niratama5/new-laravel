<header>
    <div id="header_logo"><img src="{{ asset('img/logo.gif')}}" alt="ロゴ"></div>
    <form action="{{ route('search') }}" method="GET">
      <input type="text" name="query" placeholder="キーワードを入力">
      <button type="submit">検索</button>
    </form>
    <div id="login">
    <div>
      <a href="{{route('posts.create')}}"><img src="{{asset('img/post_button.gif')}}" alt="新規投稿"></a>
    </div>
      <div><img src="{{asset('img/login.gif')}}" alt="ログイン"></div>
      <div>
        <a href="{{route('temp_register')}}"><img src="{{asset('img/sign_up.gif')}}" alt="新規登録"></a>
      </div>
    </div>
  </header>