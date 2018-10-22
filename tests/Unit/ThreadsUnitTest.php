<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsUnitTest extends TestCase
{

    private $thread;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = Thread::latest()->first();
    }

    /** @test */
    public function a_thread_can_make_a_string_path()
    {
        $thread = factory(Thread::class)->create();

        $this->assertEquals('/threads/' . $thread->channel->slug . '/' . $thread->id, $thread->path());
    }

    /** @test */
    public function a_thread_has_a_creator()
    {

        $this->assertInstanceOf(User::class, $this->thread->user);

    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->replies()->create([
            'body' => 'this is the body',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);

    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $this->assertInstanceOf('App\Models\Channel', $this->thread->channel);

    }
}
