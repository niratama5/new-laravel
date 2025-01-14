<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事一覧') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <p>{{session('success')}}</p>
      @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-2 text-lg">最新の投稿</h3>
                    <div class="ml-4">
                        @foreach ($threads as $thread)
                          <div class="bg-gray-200 m-2 p-3 overflow-hidden shadow-sm sm:rounded-lg">
                            <h4>{{$thread->thread_title}}</h4>
                            <p>{{$thread->post_content}}</p>
                            <p>{{$thread->created_at->format('Y-m-d H:i')}}</p>
                            <div>
                              <a href="{{ route('threads.show-reply', $thread->thread_id) }}" class="bg-white px-4 overflow-hidden shadow-sm sm:rounded-lg">返信</a>  
                            </div>
                            <button class="bg-white h-19px px-4 overflow-hidden shadow-sm sm:rounded-lg" id="show_replies_{{$thread->thread_id}}" data-thread-id="{{$thread->thread_id}}">返信を表示</button>
                          </div>
                          <div class="ml-8 mb-8" id="replies_container_{{$thread->thread_id}}"></div>
                        @endforeach
                        @if ($threads->isEmpty())
                          <p class="text-gray-500">まだ記事がありません</p>
                        @endif
                    </div>
                </div>
            </div>
            <div>{{$threads->links()}}</div>
        </div>
    </div>
    <script>
      document.querySelectorAll('[id^="show_replies_"]').forEach(button => {
        button.addEventListener('click',async () => {
          if(button.dataset.loaded==="true"){//初回データ取得フラグ判定。引っかかるとreturnで何も起きない。
            return;
          }
          const threadId = button.getAttribute('data-thread-id');
          const repliesContainer = document.querySelector(`#replies_container_${threadId}`);

          try{
            const response = await fetch(`/api/replies/${threadId}`);
            const replies = await response.json();

            repliesContainer.innerHTML=replies.map(reply=>`
              <div>
                <h4>ユーザ：${reply.user.name}</h4>
                <h4>タイトル：${reply.reply_title}</h4>
                <p>内容：${reply.reply_content}</p>
              </div>
              <hr>
            `).join('');
            button.dataset.loaded="true";//初回データ取得時のフラグ建て
          }catch(error){
            repliesContainer.innerHTML=`<p>エラー：返信の読み込みに失敗しました</p>`;
          }
        });
      });
    </script>
</x-app-layout>
