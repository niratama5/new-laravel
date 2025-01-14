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
      $threads=BulletinThread::where('deleted_at',false)->orderBy('created_at','desc')->get();

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

      BulletinThread::create([
        'thread_title'=>$validated['thread_title'],
        'post_content'=>$validated['post_content'],
        'user_id'=>Auth::id(),
        //'user_id'=>Auth::id(),//IDを取得してる
      ]);

      //return redirect()->action([ViewController::class,'index']);
      return redirect()->route('threads')->with('success','新しいスレッドが作成されました！');
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
    
    public function showedit()
    {
      $user_id=Auth::id();
      $threads=BulletinThread::where('user_id',$user_id)
              ->where('deleted_at',false)->orderBy('created_at','desc')->get();
      return view('threads.edit',compact('threads'));
        //
    }

    public function edit(string $id)
    {
      $user_id=Auth::id();
      $thread=BulletinThread::findOrFail($id);
      
      return view('threads.update',compact('thread'));
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

    public function logical_delete(string $thread_id)
    {
      $user_id=Auth::id();
      $thread=BulletinThread::where('user_id',$user_id,)->where('thread_id',$thread_id);
      $thread->update(['deleted_at'=>true]);
      return redirect()->route('threads')->with('success','スレッドが論理削除されました');
    }

    public function showdeleted()
    {
      $user_id=Auth::id();
      $threads=BulletinThread::where('deleted_at',true)->where('user_id',$user_id)->orderBy('created_at','desc')->get();

      return view('threads.deleted',compact('threads'));
    }

    public function rollback(string $thread_id)
    {
      $user_id=Auth::id();
      $thread=BulletinThread::where('user_id',$user_id)->where('thread_id',$thread_id);
      $thread->update(['deleted_at'=>false]);

      return redirect()->route('threads')->with('success','スレッドが復元されました');
    }
}