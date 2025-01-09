<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user_id=Auth::id();
      $threads=BulletinThread::where('deleted_at',false)->where('user_id',$user_id)->orderBy('created_at','desc')->get();

      return view('threads.index',compact('threads'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('posts.create');
    }

    public function store(Request $request)
    {
      $validated=$request->validate([
        'thread_title'=>'required|string|max:255',
        'post_content'=>'required|string',
      ]);

      $userId=1;//テスト用

      BulletinThread::create([
        'thread_title'=>$validated['thread_title'],
        'post_content'=>$validated['post_content'],
        'user_id'=>Auth::id(),
        //'user_id'=>Auth::id(),//IDを取得してる
      ]);

      //return redirect()->action([ViewController::class,'index']);
      return redirect()->route('dashboard')->with('success','新しいスレッドが作成されました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user_id=Auth::id();
      $thread=BulletinThread::where('thread_id',$id)
            ->where('user_id',$user_id)
            ->firstOrFail();
      return view('threads.edit',compact('thread'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validated=$request->validate(
        [
          'thread_title'=> 'required|string|max:255',
          'post_content'=>'required|string',
        ]
      );

      $thread=BulletinThread::findOrFail($id);
      $thread->update($validated);

      return redirect()->route('threads')->with('success', 'スレッドが更新されました');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $thread_id)
    {
      $thread=BulletinThread::find($thread_id);
      $thread->delete();
      return redirect()->route('threads')->with('success','スレッドが削除されました');
        //
    }

    public function logical_delete()
    {
      
    }
}
