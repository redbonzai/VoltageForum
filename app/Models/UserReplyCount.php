<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReplyCount extends Model
{
    protected $table = 'user_reply_count';

    protected $fillable = [
        'user_id',
        'reply_id',
        'reply_count'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'reply_id' => 'integer',
        'reply_count' => 'integer'
    ];

}
