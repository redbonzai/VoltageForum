<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';

    protected $fillable = ['user_id', 'thread_id', 'body', 'created_by', 'updated_by'];

    protected $casts = [
        'user_id' => 'integer',
        'thread_id' => 'integer',
        'body' => 'string',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id', 'id');
    }

}
