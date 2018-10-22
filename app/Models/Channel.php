<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channels';

    protected $fillable = [
        'name', 'slug'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class, 'channel_id', 'id');
    }

}
