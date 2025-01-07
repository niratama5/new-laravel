extends('layouts.app')
@section('thread')
  @foreach($posts as $post)
    <div>
      <h2>{{$posts->thread_title}}</h2>
      <p>{{$posts->post_content}}</p>
    </div>
  @endforeach
@endsection