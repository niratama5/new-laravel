<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUsers extends Model
{
    use HasFactory;

    protected $table='token_manager';

    protected $fillable=[
      'mail',
      'token',
      'token_create_time',
      'token_limit_time',
    ];

    public $timestamps=false;
}
