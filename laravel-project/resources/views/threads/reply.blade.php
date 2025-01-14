<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事の編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <div>
                    <h4>{{$thread->thread_title}}</h4>
                    <p>{{$thread->post_content}}</p>
                    <p>{{$thread->created_at->format('Y-m-d H:i')}}</p>
                  </div>
                  <form  method="POST" action="{{route('threads.reply',$thread->thread_id)}}">
                    @csrf
                    <label for="reply_title">
                      返信タイトル
                      <input type="text" name="reply_title" id="reply_title">
                    </label>
                    <label for="reply_content">
                      返信内容
                      <textarea name="reply_content" id="reply"></textarea>
                    </label>
                    <button type="submit">送信</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
