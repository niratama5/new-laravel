<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinThread extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定（省略すると、Laravelはモデル名を基に自動的にテーブル名を推測します）
    protected $table = 'bulletin_thread';
    protected $primaryKey='id';

    protected $fillable=[
      'user_id',
      'thread_title',
      'post_content',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function replies()
    {
      return $this->hasMany(BulletinThreadReply::class,'bulletin_thread_id');
    }

}