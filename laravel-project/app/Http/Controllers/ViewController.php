<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinThread;

class ViewController extends Controller
{
  public function index(){
    //$threads=BulletinThread::latest()->take(10)->get();
    return view('home');
  }  //
}