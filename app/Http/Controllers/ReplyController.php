<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\UserReplyCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $channel,  Thread $thread)
    {
        //dd($request, $channel, $thread);

        $this->validate($request, [
            'threadReply' => 'required'
        ]);

        $reply = $thread->addReply([
            'body' => $request->get('threadReply'),
            'user_id' => auth()->id()
        ]);

        $this->incrementUserReplyCount($reply);

        $return = $thread;

        return back();

    }

    public function incrementUserReplyCount(Reply $reply)
    {
        $userReplies = $this->getUserReplyCount(auth()->id());

        $userReplyCount = UserReplyCount::updateOrCreate([
            'user_id' => $reply->user_id,
            'reply_id' => $reply->id,
            'reply_count' => $userReplies[0]->reply_count
        ]);

        return $userReplyCount;
    }

    public function getUserReplyCount($userId)
    {
        $query = DB::table('replies')
            ->join('users', function ($join) {
                $join->on('replies.user_id', '=', 'users.id');

            })->where('users.id', $userId)
            ->select( DB::raw("count(replies.user_id) as 'reply_count' "))
            ->groupBy('replies.user_id')
            ->get();

        return $query;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
