<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempUsers;
use App\Models\user;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TempRegister;

class TempRegisterController extends Controller
{
  public function showRegisterForm()
  {
    return view('auth.temp_register');
  }

  public function register(Request $request)
  {
    $validated=$request->validate([
      'email'=>'required|email|unique:token_manager,mail',
    ]);

    $tempWrite=TempUsers::create([
      'mail'=>$validated['email'],
      'token'=>Str::random(60),//トークン作るやつ
      'token_create_time'=>new Carbon(),
      'token_limit_time'=>(new Carbon())->addMinutes(10),
    ]);

    $url=route('register',['token'=>urlencode($tempWrite->token)]);
    Mail::to($tempWrite->mail)->send(new TempRegister($url));

    return redirect()->route('welcome')->with('success','仮登録が完了しました。メールをご確認ください。');
  }

  public function complete(Request $request)
{
    // パスワードのバリデーション
    $validated = $request->validate([
      'mail' => 'required',
      'nick_name' => 'required|string|max:32',
      'password' => 'required|min:8|confirmed',
    ]);

    // パスワードを設定してユーザーを作成
    $user = User::create([
        'nick_name' => $validated['nick_name'],
        'mail' => $validated['mail'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->route('login')->with('success', '本登録が完了しました。ログインしてください。');
}

public function confirm($token)
{
    $decodedToken=urldecode($token);

    $tempUser = TempUsers::where('token', $decodedToken)->first();

    if (!$tempUser) {
        return redirect()->route('home')->with('error', '無効なトークンです。');
    }

    //return view('auth.confirm', compact('tempUser'));
    return view('auth.confirm',['mail'=>$tempUser->mail]);
}


    //
}