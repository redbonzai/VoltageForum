<?php

use App\Models\Reply;
use Illuminate\Database\Seeder;
use App\Models\Thread;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(Thread::class, 20)->create();
        $threads->each( function ($thread) {
            factory(Reply::class, 5)->create([
                'thread_id' => $thread->id
            ]);
        });

        $this->command->info('ThreadSeeder successfully created 20 threads each having 5 replies.');
    }
}
