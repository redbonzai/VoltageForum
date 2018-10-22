<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepliesTest extends TestCase
{
    /** @test */
    public function a_reply_has_an_owner()
    {
        $reply = Reply::find(1);

        $this->assertInstanceOf(User::class, $reply->user);

    }
}
