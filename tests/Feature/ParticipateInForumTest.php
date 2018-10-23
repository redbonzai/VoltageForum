<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{

    /*public function non_authenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('threads/some-channel/1/replies', [] )
            ->assertRedirect('/login');

    }*/

    /** @test */
    function an_authenticated_user_participates_in_forum_threads()
    {
        //Given an authenticated user
        $this->signIn();

        $thread = factory('App\Models\Thread')->create();
        $reply = factory('App\Models\Reply')->make();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make(['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');


    }
}
