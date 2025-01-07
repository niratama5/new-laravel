<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

class NewPostController extends Controller
{
    //
    public function create()
    {
      return view('posts.create');
    }

    public function save(Request $request)
    {
      $validated=$request->validate([
        'thread_title'=>'required|string|max:255',
        'post_content'=>'required|string',
      ]);

      $userId=1;//テスト用

      BulletinThread::create([
        'thread_title'=>$validated['thread_title'],
        'post_content'=>$validated['post_content'],
        'user_id'=>$userId,
        //'user_id'=>Auth::id(),//IDを取得してる
      ]);

      //return redirect()->action([ViewController::class,'index']);
      return redirect()->route('dashboard')->with('success','新しいスレッドが作成されました！');
    }
}