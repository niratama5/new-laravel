<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('削除済み一覧') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($threads as $thread)
                      <h4>{{$thread->thread_title}}</h4>
                      <p>{{$thread->post_content}}</p>
                      <p>{{$thread->created_at->format('Y-m-d H:i')}}</p>
                      <form method="POST" action="{{ route('rollback', $thread->id) }}">
                      @csrf
                      @method('PUT')
                        <button type="submit">復元</button>
                      </form>
                    @endforeach

                    @if ($threads->isEmpty())
                      <p class="text-gray-500">まだ記事がありません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
