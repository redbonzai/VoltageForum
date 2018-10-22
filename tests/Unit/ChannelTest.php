<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
   /** @test */
   public function a_channel_consists_of_threads()
   {
       $channel = factory(Channel::class)->create();

       $thread = factory(Thread::class)->create(['channel_id' => $channel->id]);

       $this->assertTrue($channel->threads->contains($thread));

   }
}
