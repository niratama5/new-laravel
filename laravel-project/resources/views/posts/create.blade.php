@extends('layouts.app')
@section('content')
<div id="newpost_container">
  <h1>新規投稿</h1>
  <form action="{{route('posts.save')}}" method="POST">
      @csrf
      <div id="thread_title_container">
        <label for="thread_title">
          <input type="textbox" id="thread_title" name="thread_title" required>
        </label>
      </div>
      <div id="post_content_container">
        <label for="post_content">
          <textarea id="post_content" name="post_content" required></textarea>
        </label>
      </div>
      <button type="submit" id="post_button">投稿</button>
  </form>
</div>
@endsection