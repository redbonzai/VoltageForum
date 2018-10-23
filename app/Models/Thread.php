<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'threads';

    protected $fillable = [
        'user_id', 'channel_id', 'title', 'body', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'channel_id' => 'integer',
        'title' => 'string',
        'body' => 'text',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function path()
    {
        return '/threads/' . $this->channel->slug . '/'. $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id', 'id');
    }
}
