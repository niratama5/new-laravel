<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BulletinThread;
use App\Models\BulletinThreadReply;


class FileControllerV1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCsvWhereV2(Request $request)
    {
      $headers=[
        'Content-Type'=>'text/csv',
        'Content-Disposition'=>'attachment; filename=記事一覧.csv',
        'Pragma'=>'no-cache',
        'Cache-Control'=>'must-revalidation,post-check=0,pre-check=0',
        'Expires'=>'0',
      ];

      $date=$request->wheredate;
      

      $threads=BulletinThread::whereDate('created_at',$date)->with(['user'=>function($query){
        $query->select('id','name');
      },'replies.user'=>function($query){
        $query->select('id','name');
      }
      ])->get();

      $response=response()->stream(function() use ($threads){
        $file=fopen('php://output','w');

        fputcsv($file,['ユーザ名','タイトル','投稿内容','返信者','返信タイトル','返信内容',]);

        $flg=false;
        foreach($threads as $thread){
          $threadsArray=[
            $thread->user->name,
            $thread->thread_title,
            $thread->post_content,
          ];
          
          if($thread->replies->isNotEmpty()){
            foreach($thread->replies as $reply){
              if($flg===false){
                fputcsv($file,array_merge($threadsArray,[
                $reply->user->name,
                $reply->reply_title,
                $reply->reply_content,
              ]));
              $flg=true;
              }else{
                fputcsv($file,array_merge(['','',''],[
                  $reply->user->name,
                  $reply->reply_title,
                  $reply->reply_content,
                ]));
              }
            }
            $flg=false;
          }else if($thread->replies->isNotEmpty()===false){
            fputcsv($file,array_merge($threadsArray,['','','']));
          }
        }

        fclose($file);
      },200,$headers);
      
      return $response;
      
      // $threads->map(function($thread){
      //   return [
      //     'name'=>$thread->user->name,
      //     'thread_title'=>$thread->thread_title,
      //     'post_content'=>$thread->post_content,
      //     'created_at'=>$thread->created_at,
      //     'replies'=>$thread->replies->map(function($reply){
      //       return [
      //         'reply_name'=>$reply->user->name,
      //         'reply_title'=>$reply->reply_title,
      //         'reply_content'=>$reply->reply_content,
      //         'created_at'=>$reply->created_at,
      //       ];
      //     })
      //   ];
      // });

    }

    // public function getCsvWhereV1(Request $request)
    // {
    //   $headers=[
    //     'Content-Type'=>'text/css',
    //     'Content-Disposition'=>'attachment; filename=記事一覧.csv',
    //     'Pragma'=>'no-cache',
    //     'Cache-Control'=>'must-revalidation,post-check=0,pre-check=0',
    //     'Expires'=>'0',
    //   ];

    //   $date=$request->wheredate;

    //   $threads=BulletinThread::whereDate('created_at',$date)->with(['user'
    //     =>function($query){
    //       $query->select('id','name');
    //     }])->get()
    //     ->map(function($thread){
    //         return [
    //         'name'=>$thread->user->name,
    //         'thread_title'=>$thread->thread_title,
    //         'post_content'=>$thread->post_content,
    //       ];
    //     })->toArray();

    //     $response=response()->stream(function()use($threads){});
    // }

    public function getCsvWhere(Request $request)
    {
      $headers=[
        'Content-Type'=>'text/csv',
        'Content-Disposition'=>'attachment; filename=記事一覧.csv',
        'Pragma'=>'no-cache',
        'Cache-Control'=>'must-revalidate,post-chack=0,pre-check=0',
        'Expires'=>'0',
      ];

      $date=$request->wheredate;

      $threads=BulletinThread::whereDate('created_at',$date)->with([
        'user'=>function($query){
        $query->select('id','name');
      },
        'replies.user'=>function($query){
        $query->select('id','name');
      }
      ])
        ->get()
        ->map(function($thread){
          return [
            'name'=>$thread->user->name,
            'thread_title'=>$thread->thread_title,
            'post_content'=>$thread->post_content,
            'replies'=>$thread->replies->map(function($reply){
              return [
                'reply_name'=>$reply->user->name,
                'reply_title'=>$reply->reply_title,
                'reply_content'=>$reply->reply_content,
              ];
            })->toArray()
          ];
      })->toArray();

      $response=response()->stream(function() use ($threads){
        $file=fopen('php://output','w');

        fputcsv($file,['ユーザ名','タイトル','投稿内容','返信者','返信タイトル','返信内容',]);

        foreach($threads as $thread){
          fputcsv($file,[
            $thread['name'],
            $thread['thread_title'],
            $thread['post_content'],
          ]);
          foreach($thread['replies'] as $reply){
            fputcsv($file,[
            '', // スレッド情報の空白を埋める
            '', // スレッド情報の空白を埋める
            '', // スレッド情報の空白を埋める
            $reply['reply_name'],
            $reply['reply_title'],
            $reply['reply_content'],
            ]);
          }
        }

        fclose($file);
      },200,$headers);
      return $response;
      // $csvData=$threads->toArray();//後でなぜこうなるか調べる
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    // public function downloadCsv()
    // {
    //     // ユーザー全取得
    //     // データベースからすべてのユーザーデータを取得
    //     $users = BulletinThread::all();

    //     // CSVのヘッダー
    //     // CSVの最初の行に表示するカラム名を定義
    //     $csvHeader = ['thread_id','user_id','post_content','created_at','updated_at','deleted_at',];

    //     // CSVのデータを配列にする
    //     // ユーザーデータを配列形式に変換
    //     $csvData = $users->toArray();

    //     // ストリームレスポンスを作成
    //     // CSVデータをリアルタイムでストリーム出力するレスポンスを生成
    //     $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
    //         // 出力ストリームを開く
    //         $handle = fopen('php://output', 'w');

    //         // CSVヘッダーを出力
    //         fputcsv($handle, $csvHeader);

    //         // ユーザーデータをCSVに出力
    //         foreach ($csvData as $row) {
    //             fputcsv($handle, $row);
    //         }

    //         // ストリームを閉じる
    //         fclose($handle);
    //     }, 200, [
    //         // レスポンスのHTTPヘッダー設定
    //         'Content-Type' => 'text/csv', // ファイル形式をCSVとして指定
    //         'Content-Disposition' => 'attachment; filename="users.csv"', // ファイル名を指定してダウンロード
    //     ]);

    //     // レスポンスを返す
    //     return $response;
    // }

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
