<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    //use DatabaseMigrations;

    private $thread;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->thread = Thread::latest()->first();

    }

    /** @test */
    public function a_user_can_browse_all_threads()
    {

        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {

        $response = $this->get($this->thread->path())
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_read_replies_associated_with_a_thread()
    {
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = factory(Channel::class)->create();

        $threadInChannel = factory(Thread::class)->create(['channel_id' => $channel->id]);
        $threadNotInChannel = factory(Thread::class)->create();

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }


    public function a_user_can_filter_threads_by_any_username()
    {
        $user = factory(User::class)->create(['name' => 'Nakamichi']);
        $this->signIn($user);

        $threadByNakamichi = factory(Thread::class)->create(['user_id' => auth()->id()]);
        $threadNotByNakamichi = factory(Thread::class)->create();

        $this->get('threads?by=nakamichi')
            ->assertSee($threadByNakamichi)
            ->assertDontSee($threadNotByNakamichi);
    }



}
