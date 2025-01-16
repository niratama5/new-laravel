<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
                <p>{{session('success')}}</p>
              @endif
            <div class="mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- {{ __("You're logged in!") }} -->
                      <a href="{{route('api.get.csv')}}">記事一覧(全て)CSVダウンロード</a>
                </div>
            </div>
            <div class="p-3 bg-white overflow-hidden shadow-sm sm:rounded-lg" >
              <form action="{{route('api.where.csv')}}" method='POST'>
                @csrf
                <label for="wheredate" class="">
                  日付を指定してください
                  <input type="date" name="wheredate" id="wheredate" class="sm:rounded-lg shadow-sm">
                </label>
                <button type="submit" class="p-2 mt-2 border border-gray-400 sm:rounded-lg shadow-am">CSV出力</button>
              </form>
            </div>
        </div>
    </div>
</x-app-layout>
