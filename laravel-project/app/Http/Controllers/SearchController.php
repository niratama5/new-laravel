<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;

class SearchController extends Controller
{
    public function search(Request $request)
    {
      $query=$request->input('query');

      $results=BulletinThread::where('thread_title','like',"%{$query}%")->get();
      return view('search',compact('results'));
    }//
}