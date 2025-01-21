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
        'bulletin_thread_id'=>$id,
        'user_id'=>Auth::id(),
      ]);

      return redirect()->route('threads')->with('success','返信が投稿されました！');
        
    }


    //返信取得用試作型API
    public function getReplies($threadId)
    {
      $replies=BulletinThreadReply::with('user')->where('bulletin_thread_id',$threadId)->get();

      return response()->json($replies);
    }
}
