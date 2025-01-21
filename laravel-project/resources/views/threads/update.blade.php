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
                  <div id="update_container">
                    <h1>編集画面</h1>
                    <form action="{{route('threads.update',$thread->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="thread_title_container">
                          <label for="thread_title">
                            <input type="textbox" id="thread_title" name="thread_title" value="{{$thread->thread_title}}" required>
                          </label>
                        </div>
                        <div id="post_content_container">
                          <label for="post_content">
                            <textarea id="post_content" name="post_content" required>{{$thread->post_content}}</textarea>
                          </label>
                        </div>
                        <button type="submit" id="post_button">投稿</button>
                    </form>
                    <form action="{{route('threads.logical_delete',$thread->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit">削除</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
