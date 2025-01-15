<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinThreadReply extends Model
{
    use HasFactory;
    
    protected $table='bulletin_thread_reply';
    protected $primaryKey='reply_id';

    protected $fillable=[
      'user_id',
      'thread_id',
      'reply_title',
      'reply_content',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function thread()
    {
      return $this->belongsTo(BulletinThread::class,'thread_id');
    }
}