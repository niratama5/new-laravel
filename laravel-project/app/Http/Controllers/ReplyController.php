<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;
use App\Models\BulletinThreadReply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $threads)
    {
      $thread=BulletinThread::find($threads);
      return view('threads.reply',compact('thread'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
      $validated=$request->validate([
        'reply_title'=>'required|string|max:20',
        'reply_content'=>'required|string|max:255',
      ]);
      
      BulletinThreadReply::create([
        'reply_title'=>$validated['reply_title'],
        'reply_content'=>$validated['reply_content'],
        'thread_id'=>$id,
        'user_id'=>Auth::id(),
      ]);

      return redirect()->route('threads')->with('success','返信が投稿されました！');
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //返信取得用試作型API
    public function getReplies($threadId)
    {
      $replies=BulletinThreadReply::with('user')->where('thread_id',$threadId)->get();

      return response()->json($replies);
    }
}
