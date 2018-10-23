<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        if ($username = $this->request->by) {
            $user = User::where('name', '=', $username)->first();

            $builder->where('user_id', $user->id);
        }

        return $builder;

    }
}
