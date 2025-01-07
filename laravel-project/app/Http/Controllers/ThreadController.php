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
      $threads=BulletinThread::orderBy('created_at','desc')->get();

      return view('threads.index',compact('threads'));
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
    public function store(Request $request)
    {
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
      $thread=BulletinThread::where('thread_id',$id)
            ->where('user_id',Auth::id())
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
    public function destroy(string $id)
    {
        //
    }
}
