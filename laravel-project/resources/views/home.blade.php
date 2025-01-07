<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<header>
  <div id="header_logo"><img src="{{ asset('img/logo.gif')}}" alt="ロゴ"></div>
    <div id="login">
      <div>
        <a href="{{route('posts.create')}}"><img src="{{asset('img/post_button.gif')}}" alt="新規投稿"></a>
      </div>
      <div>
        <img src="{{asset('img/login.gif')}}" alt="ログイン">
      </div>
    </div>
</header>
<div id="new_threads_container">
  <h2>最新の投稿一覧</h2>
  @yield('thread')
</div>
</body>
</html>