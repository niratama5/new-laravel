@section('content')
<h1>検索結果</h1>
  @if($results->isEmpty())
    <p>検索結果が見つかりませんでした</p>
  @else
    <ul>
      @foreach($results as $result)
        <li>{{$result->thread_title}}</li>
      @endforeach
    </ul>
  @endif
  @endsection