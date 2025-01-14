<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新規投稿') }}
        </h2>
    </x-slot>
<div id="newpost_container">
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
        <h1>新規投稿</h1>
        <form action="{{route('posts.save')}}" method="POST">
            @csrf
            <div id="thread_title_container">
              <label for="thread_title">
                <p>タイトル</p>
                <input class="border-black border rounded-md" type="textbox" id="thread_title" name="thread_title" required>
              </label>
            </div>
            <div id="post_content_container">
              <label for="post_content">
              <p>内容</p>
                <textarea class="w-9/12 h-96 rounded-md" id="post_content" name="post_content" required></textarea>
              </label>
            </div>
            <button class="bg-gray-200 rounded-md w-12 shadow-md" type="submit" id="post_button">投稿</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-app-layout>