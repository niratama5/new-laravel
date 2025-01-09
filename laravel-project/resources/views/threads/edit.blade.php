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

                    <form method="POST" action="{{route('threads.update',$thread->thread_id)}}">
                      @csrf
                      @method('put')

                      <div>
                        <label for="thread_title">タイトル</label>
                        <input type="text" id="thread_title" name="thread_title" value="{{$thread->thread_title}}" required>
                      </div>

                      <div>
                        <label for="post_content">投稿内容</label>
                        <textarea name="post_content" id="post_content" required>{{$thread->post_content}}</textarea>
                      </div>

                      <div>
                        <button type="submit">更新</button>
                      </div>

                    </form>

                    <form method="POST" action="{{route('threads.delete',$thread->thread_id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit">削除</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
