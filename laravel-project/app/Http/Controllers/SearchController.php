<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function search(Request $request)
    {
      $search=$request->input('search');
      $threads=BulletinThread::where('thread_title','LIKE',"%${search}%")
              ->orwhere('post_content','LIKE',"%${search}%")->paginate(3);
      // $user=Auth::user();
      // dd('aaa');
      // $userName = Auth::check() ? Auth::user()->name : 'ゲスト';
      
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
}
